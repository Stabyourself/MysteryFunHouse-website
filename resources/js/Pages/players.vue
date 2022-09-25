<template>
  <div>
    <Head title="Secret Agents" />

    <h1 data-aos="fade-right">Secret<br />Agents</h1>

    <v-container>
      <div class="player-list">
        <PlayerCard v-tilt v-for="user in users" :key="user.id" :user="user" />
      </div>
    </v-container>
  </div>
</template>

<script>
export default {
  props: {
    users: Array,
  },
};
</script>
