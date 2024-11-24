<template>
  <div>
    <Head title="Home" />

    <h1 data-aos="fade-right">Mystery<br />Fun House</h1>

    <v-container>
      <div class="home-container">
        <p>
          <strong>Mystery Tournament</strong> is one of the oldest video game
          racing tournaments around, and anyone can join! The idea is simple:
          You don't know what game you're going to play, and your opponent
          doesn't know either! The winner will be decided by intuition, smart
          decisions, and raw skill.
        </p>

        <p>
          Without further ado, the Mystery Fun House is proud to present to
          you...
        </p>

        <img
          src="/img/mt19.png"
          alt="Mystery Tournament 19"
          class="home-image"
          data-aos="fade-down"
        />

        <div class="ye-olde-mt" data-aos="fade-up">
          <p>
            You wake up.
          </p>
          <p>
            Where are you? As you regain composure, you find yourself staring at
            an impossibly tall stone castle looming over you. The sky glows a
            pale red, reminding you of dusk, but with no clear source of any
            celestial glow. You crane your neck higher and higher, and despite
            significant effort and strain, you cannot see where the towers end
            and the sky begins.
          </p>
          <p>
            You know you have a quest, a purpose, a destiny to be in this place
            and time... but what is it? You look down at yourself, struggling to
            decipher what you're seeing. You can't quite put your finger on it,
            but you're... blurry? No, not blurry—just... maybe inconsistent is
            the right word. It seems you have a powerful magic wand, capable of
            defeating any foe with any number of impressive spells. But you also
            have a large green tail and layered scales. No, wait, you've always
            had this tail—or do you even have it now?
          </p>
          <p>
            Despite this strange feeling, this incomprehensible
            <span style="color: #ff010a">Mystery</span> of just who and what you
            are, you know it's more important to press on than to ponder.
          </p>
          <p>Just how tall is this castle, anyway...</p>
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
  computed: {
    signedUp() {
      if (!this.$page.props.auth.user) {
        return false;
      }

      return (
        this.$page.props.auth.user.events.find((event) => event.id === 3) !==
        undefined
      );
    },
  },

  data() {
    return {};
  },
};
</script>
