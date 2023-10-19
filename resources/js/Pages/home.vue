<template>
  <div>
    <Head title="Home" />

    <h1 data-aos="fade-right">Mystery<br />Fun House</h1>

    <v-container>
      MT is back and so on wow you can sign up bla bla bla

      <v-row>
        <v-col cols="12" md="6">
          <v-btn
            data-aos="fade-up"
            data-aos-delay="200"
            data-aos-offset="-50"
            color="primary"
            :to="route('signUpForm')"
            x-large
            block
          >
            <div v-if="signedUp">
              Edit signup data
            </div>
            <div v-else>
              Sign up now!
            </div>
          </v-btn>
        </v-col>
        <v-col cols="12" md="6">
          <v-btn
            data-aos="fade-up"
            data-aos-delay="400"
            data-aos-offset="-50"
            color="grey"
            :to="route('info')"
            x-large
            block
          >
            What is Mystery Tournament?
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  mounted() {
    setTimeout(() => {
      this.burned = true;
    }, 60000);
  },

  computed: {
    signedUp() {
      return this.$page.props.auth.user && this.$page.props.auth.user.events[0];
    },
  },

  data() {
    return {
      burned: false,
    };
  },
};
</script>
