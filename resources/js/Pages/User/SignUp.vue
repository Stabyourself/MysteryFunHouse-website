<template>
  <div>
    <Head title="Sign Up" />

    <h1 data-aos="fade-right">Sign<br />Up</h1>

    <v-container>
      <div v-if="!$page.props.auth.user" class="text-center">
        <p>Login first, Agent.</p>

        <v-btn color="primary" :href="route('login')">
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
                Welcome back Agent. Did your data change? Let HQ know here.
              </p>
            </div>

            <h2>Data</h2>

            <v-text-field
              v-model="form.challonge_username"
              :rules="challongeUsernameRules"
              label="Challonge Username"
            ></v-text-field>

            <v-text-field
              v-model="form.twitch"
              :rules="twitchRules"
              label="Twitch URL"
              prefix="twitch.tv/"
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
              hint="A fun special skill or note for your agent badge"
            ></v-text-field>

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
          </v-col>

          <v-col cols="12" md="4">
            <PlayerCard v-tilt :user="formatUser" />
          </v-col>
        </v-row>

        <v-btn class="mt-2" color="primary" @click="submit" :loading="loading">
          {{ signedUp ? "Update intel" : "Sign up" }}
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
    this.form.twitch = this.user.twitch;
    this.form.pronouns = this.user.pronouns;
    this.form.timezone = this.user.timezone;
    this.form.availability = this.user.availability;

    if (this.signedUp) {
      this.form.flavor = this.$page.props.auth.user.events[0].pivot.flavor;
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
      return this.$page.props.auth.user && this.$page.props.auth.user.events[0];
    },

    timezones() {
      return Intl.supportedValuesOf("timeZone");
    },

    formatUser() {
      return {
        username: this.$page.props.auth.user.username,
        avatar: this.$page.props.auth.user.avatar,
        flavor: this.form.flavor,
      };
    },
  },

  data() {
    return {
      form: this.$inertia.form({
        challonge_username: "",
        twitch: "",
        pronouns: "",
        timezone: "",
        availability: "",
        flavor: "",
        impairments: [],
      }),

      loading: false,

      challongeUsernameRules: [(v) => !!v || "Challonge username is required"],
      twitchRules: [(v) => !!v || "Twitch URL"],
      pronounRules: [],
      timezoneRules: [],
      availibilityRules: [],
      flavorRules: [],
    };
  },
};
</script>
