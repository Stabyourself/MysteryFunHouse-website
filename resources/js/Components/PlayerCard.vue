<template>
  <div class="player-card">
    <div class="player-card-header">
      <div>
        MFH<br />
        Club House<br />
        Membership
      </div>
    </div>

    <div class="d-flex player-card-middle">
      <img
        class="player-card-avatar"
        :src="'/storage/avatars/' + user.avatar"
        alt="Avatar"
      />

      <div>
        <div class="player-card-data">
          <div class="player-card-data-title">
            Name
          </div>
          <div class="player-card-data-value">
            {{ user.username }}
          </div>
        </div>

        <div class="player-card-data">
          <div class="player-card-data-title">
            Handicap
          </div>
          <div class="player-card-data-value">
            ?
          </div>
        </div>
      </div>
    </div>

    <div class="player-card-flavor">
      Notes
      <div class="flavor">
        {{ user.flavor }}
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
$primary: #008c6c;

.player-card {
  margin: 1rem;
  padding: 2rem;
  color: $primary;
  background: white;
  width: 300px;
  height: 475.7317525009262689885142645424px;
  border-radius: 5px;

  .player-card-header {
    display: flex;

    margin-bottom: 0.8rem;
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
    margin-bottom: 0.8rem;
    height: 133px;
  }

  .player-card-data {
    font-size: 1.3rem;
    line-height: 1.1;
    margin-bottom: 0.2rem;

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
    margin-bottom: 10px;
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
