<template>
  <div>
    <Head title="Sign Up" />

    <h1 data-aos="fade-right">Sign<br />Up</h1>

    <v-container>
      <div v-if="!$page.props.auth.user" class="text-center">
        <p>First, make sure you're in our discord server.</p>

        <v-btn
          data-aos="fade-up"
          data-aos-delay="200"
          data-aos-offset="-50"
          color="primary"
          :to="'https://discord.gg/AYr59EgzzR'"
          class="eightbitfont"
          x-large
          block
        >
          Join the Discord
        </v-btn>

        <p>Then, login through discord to sign up!</p>

        <v-btn color="primary" :href="route('login')">
          <v-icon>
            mdi-discord
          </v-icon>
          Discord Login
        </v-btn>
      </div>

      <v-form ref="form" @click.prevent="submit" v-else>
        <v-row>
          <v-col cols="12" md="7">
            <div v-if="signedUp">
              <p>
                Welcome back! You can edit your signup data here.
              </p>
            </div>

            <h2>Data</h2>
            <v-autocomplete
              v-model="form.flag"
              :rules="flagRules"
              :items="flags"
              prepend-inner-icon="mdi-magnify"
              item-text="name"
              item-value="img"
              label="Flag*"
            >
              <template v-slot:item="{ props, item }">
                <Flag style="height: 50px" :code="item.img" /> {{ item.name }}
              </template>
            </v-autocomplete>

            <v-text-field
              v-model="form.challonge_username"
              :rules="challongeUsernameRules"
              label="Challonge Username*"
            ></v-text-field>

            <v-text-field
              v-model="form.twitch"
              :rules="twitchRules"
              label="Twitch URL*"
              prefix="twitch.tv/"
            ></v-text-field>

            <v-text-field
              v-model="form.srl_username"
              :rules="srlUsernameRules"
              label="SpeedRunsLive Username"
            ></v-text-field>

            <v-text-field
              v-model="form.pronouns"
              :rules="pronounRules"
              label="Pronouns"
            ></v-text-field>

            <v-autocomplete
              v-model="form.timezone"
              :items="timezones"
              :rules="timezoneRules"
              label="Timezone"
              prepend-inner-icon="mdi-magnify"
            ></v-autocomplete>

            <v-text-field
              v-model="form.availability"
              :rules="availibilityRules"
              label="Availability"
              hint="What times are you most likely available to play?"
            ></v-text-field>

            <v-text-field
              v-model="form.flavor"
              :rules="flavorRules"
              label="Your special skill"
              hint="A fun special skill or note on your player card."
            ></v-text-field>
          </v-col>

          <v-col cols="12" md="5">
            <PlayerCard v-tilt :user="formatUser" />
          </v-col>
        </v-row>

        <h2>Special requirements</h2>
        <v-row>
          <v-col
            cols="12"
            md="4"
            v-for="impairment in impairments"
            :key="impairment.value"
          >
            <v-checkbox
              class="no-message"
              v-model="form.impairments"
              :label="impairment.name"
              :value="impairment.id"
            ></v-checkbox>
          </v-col>
        </v-row>

        <v-btn class="mt-2" color="primary" @click="submit" :loading="loading">
          {{ signedUp ? "Update Data" : "Sign up" }}
        </v-btn>
      </v-form>
    </v-container>
  </div>
</template>

