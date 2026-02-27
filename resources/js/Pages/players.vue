<template>
  <div>
    <Head title="Adventurers" />

    <h1 data-aos="fade-right">Robot Masters</h1>

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
