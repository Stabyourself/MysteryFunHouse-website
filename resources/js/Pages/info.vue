<template>
  <div>
    <Head title="Intel" />

    <h1 data-aos="fade-right">Mystery<br />Tournament</h1>

    <v-container>
      <p>
        Bla bla bla.
      </p>

      <div class="dangerous-text" data-aos="fade-down">
        Sounds fun?
      </div>

      <div class="text-center">
        <v-btn
          data-aos="fade-up"
          data-aos-delay="200"
          data-aos-offset="-50"
          color="primary"
          :to="route('signUpForm')"
          x-large
        >
          <div v-if="signedUp">
            Edit signup data
          </div>
          <div v-else>
            Sign up now!
          </div>
        </v-btn>
      </div>
    </v-container>
  </div>
</template>

<script>
export default {
  computed: {
    signedUp() {
      return this.$page.props.auth.user && this.$page.props.auth.user.events[0];
    },
  },
};
</script>