<script>
export default {
  props: {
    impairments: Array,
    user: Object,
  },

  mounted() {
    this.form.timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    this.form.challonge_username = this.user.challonge_username;
    this.form.srl_username = this.user.srl_username;
    this.form.twitch = this.user.twitch;
    this.form.pronouns = this.user.pronouns;
    this.form.timezone = this.user.timezone;
    this.form.availability = this.user.availability;
    this.form.flag = this.user.flag;

    if (this.signedUp) {
      this.form.flavor = this.$page.props.auth.user.events[1].pivot.flavor;
    }

    for (let impairment of this.user.impairments) {
      this.form.impairments.push(impairment.id);
    }
  },

  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.form.post(route("signUp"));
      }
    },
  },

  computed: {
    signedUp() {
      if (!this.$page.props.auth.user) {
        return false;
      }

      return (
        this.$page.props.auth.user.events.find((event) => event.id === 4) !==
        undefined
      );
    },

    timezones() {
      return Intl.supportedValuesOf("timeZone");
    },

    formatUser() {
      return {
        username: this.$page.props.auth.user.username,
        avatar: this.$page.props.auth.user.avatar,
        flavor: this.form.flavor,
        flag: this.form.flag,
      };
    },
  },

  data() {
    return {
      form: this.$inertia.form({
        challonge_username: "",
        srl_username: "",
        twitch: "",
        pronouns: "",
        timezone: "",
        availability: "",
        flavor: "",
        flag: "",
        impairments: [],
      }),

      loading: false,

      challongeUsernameRules: [(v) => !!v || "Challonge username is required"],
      srlUsernameRules: [],
      flagRules: [(v) => !!v || "Flag is required"],
      twitchRules: [(v) => !!v || "Twitch URL is required"],
      pronounRules: [],
      timezoneRules: [],
      availibilityRules: [],
      flavorRules: [],

      flags: [
        { img: "af.svg", name: "Afghanistan" },
        { img: "a-gender.svg", name: "Agender" },
        { img: "ax.svg", name: "Aland Islands" },
        { img: "al.svg", name: "Albania" },
        { img: "dz.svg", name: "Algeria" },
        { img: "as.svg", name: "American Samoa" },
        { img: "ad.svg", name: "Andorra" },
        { img: "ao.svg", name: "Angola" },
        { img: "ai.svg", name: "Anguilla" },
        { img: "aq.svg", name: "Antarctica" },
        { img: "ag.svg", name: "Antigua And Barbuda" },
        { img: "ar.svg", name: "Argentina" },
        { img: "am.svg", name: "Armenia" },
        { img: "a-romantic.svg", name: "Aromantic" },
        { img: "aw.svg", name: "Aruba" },
        { img: "au.svg", name: "Australia" },
        { img: "at.svg", name: "Austria" },
        { img: "az.svg", name: "Azerbaijan" },
        { img: "bs.svg", name: "Bahamas" },
        { img: "bh.svg", name: "Bahrain" },
        { img: "bd.svg", name: "Bangladesh" },
        { img: "bb.svg", name: "Barbados" },
        { img: "by.svg", name: "Belarus" },
        { img: "be.svg", name: "Belgium" },
        { img: "bz.svg", name: "Belize" },
        { img: "bj.svg", name: "Benin" },
        { img: "bm.svg", name: "Bermuda" },
        { img: "bt.svg", name: "Bhutan" },
        { img: "bi.svg", name: "Bi" },
        { img: "bo.svg", name: "Bolivia" },
        { img: "ba.svg", name: "Bosnia And Herzegovina" },
        { img: "bw.svg", name: "Botswana" },
        { img: "bv.svg", name: "Bouvet Island" },
        { img: "br.svg", name: "Brazil" },
        { img: "io.svg", name: "British Indian Ocean Territory" },
        { img: "bn.svg", name: "Brunei Darussalam" },
        { img: "bg.svg", name: "Bulgaria" },
        { img: "bf.svg", name: "Burkina Faso" },
        { img: "bi.svg", name: "Burundi" },
        { img: "kh.svg", name: "Cambodia" },
        { img: "cm.svg", name: "Cameroon" },
        { img: "ca.svg", name: "Canada" },
        { img: "cv.svg", name: "Cape Verde" },
        { img: "ky.svg", name: "Cayman Islands" },
        { img: "cf.svg", name: "Central African Republic" },
        { img: "td.svg", name: "Chad" },
        { img: "cl.svg", name: "Chile" },
        { img: "cn.svg", name: "China" },
        { img: "cx.svg", name: "Christmas Island" },
        { img: "cc.svg", name: "Cocos (Keeling) Islands" },
        { img: "co.svg", name: "Colombia" },
        { img: "km.svg", name: "Comoros" },
        { img: "cg.svg", name: "Congo" },
        { img: "cd.svg", name: "Congo, Democratic Republic" },
        { img: "ck.svg", name: "Cook Islands" },
        { img: "cr.svg", name: "Costa Rica" },
        { img: "ci.svg", name: 'Cote D"Ivoire' },
        { img: "hr.svg", name: "Croatia" },
        { img: "cu.svg", name: "Cuba" },
        { img: "cy.svg", name: "Cyprus" },
        { img: "cz.svg", name: "Czech Republic" },
        { img: "demisexual.svg", name: "Demisexual" },
        { img: "dk.svg", name: "Denmark" },
        { img: "dj.svg", name: "Djibouti" },
        { img: "dm.svg", name: "Dominica" },
        { img: "do.svg", name: "Dominican Republic" },
        { img: "ec.svg", name: "Ecuador" },
        { img: "eg.svg", name: "Egypt" },
        { img: "sv.svg", name: "El Salvador" },
        { img: "gq.svg", name: "Equatorial Guinea" },
        { img: "er.svg", name: "Eritrea" },
        { img: "ee.svg", name: "Estonia" },
        { img: "et.svg", name: "Ethiopia" },
        { img: "fk.svg", name: "Falkland Islands (Malvinas)" },
        { img: "fo.svg", name: "Faroe Islands" },
        { img: "fj.svg", name: "Fiji" },
        { img: "fi.svg", name: "Finland" },
        { img: "fr.svg", name: "France" },
        { img: "gf.svg", name: "French Guiana" },
        { img: "pf.svg", name: "French Polynesia" },
        { img: "tf.svg", name: "French Southern Territories" },
        { img: "ga.svg", name: "Gabon" },
        { img: "gm.svg", name: "Gambia" },
        { img: "gay.svg", name: "Gay" },
        { img: "genderfluid.svg", name: "Genderqueer" },
        { img: "ge.svg", name: "Georgia" },
        { img: "de.svg", name: "Germany" },
        { img: "gh.svg", name: "Ghana" },
        { img: "gi.svg", name: "Gibraltar" },
        { img: "gr.svg", name: "Greece" },
        { img: "gl.svg", name: "Greenland" },
        { img: "gd.svg", name: "Grenada" },
        { img: "gp.svg", name: "Guadeloupe" },
        { img: "gu.svg", name: "Guam" },
        { img: "gt.svg", name: "Guatemala" },
        { img: "gg.svg", name: "Guernsey" },
        { img: "gn.svg", name: "Guinea" },
        { img: "gw.svg", name: "Guinea-Bissau" },
        { img: "gy.svg", name: "Guyana" },
        { img: "ht.svg", name: "Haiti" },
        { img: "hm.svg", name: "Heard Island & Mcdonald Islands" },
        { img: "va.svg", name: "Holy See (Vatican City State)" },
        { img: "hn.svg", name: "Honduras" },
        { img: "hk.svg", name: "Hong Kong" },
        { img: "hu.svg", name: "Hungary" },
        { img: "is.svg", name: "Iceland" },
        { img: "in.svg", name: "India" },
        { img: "id.svg", name: "Indonesia" },
        { img: "inter.svg", name: "Inter" },
        { img: "ir.svg", name: "Iran, Islamic Republic Of" },
        { img: "iq.svg", name: "Iraq" },
        { img: "ie.svg", name: "Ireland" },
        { img: "im.svg", name: "Isle Of Man" },
        { img: "il.svg", name: "Israel" },
        { img: "it.svg", name: "Italy" },
        { img: "jm.svg", name: "Jamaica" },
        { img: "jp.svg", name: "Japan" },
        { img: "je.svg", name: "Jersey" },
        { img: "jo.svg", name: "Jordan" },
        { img: "kz.svg", name: "Kazakhstan" },
        { img: "ke.svg", name: "Kenya" },
        { img: "ki.svg", name: "Kiribati" },
        { img: "kr.svg", name: "Korea" },
        { img: "kw.svg", name: "Kuwait" },
        { img: "kg.svg", name: "Kyrgyzstan" },
        { img: "la.svg", name: 'Lao People"s Democratic Republic' },
        { img: "lv.svg", name: "Latvia" },
        { img: "lb.svg", name: "Lebanon" },
        { img: "lesbian.svg", name: "Lesbian" },
        { img: "ls.svg", name: "Lesotho" },
        { img: "lr.svg", name: "Liberia" },
        { img: "ly.svg", name: "Libyan Arab Jamahiriya" },
        { img: "li.svg", name: "Liechtenstein" },
        { img: "lt.svg", name: "Lithuania" },
        { img: "lu.svg", name: "Luxembourg" },
        { img: "mo.svg", name: "Macao" },
        { img: "mk.svg", name: "Macedonia" },
        { img: "mg.svg", name: "Madagascar" },
        { img: "mw.svg", name: "Malawi" },
        { img: "my.svg", name: "Malaysia" },
        { img: "mv.svg", name: "Maldives" },
        { img: "ml.svg", name: "Mali" },
        { img: "mt.svg", name: "Malta" },
        { img: "mh.svg", name: "Marshall Islands" },
        { img: "mq.svg", name: "Martinique" },
        { img: "mr.svg", name: "Mauritania" },
        { img: "mu.svg", name: "Mauritius" },
        { img: "yt.svg", name: "Mayotte" },
        { img: "mx.svg", name: "Mexico" },
        { img: "fm.svg", name: "Micronesia, Federated States Of" },
        { img: "md.svg", name: "Moldova" },
        { img: "mc.svg", name: "Monaco" },
        { img: "mn.svg", name: "Mongolia" },
        { img: "me.svg", name: "Montenegro" },
        { img: "ms.svg", name: "Montserrat" },
        { img: "ma.svg", name: "Morocco" },
        { img: "mz.svg", name: "Mozambique" },
        { img: "mm.svg", name: "Myanmar" },
        { img: "ghost.png", name: "Mystery Ghost" },
        { img: "na.svg", name: "Namibia" },
        { img: "nr.svg", name: "Nauru" },
        { img: "np.svg", name: "Nepal" },
        { img: "nl.svg", name: "Netherlands" },
        { img: "nc.svg", name: "New Caledonia" },
        { img: "nz.svg", name: "New Zealand" },
        { img: "ni.svg", name: "Nicaragua" },
        { img: "ne.svg", name: "Niger" },
        { img: "ng.svg", name: "Nigeria" },
        { img: "nu.svg", name: "Niue" },
        { img: "nonbinary.svg", name: "Non-Binary" },
        { img: "nf.svg", name: "Norfolk Island" },
        { img: "kp.svg", name: "North Korea" },
        { img: "mp.svg", name: "Northern Mariana Islands" },
        { img: "no.svg", name: "Norway" },
        { img: "om.svg", name: "Oman" },
        { img: "pk.svg", name: "Pakistan" },
        { img: "pw.svg", name: "Palau" },
        { img: "ps.svg", name: "Palestinian Territory, Occupied" },
        { img: "pan.svg", name: "Pan" },
        { img: "pa.svg", name: "Panama" },
        { img: "pg.svg", name: "Papua New Guinea" },
        { img: "py.svg", name: "Paraguay" },
        { img: "pe.svg", name: "Peru" },
        { img: "ph.svg", name: "Philippines" },
        { img: "pn.svg", name: "Pitcairn" },
        { img: "pl.svg", name: "Poland" },
        { img: "poly-sexuality.svg", name: "Poly-Sexuality" },
        { img: "pt.svg", name: "Portugal" },
        { img: "pr.svg", name: "Puerto Rico" },
        { img: "qa.svg", name: "Qatar" },
        { img: "rainbow.svg", name: "Rainbow" },
        { img: "rainbow-philadelphia.svg", name: "Rainbow Philadelphia" },
        { img: "rainbow-progress.svg", name: "Rainbow Progress" },
        { img: "re.svg", name: "Reunion" },
        { img: "ro.svg", name: "Romania" },
        { img: "ru.svg", name: "Russian Federation" },
        { img: "rw.svg", name: "Rwanda" },
        { img: "bl.svg", name: "Saint Barthelemy" },
        { img: "sh.svg", name: "Saint Helena" },
        { img: "kn.svg", name: "Saint Kitts And Nevis" },
        { img: "lc.svg", name: "Saint Lucia" },
        { img: "mf.svg", name: "Saint Martin" },
        { img: "pm.svg", name: "Saint Pierre And Miquelon" },
        { img: "vc.svg", name: "Saint Vincent And Grenadines" },
        { img: "ws.svg", name: "Samoa" },
        { img: "sm.svg", name: "San Marino" },
        { img: "st.svg", name: "Sao Tome And Principe" },
        { img: "sa.svg", name: "Saudi Arabia" },
        { img: "scotland-pride.svg", name: "Scotland" },
        { img: "sn.svg", name: "Senegal" },
        { img: "rs.svg", name: "Serbia" },
        { img: "a-sexuality.svg", name: "Sexuality" },
        { img: "sc.svg", name: "Seychelles" },
        { img: "sl.svg", name: "Sierra Leone" },
        { img: "sg.svg", name: "Singapore" },
        { img: "sk.svg", name: "Slovakia" },
        { img: "si.svg", name: "Slovenia" },
        { img: "sb.svg", name: "Solomon Islands" },
        { img: "so.svg", name: "Somalia" },
        { img: "za.svg", name: "South Africa" },
        { img: "gs.svg", name: "South Georgia And Sandwich Isl." },
        { img: "es.svg", name: "Spain" },
        { img: "lk.svg", name: "Sri Lanka" },
        { img: "sd.svg", name: "Sudan" },
        { img: "sr.svg", name: "Suriname" },
        { img: "sj.svg", name: "Svalbard And Jan Mayen" },
        { img: "sz.svg", name: "Swaziland" },
        { img: "se.svg", name: "Sweden" },
        { img: "ch.svg", name: "Switzerland" },
        { img: "sy.svg", name: "Syrian Arab Republic" },
        { img: "tw.svg", name: "Taiwan" },
        { img: "tj.svg", name: "Tajikistan" },
        { img: "tz.svg", name: "Tanzania" },
        { img: "th.svg", name: "Thailand" },
        { img: "tl.svg", name: "Timor-Leste" },
        { img: "tg.svg", name: "Togo" },
        { img: "tk.svg", name: "Tokelau" },
        { img: "to.svg", name: "Tonga" },
        { img: "trans.svg", name: "Trans" },
        { img: "tt.svg", name: "Trinidad And Tobago" },
        { img: "tn.svg", name: "Tunisia" },
        { img: "tr.svg", name: "Turkey" },
        { img: "tm.svg", name: "Turkmenistan" },
        { img: "tc.svg", name: "Turks And Caicos Islands" },
        { img: "tv.svg", name: "Tuvalu" },
        { img: "ug.svg", name: "Uganda" },
        { img: "ua.svg", name: "Ukraine" },
        { img: "ae.svg", name: "United Arab Emirates" },
        { img: "gb.svg", name: "United Kingdom" },
        { img: "us.svg", name: "United States" },
        { img: "um.svg", name: "United States Outlying Islands" },
        { img: "uy.svg", name: "Uruguay" },
        { img: "uz.svg", name: "Uzbekistan" },
        { img: "vu.svg", name: "Vanuatu" },
        { img: "ve.svg", name: "Venezuela" },
        { img: "vn.svg", name: "Vietnam" },
        { img: "vg.svg", name: "Virgin Islands, British" },
        { img: "vi.svg", name: "Virgin Islands, U.S." },
        { img: "wf.svg", name: "Wallis And Futuna" },
        { img: "eh.svg", name: "Western Sahara" },
        { img: "ye.svg", name: "Yemen" },
        { img: "zm.svg", name: "Zambia" },
        { img: "zw.svg", name: "Zimbabwe" },
      ],
    };
  },
};
</script>
