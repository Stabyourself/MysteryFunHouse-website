<template>
  <div>
    <Head title="About" />

    <h1 data-aos="fade-right">Mystery<br />Tournament</h1>

    <v-container>
      <p>
        Mystery Tournament sets before its players the fascinating and
        challenging task of speedrunning a game they have never played before.
        When you and your opponent show up for your match, you'll be randomly
        given a game from a pool of curated submissions from players past and
        present. Once you're both set up, the race begins! The first player to
        complete the assigned 20-60 minute goal is the winner. The tournament
        format is double elimination, so you'll always have at least two
        matches.
      </p>
      <p>
        Mystery Tournament has been going strong since 2012, making it one of
        speedrunning's oldest tournaments, and over these years it has built up
        a diverse community of people who simply love playing games.
      </p>
      <p>
        Mystery Tournament has a flexible schedule. Players will be expected to
        schedule a race time with their opponents through our Discord server
        within a fixed deadline each round, typically 1-2 weeks. You'll stream
        your side of the race on Twitch and we'll restream most races at
        <a href="https://twitch.tv/mysteryfunhouse" target="_blank"
          >our Twitch channel</a
        >
        with commentary. Please join our Discord and check out the signup steps
        to get racing!
      </p>

      <h2>Steps to sign up</h2>
      <ul>
        <li>
          <a href="https://discord.gg/AYr59EgzzR" target="_blank"
            >Join Our Discord</a
          >
        </li>
        <li>
          Register on
          <a
            href="https://speedrunslive.challonge.com/mysterytournamentxx"
            target="_blank"
          >
            Challonge</a
          >
          and join the tournament
        </li>
        <!--<li>Set up SpeedRunsLive which we use to track races:</li>
        <div class="signup-box">
          <li>
            Click on the
            <a href="/irc" target="_blank">IRC</a>
            tab
          </li>
          <li>Type in your username with no password</li>
          <li>
            Type in the chat
            <code>/nickserv register <i>password email</i></code> (where you
            fill in the password and email)
          </li>
          <li>
            Type in the chat
            <code>.setstream twitch.tv/<i>yourtwitch</i></code>
            (where you fill in your own twitch channel)
          </li>
          <li>
            You're done! Now next time when you click on the IRC tab put in your
            correct username and password you just set to log in
          </li>
        </div>-->
        <li>
          <a href="/signup" target="_blank"> Sign Up </a>
          on this site
        </li>
      </ul>

      <p>
        Now you're all signed up! We'd love it if you'd also
        <a
          href="
        https://docs.google.com/forms/d/e/1FAIpQLSe-dbLbrdwuISSNHtzs1EQ-3ABGpKW61ALicIiTOTmK3WK5BQ/viewform"
          target="_blank"
          >submit some games</a
        >
        for us to race! If you're new make sure to read the sub guidelines at
        the top of that form.
      </p>

      <div class="dangerous-text" data-aos="fade-down">Sounds fun?</div>

      <div class="text-center">
        <v-btn
          data-aos="fade-up"
          data-aos-delay="200"
          data-aos-offset="-50"
          color="primary"
          :to="route('signUpForm')"
          x-large
        >
          <div v-if="signedUp">Edit signup data</div>
          <div v-else>Sign up now!</div>
        </v-btn>
      </div>
    </v-container>
  </div>
</template>

<script>
export default {
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
  },
};
</script>
