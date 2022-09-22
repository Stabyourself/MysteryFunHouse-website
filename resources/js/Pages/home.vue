<template>
  <div>
    <Head title="Home" />

    <v-container>
      <v-slide-x-transition appear :duration="{ enter: 1000, leave: 800 }">
        <h1>
          Mystery Fun House
        </h1>
      </v-slide-x-transition>

      <div class="letter">
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

        <p>PS: This message will self-destruct in 60 seconds.</p>
      </div>

      <div class="mx-auto my-5" style="max-width: 500px">
        <v-btn color="primary" :to="route('signUpForm')" x-large block>
          <div v-if="signedUp">
            Edit signup data
          </div>
          <div v-else>
            Sign up now!
          </div>
        </v-btn>
      </div>

      <p>
        Mystery Tournament is an event in which players will participate in a
        series of matches, racing against a single opponent per round in short
        to medium length goals. These goals will be for games that are not
        revealed until moments before the race actually begins, with just enough
        time to download the game.
      </p>

      <p>
        Players are likely to encounter games they've never played before, seen
        before, or, most frequently, have never even heard of. This event is
        designed to determine not just who has the most gaming experience but
        the best overall racing abilities!
      </p>
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
