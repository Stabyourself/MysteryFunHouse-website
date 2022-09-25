<template>
  <div class="player-card">
    <div class="player-card-header">
      <div>
        <img src="/img/ghost_outline.png" alt="MFH Logo" />
      </div>

      <div>
        Mystery<br />
        Fun<br />
        House <span class="player-card-header-muted">MFH</span>
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
            Rank
          </div>
          <div class="player-card-data-value">
            Agent
          </div>
        </div>
      </div>
    </div>

    <div class="player-card-flavor">
      {{ user.flavor }}
    </div>

    <canvas ref="canvas"></canvas>
  </div>
</template>

<style lang="scss" scoped>
$primary: #b1a460;

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
    }
  }

  .player-card-flavor {
    height: 130px;
    width: 100%;
  }
}

canvas {
  width: 100%;
  height: 50px;
}
</style>

<script>
import * as PDF417 from "pdf417-generator";

export default {
  mounted() {
    const canvas = this.$refs.canvas;
    let data = `Agent ${this.user.username}`;

    PDF417.draw(data, canvas, 5);
  },

  props: {
    user: Object,
  },
};
</script>
