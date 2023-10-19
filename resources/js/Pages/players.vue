<template>
  <div>
    <Head title="Players" />

    <h1 data-aos="fade-right">Pro<br />Players</h1>

    <div class="player-list">
      <PlayerCard v-tilt v-for="user in users" :key="user.id" :user="user" />
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
