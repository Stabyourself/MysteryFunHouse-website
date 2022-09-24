<template>
  <div>
    <Head title="Home" />

    <h1 data-aos="fade-right">Mystery<br />Fun House</h1>

    <v-container>
      <div class="letter" data-aos="letter-animation" data-aos-delay="600">
        <div class="letter-head">
          From: M-FH<br />
          To: Double Oh Seventeen
        </div>

        <p>Hello Agent,</p>

        <p>
          Welcome to the Mystery Fun House! We are glad to have you on board.
        </p>

        <p>
          Our latest intel shows that the nefarious Haff E. Troopa is up to no
          good again. He has shuffled all the games in this event around,
          requiring you to play games you have never seen before.
        </p>

        <p>
          The ministry of mystery, fun, and house requires your help in stopping
          him. Sign up for your most dangerous mission yet: Mystery Tournament
          17.
        </p>

        <p>Good luck, Agent!</p>

        <img
          class="letter-stamp"
          src="/img/ghost_stamp.png"
          alt="The seal of M-FH"
        />

        <p class="letter-muted">
          PS: This message will self-destruct in 60 seconds.
        </p>
      </div>

      <div class="dangerous-text" data-aos="fade-down">
        MT0017 – your most dangerous mission yet
      </div>

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
            Mission briefing
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  computed: {
    signedUp() {
      return this.$page.props.auth.user && this.$page.props.auth.user.signedUp;
    },
  },
};
</script>
