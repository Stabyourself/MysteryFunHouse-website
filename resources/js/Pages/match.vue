<template>
  <div>
    <Head title="Your Match" />

    <h1 data-aos="fade-right">Your<br />Match</h1>

    <v-container>
      <div v-if="opponentLoading">
        <v-progress-circular
          indeterminate
          color="primary"
        ></v-progress-circular>
      </div>

      <div v-else>
        <div v-if="opponentError">
          <p v-if="opponentError === 'no_challonge_id'">
            Couldn't find you on challonge. Did you enter your challonge name
            correctly? Are you even in the tournament!?!?
          </p>

          <p v-if="opponentError === 'no_opponent'">
            You have a match, but I couldn't find your opponent in the tourney.
            Tell Maurice.
          </p>

          <div v-if="opponentError === 'no_login'">
            <p>Login first.</p>

            <v-btn color="primary" :href="route('login')">
              <v-icon>
                mdi-discord
              </v-icon>
              Discord Login
            </v-btn>
          </div>

          <div v-if="opponentError === 'no_match'">
            <p>You don't have a match yet.</p>
          </div>
        </div>

        <div v-if="opponent">
          <div class="match-container">
            <PlayerCard v-tilt :user="opponent" />
            <div>
              <p>Your opponent is {{ opponent.username }}!</p>
              <p>The time in their timezone right now is {{ opponentTime }}</p>
              <p>
                They describe their availability as:<br />
                <code>{{ opponent.availability }}</code>
              </p>
              <p>Good luck!</p>
            </div>
          </div>
        </div>
      </div>
    </v-container>
  </div>
</template>

<style scoped lang="scss">
.match-container {
  display: flex;
  gap: 20px;
}

@media (max-width: 800px) {
  .match-container {
    flex-direction: column;
  }
}
</style>

<script>
import axios from "axios";

export default {
  mounted() {
    this.opponentLoading = true;
    axios
      .get("/api/opponent")
      .then((response) => {
        this.opponentLoading = false;
        this.opponent = response.data;
        this.getOpponentTime();
      })
      .catch((error) => {
        this.opponentLoading = false;
        this.opponentError = error.response.data.error;
      });

    setInterval(() => {
      this.getOpponentTime();
    }, 1000);
  },

  methods: {
    getOpponentTime() {
      if (!this.opponent) {
        return null;
      }

      let options = {
          timeZone: this.opponent.timezone,
          year: "numeric",
          month: "numeric",
          day: "numeric",
          hour: "numeric",
          minute: "numeric",
          second: "numeric",
        },
        formatter = new Intl.DateTimeFormat([], options);
      this.opponentTime = formatter.format(new Date());
    },
  },

  data() {
    return {
      opponentLoading: true,
      opponentError: null,
      opponent: null,
      opponentTime: null,
    };
  },
};
</script>
