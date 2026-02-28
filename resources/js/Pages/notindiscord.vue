<template>
  <div>
    <Head title="Adventurers" />

    <h1 data-aos="fade-right">Sign<br />Up</h1>
    <p>
      <v-alert type="warning" outlined text
        >Seems like you aren't in the Mystery Tournament discord server. All
        organization of Mystery Fun House events happens there, and you need to
        join to participate.</v-alert
      >

      <div class="text-center">
      <v-btn
        data-aos="fade-up"
        data-aos-delay="200"
        data-aos-offset="-50"
        color="primary"
        :href="'https://discord.gg/AYr59EgzzR'"
        target="_blank"
        class="eightbitfont"
        x-large
        block
      >
        Join the Discord
      </v-btn>

      <p style="margin-top: 50px">And then try again!</p>
        <v-btn color="primary" :href="route('login')" x-large>
          <v-icon>
            mdi-discord
          </v-icon>
          Discord Login
        </v-btn>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    users: Array,
  },
};
</script>
