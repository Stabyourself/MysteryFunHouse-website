<template>
  <!-- <v-sheet color="primary">
      <v-list>
        <v-list-item class="px-2" v-if="$page.props.auth.user">
          <v-list-item-avatar>
            <img :src="`/storage/avatars/${$page.props.auth.user.id}`" />
          </v-list-item-avatar>

          <v-list-item-title>
            <div class="logged-in-as">Logged in as:</div>
            <strong>{{ $page.props.auth.user.username }}</strong>
          </v-list-item-title>

          <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
              <div v-bind="attrs" v-on="on">
                <v-btn icon @click="logout">
                  <v-icon>mdi-logout</v-icon>
                </v-btn>
              </div>
            </template>
            <span>Logout</span>
          </v-tooltip>
        </v-list-item>

        <v-list-item v-else>
          <v-list-item-icon>
            <v-icon>mdi-discord</v-icon>
          </v-list-item-icon>

          <v-list-item-title>
            <v-btn block color="#5865F2" :href="route('login')">
              Discord Login
            </v-btn>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-sheet> -->

  <div class="d-flex navigation justify-center flex-wrap">
    <div class="navigation-login" v-if="$page.props.auth.user">
      <v-btn color="primary" @click="logout">
        <v-icon>mdi-logout</v-icon>
        Logout
      </v-btn>
    </div>

    <div class="navigation-login" v-else>
      <v-btn color="primary" :href="route('login')">
        <v-icon>
          mdi-discord
        </v-icon>
        Discord Login
      </v-btn>
    </div>

    <router-link
      v-for="item in items"
      :key="item.title"
      :href="route(item.route)"
      as="div"
      class="navigation-link"
      :class="{ active: route().current(item.route) }"
    >
      {{ item.title }}
    </router-link>
  </div>
</template>

<style scoped lang="scss">
.user-box {
  line-height: 1;
  .logged-in-as {
    font-size: 0.8em;
  }

  img {
    border: 3px solid white;
  }
}

.by {
  opacity: 0;
  white-space: nowrap;
  transition: 0.2s opacity;
}

.v-navigation-drawer--is-mouseover .by {
  opacity: 1;
}
</style>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  mounted() {
    Inertia.on("navigate", (event) => {
      // I don't know why I need to do this...
      this.$forceUpdate();
    });
  },

  methods: {
    logout() {
      this.$inertia.post(this.route("logout"));
    },
  },

  data() {
    return {
      drawer: true,
      items: [
        {
          title: "Home",
          icon: "mdi-home",
          route: "home",
        },
        {
          title: "Players",
          icon: "mdi-account-multiple",
          route: "players",
        },
        {
          title: "Intel",
          icon: "mdi-information",
          route: "info",
        },
        {
          title: "Gadgets",
          icon: "mdi-pistol",
          route: "links",
        },
        {
          title: "Archive",
          icon: "mdi-archive",
          route: "archive",
        },
      ],
    };
  },
};
</script>
