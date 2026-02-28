<template>
  <div>
    <Head title="Home" />

    <v-container>
      <div class="home-container">
        <div class="logo-info-box">
          <!-- <div id="ghost-scene-container"></div> -->
          <img
            src="/img/mt20.png"
            alt="Mystery Tournament 20XX Logo"
            class="home-image image-nearest"
            data-aos="fade-down"
          />

          <div class="mt20-border mt20-info" data-aos="fade-up">
            <ul>
              <li>1v1 Bracket</li>
              <li>Double Elim</li>
              <li>Surprise Games</li>
              <li>PC & Console</li>
              <li>~45 Minutes</li>
            </ul>
          </div>
        </div>

        <div class="main-text">
          <p>
            <strong>Mystery Tournament</strong> is a long-running,
            community-driven racing event built around surprise and skill.
            Players race to complete goals from one of a wide variety of games —
            platformers, puzzle games, racing games, arcade games, and more.
          </p>

          <p>
            We're excited to bring you our 20th anniversary,
            <strong>Mystery Tournament 20XX</strong>. Sign up to test your
            instincts or check below to learn more about how it works.
          </p>
        </div>
      </div>

      <div class="d-flex">
        <div class="flex-grow-1">
          <v-btn
            data-aos="fade-up"
            data-aos-delay="200"
            data-aos-offset="-50"
            color="primary"
            :to="route('signUpForm')"
            class="eightbitfont"
            x-large
            block
          >
            <div v-if="signedUp">
              Edit signup data
            </div>
            <div v-else>
              {{ signUpText }}
            </div>
          </v-btn>
        </div>
      </div>

      <h2>How it works</h2>

      <div class="steps">
        <div class="step">
          <div class="top">
            <div class="number">1</div>
            <div class="title">Sign Up</div>
          </div>
          <div class="content">
            Sign up for the tournament using the button above.
          </div>
        </div>

        <div class="arrow"><div class="arrow-inner"></div></div>

        <div class="step">
          <div class="top">
            <div class="number">2</div>
            <div class="title">Get Matched</div>
          </div>
          <div class="content">
            Once the tournament starts, you'll be matched with an opponent.
          </div>
        </div>

        <div class="arrow"><div class="arrow-inner"></div></div>

        <div class="step">
          <div class="top">
            <div class="number">3</div>
            <div class="title">Schedule</div>
          </div>
          <div class="content">
            Agree on a time with your opponent and let us know.
          </div>
        </div>

        <div class="arrow"><div class="arrow-inner"></div></div>

        <div class="step">
          <div class="top">
            <div class="number">4</div>
            <div class="title">Play</div>
          </div>
          <div class="content">
            On racing day, you'll get a random game that neither of you have
            played. Win to advance!
          </div>
        </div>
      </div>

      <h2>Watch it in action</h2>

      <div class="video-container">
        <iframe
          src="https://www.youtube.com/embed/Z346jwjD_vU?si=wP_V-n91CRCzD1Nl"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin"
          allowfullscreen
        ></iframe>
      </div>

      <div class="d-flex">
        <div class="flex-grow-1">
          <v-btn
            data-aos="fade-up"
            data-aos-delay="200"
            data-aos-offset="-50"
            color="primary"
            :to="route('signUpForm')"
            class="eightbitfont"
            x-large
            block
          >
            <div v-if="signedUp">
              Edit signup data
            </div>
            <div v-else>
              {{ signUpText }}
            </div>
          </v-btn>
        </div>
      </div>
    </v-container>

    <!-- <script type="module" src="/js/ghost_scene.js"></script> -->
  </div>
</template>

<style lang="scss" scoped>
$primary: #1976d2;

.video-container {
  width: 100%;
  aspect-ratio: 16 / 9;
  margin: 2rem 0;

  iframe {
    width: 100%;
    height: 100%;
  }
}

.main-text {
  margin-top: 3rem;
  margin-bottom: 3rem;
  text-align: center;
  font-size: 1.1rem;
}

.steps {
  display: flex;
  margin-top: 2rem;
  flex-wrap: wrap;
  box-sizing: border-box;
  align-items: stretch;

  .step {
    display: flex;
    align-items: stretch;
    flex-direction: column;
    border: 5px solid $primary;
    flex: 1;
    margin-bottom: 1rem;
    border-radius: 5px;

    .top {
      display: flex;
      font-size: 1.2rem;
      line-height: 1.5;
      font-weight: 700;
      width: 100%;
      gap: 1rem;
      align-items: center;
      background: $primary;
      padding: 0.5rem 1rem;
    }

    .number {
      background-color: white;
      color: $primary;
      font-weight: bold;
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      flex-shrink: 0;
    }

    .title {
      flex-grow: 1;
    }

    .content {
      padding: 1rem;
      font-size: 1rem;
      line-height: 1.5;
      font-weight: 400;
    }
  }

  .arrow {
    display: flex;
    align-items: center;
    width: 25px;
    flex-basis: auto;

    .arrow-inner {
      height: 5px;
      background: $primary;
      width: 100%;
    }
  }
}

@media (max-width: 900px) {
  .steps {
    .step {
      flex: 100%;
    }

    .arrow {
      display: none;
    }
  }
}

.home-container {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 15px;
}

.logo-info-box {
  display: flex;
  align-items: end;
  justify-content: center;

  .home-image {
    width: 505px;
    max-width: 100%;
    position: relative;
    z-index: 2;
  }

  #ghost-scene-container {
    width: 505px;
    height: 312px;
    max-width: 100%;
    position: relative;
    z-index: 2;
  }

  .mt20-info {
    font-family: "Press Start 2P", Arial, sans-serif;
    font-weight: 600;
    font-size: 1.5rem;
    margin-left: -50px;
    text-shadow: 4px 4px 0px #015008;

    ul {
      padding: 0;
      list-style: square;
      list-style-position: inside;
      li {
        &:not(:last-child) {
          border-bottom: 2px solid $primary;
        }

        &::marker {
          color: $primary;
        }
      }
    }
  }
}

@media (max-width: 900px) {
  .logo-info-box {
    flex-direction: column;

    .mt20-info {
      margin-left: 0;
      margin-top: -20px;
      font-size: 1rem;
    }
  }
}
</style>

<script>
export default {
  computed: {
    signedUp() {
      if (!this.$page.props.auth.user) {
        return false;
      }

      return (
        this.$page.props.auth.user.events.find((event) => event.id === 4) !==
        undefined
      );
    },
  },

  data() {
    return {
      signUpText: "Sign up now!",
      _signUpBlinkState: false,
    };
  },

  mounted() {
    setInterval(() => {
      this._signUpBlinkState = !this._signUpBlinkState;
      this.signUpText = this._signUpBlinkState
        ? `> Sign Up Now! <`
        : "Sign up now!";
    }, 700);
  },
};
</script>
