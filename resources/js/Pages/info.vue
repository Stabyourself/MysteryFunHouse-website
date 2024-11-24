<template>
  <div>
    <Head title="About" />

    <h1 data-aos="fade-right">Mystery<br />Tournament</h1>

    <v-container>
      <p>
        Mystery Tournament is one of the oldest speedrunning tournaments we know
        of. This is a double elimination tournament in which the goal is to race
        games that neither player in the race has seen before. The games are a
        Mystery to all who play them, hence Mystery Tournament. You'll race a
        20-60 minute goal with your opponent to see who can reach the end
        faster!
      </p>
      <p>
        This year's tournament will run starting from December 13th and is
        double elimination. There is no set schedule, instead you'll be expected
        to set a race time with whoever your opponent is through our discord by
        a fixed deadline each round. You'll stream your side of the race on
        Twitch and we'll restream most races at
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
            href="https://challonge.com/tournaments/signup/ERnFFjd5KP#/signup/evb906ycdsl"
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
          <a href="/signup" target="_blank">
            Sign Up
          </a>
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
      if (!this.$page.props.auth.user) {
        return false;
      }

      return (
        this.$page.props.auth.user.events.find((event) => event.id === 2) !==
        undefined
      );
    },
  },
};
</script>
