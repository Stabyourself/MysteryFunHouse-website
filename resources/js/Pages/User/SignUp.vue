<template>
  <div>
    <Head title="Sign Up" />

    <h1 data-aos="fade-right">Sign<br />Up</h1>

    <v-container>
      <div v-if="!$page.props.auth.user">
        <p>Login first, agent.</p>

        <v-btn color="#5865F2" :href="route('login')">
          <v-icon>
            mdi-discord
          </v-icon>
          Discord Login
        </v-btn>
      </div>

      <v-form ref="form" @click.prevent="submit" v-else>
        <v-row>
          <v-col cols="12" md="8">
            <div v-if="signedUp">
              <p>
                Welcome back agent. Did your data change? Let HQ know here.
              </p>
            </div>

            <h2>Data</h2>

            <v-text-field
              v-model="form.challonge_username"
              :rules="challongeUsernameRules"
              label="Challonge Username"
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
            ></v-autocomplete>

            <v-text-field
              v-model="form.availability"
              :rules="availibilityRules"
              label="Availability"
              hint="What times are you most likely available to play?"
            ></v-text-field>

            <v-text-field
              v-model="form.special_skill"
              :rules="specialSkillRules"
              label="Your special skill"
              hint="A fun special skill for your agent badge"
            ></v-text-field>
          </v-col>

          <v-col cols="12" md="4">
            -Agent badge here-
          </v-col>
        </v-row>

        <h2>Special requirements</h2>
        <v-checkbox
          class="no-message"
          v-for="impairment in impairments"
          :key="impairment.value"
          v-model="form.impairments"
          :label="impairment.text"
          :value="impairment.value"
        ></v-checkbox>

        <v-btn class="mt-2" color="primary" @click="submit">
          {{ signedUp ? "Update intel" : "Sign up" }}
        </v-btn>
      </v-form>
    </v-container>
  </div>
</template>

<script>
export default {
  mounted() {
    this.form.timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    console.log(this.form);
  },

  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        this.form.post(route("signUp"));
      }
    },
  },

  computed: {
    signedUp() {
      return this.$page.props.auth.user && this.$page.props.auth.user.signedUp;
    },

    timezones() {
      return Intl.supportedValuesOf("timeZone");
    },
  },

  data() {
    return {
      form: this.$inertia.form({
        challonge_username: "",
        pronouns: "",
        timezone: "",
        availability: "",
        special_skill: "",
        impairments: [],
      }),

      impairments: [
        { value: "nomouse", text: "I have no mouse" },
        { value: "nocontroller", text: "I have no controller" },
        { value: "colorblind", text: "I am colorblind" },
        { value: "hearingimpaired", text: "I am hearing impaired" },
        { value: "motionsickness", text: "I am sensitive to motion sickness" },
        { value: "epilipsy", text: "I am sensitive to flashing lights" },
        {
          value: "tpcpc",
          text: "I have difficulty running graphically intensive games",
        },
      ],

      challongeUsernameRules: [(v) => !!v || "Challonge username is required"],
      pronounRules: [],
      timezoneRules: [],
      availibilityRules: [],
      specialSkillRules: [],
    };
  },
};
</script>
