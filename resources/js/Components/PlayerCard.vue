<template>
  <div class="player-card">
    <div class="player-card-header">
      <div>
        Mystery<br />
        Guild Card
      </div>
    </div>

    <div class="d-flex player-card-middle">
      <img
        class="player-card-avatar"
        :src="'/storage/avatars/' + user.avatar"
        alt="Avatar"
      />
    </div>

    <div class="player-card-data">
      <div>
        <div class="player-card-data-title">
          Name
        </div>
        <div class="player-card-data-value">
          {{ user.username }}
        </div>
        <Flag :code="user.flag" />
      </div>
    </div>

    <div class="player-card-flavor">
      Notes/Special Skill
      <div class="flavor">
        {{ user.flavor }}
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
$primary: #ff010a;

.player-card {
  margin: 0rem;
  padding: 2rem;
  color: $primary;
  background: white;
  width: 300px;
  height: 475px;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
  gap: 10px;

  .player-card-header {
    display: flex;

    text-transform: uppercase;
    line-height: 1;
    font-family: "Poppins", Arial, sans-serif;
    font-size: 1.7rem;
    font-weight: 800;
    white-space: nowrap;

    img {
      width: 80px;
      margin-right: 5px;
      margin-top: 10px;
    }

    .player-card-header-muted {
      font-weight: 300;
    }
  }

  .player-card-avatar {
    margin-right: 6px;
    width: 100px;
    height: 100px;
    background: $primary;
    border: 3px solid $primary;
  }

  .player-card-middle {
  }

  .player-card-data {
    font-size: 1.3rem;
    line-height: 1.1;
    display: flex;
    gap: 10px;

    .player-card-data-value {
      text-transform: uppercase;
      font-weight: 800;
      word-break: break-all;
      color: black;
      opacity: 0.8;
      max-height: 69px;
      overflow: hidden;
    }
  }

  .player-card-flavor {
    height: 120px;
    width: 100%;
    overflow: hidden;

    .flavor {
      color: black;
      opacity: 0.8;
      word-break: break-word;
    }
  }
}

canvas {
  width: 100%;
  height: 50px;
  opacity: 0.8;
}
</style>

<script>
export default {
  props: {
    user: Object,
  },
};
</script>
