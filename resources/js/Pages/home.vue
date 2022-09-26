<template>
  <div>
    <Head title="Home" />

    <h1 data-aos="fade-right">Mystery<br />Fun House</h1>

    <v-container>
      <div
        class="letter-wrapper"
        data-aos="letter-animation"
        data-aos-delay="600"
      >
        <div class="letter">
          <div class="letter-head">
            From: M-FH<br />
            To: Double Oh Seventeen
          </div>

          <p>Greetings, esteemed operative.</p>

          <p>
            Your talents have earned you many accolades. This letter can be
            considered our own recognition of your abilities. They've taken you
            to great places in the past, and now, they've led you here.
          </p>

          <p>
            You stand at the precipice of an unseen world, teeming with
            thrilling challenges and marvelous discoveries. It is also a world
            fraught with peril - The minions of the shadowy Heff E. Trooper are
            capable and decisive.
          </p>

          <p>
            Your services could be what we need to turn the tables. Will you
            join our ranks and take on your greatest undertaking yet?
          </p>

          <p>We look forward to working with you, Agent Double Oh.</p>

          <p>
            Regards,<br />
            The Mystery Fun House
          </p>

          <p class="letter-muted">
            PS: This message will self-destruct in 60 seconds.
          </p>

          <img
            class="letter-stamp"
            src="/img/ghost_stamp.png"
            alt="The seal of M-FH"
          />
        </div>

        <div class="letter-burned-wrapper" :class="{ active: burned }">
          <div class="color-overlay"></div>

          <img class="burned-part" src="/img/paper_burned.png" />
        </div>
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
