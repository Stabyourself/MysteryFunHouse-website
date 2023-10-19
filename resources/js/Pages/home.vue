<template>
  <div>
    <Head title="Home" />

    <h1 data-aos="fade-right">Mystery<br />Fun House</h1>

    <v-container>
      <div class="home-container">
        <div class="home-image">
          <img src="/img/MT18mkVIII.png" />
        </div>
        <div class="home-text">
          <p>
            It's a beautiful day out on the links. You see the sun begin to peek
            above the raised green of the 17th hole. You're comfortable,
            confident, and sink your putt easily on the first try. 3 under par,
            you're ready to take on anything. But you've heard stories about the
            18th hole. Even the best of players are often bested by it.
            Inconsistencies, anomalies, some may even say Mysteries await you as
            you warily approach the final challenge...
          </p>

          <p>
            Mystery Tournament is one of the oldest video game racing
            tournaments around. The idea is simple: You don't know what game
            you're going to play, and your opponent doesn't know either! How can
            you beat someone in a game that neither player has practiced or even
            seen before? Well someone's going to win the match, and it just
            might be you.
          </p>

          <p>
            Are you a natural gamer, able to inhabit the sprites and models on
            screen in a matter of seconds? Are you thinking 4 steps ahead of
            your character's position, effortlessly plotting out the optimal
            movement path for peak efficiency? Then this tournament may be for
            you. Even if you don't redefine what it means to be a gamer, this
            tournament will give you the opportunity to watch matches, make
            friends, and most important play games you're unlikely to see
            anywhere else. We hope to see you there.
          </p>
        </div>
      </div>

      <v-row style="margin-top: 1em;">
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
