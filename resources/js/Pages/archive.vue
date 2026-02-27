<template>
  <div>
    <Head title="Archive" />

    <h1 data-aos="fade-right">Hall<br />of Fame</h1>

    <v-container>
      <div
        v-for="(tournament, i) in filteredTournaments"
        :key="tournament.name"
        class="tournament"
        :class="{ alt: i % 2 }"
        :data-aos="i % 2 ? 'fade-left' : 'fade-right'"
      >
        <div class="d-flex justify-space-between flex-wrap">
          <div class="tournament-left">
            <div class="tournament-header">
              {{ tournament.name }}
            </div>

            <div class="tournament-winners">
              <ul>
                <li v-for="(winner, i) in tournament.winners" :key="winner">
                  <span class="tournament-winners-placement">
                    {{ ordinalNumber(i + 1) }}
                  </span>
                  {{ winner }}
                </li>
              </ul>
            </div>
          </div>

          <div class="tournament-right">
            <div class="tournament-date">
              {{ tournament.date_start | date }}
            </div>

            <div class="tournament-buttons d-flex flex-wrap">
              <a
                v-if="tournament.vod"
                :href="tournament.vod"
                target="_blank"
                class="tournament-button"
              >
                <div class="tournament-button-icon">
                  <v-icon>mdi-youtube</v-icon>
                </div>

                <div class="tournament-button-text">
                  VOD
                </div>
              </a>

              <a
                :href="tournament.bracket"
                target="_blank"
                class="tournament-button"
              >
                <div class="tournament-button-icon">
                  <v-icon>mdi-tournament</v-icon>
                </div>

                <div class="tournament-button-text">
                  Bracket
                </div>
              </a>

              <a
                :href="tournament.games"
                target="_blank"
                class="tournament-button"
              >
                <div class="tournament-button-icon">
                  <v-icon>mdi-controller-classic</v-icon>
                </div>

                <div class="tournament-button-text">
                  Games
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </v-container>
  </div>
</template>

<script>
import { ordinalNumber } from "../util.js";

export default {
  methods: {
    ordinalNumber,
    getTransition: (i) => {
      if (i % 2 == 0) {
        return "slide-x-reverse-transition";
      } else {
        return "slide-x-transition";
      }
    },
  },

  computed: {
    filteredTournaments() {
      return this.tournaments.sort((a, b) => {
        return new Date(b.date_start) - new Date(a.date_start);
      });
    },
  },

  data() {
    return {
      tournaments: [
        {
          name: "Mystery Tournament 1",
          date_start: new Date(2012, 11, 22),
          date_end: new Date(2012, 12, 22),
          winners: ["Blechy", "Harukakuma", "LiteYear"],
          vod: null,
          games: "http://i.imgur.com/gIuy3pq.png",
          bracket: "http://speedrunslive.challonge.com/mystery1",
        },
        {
          name: "Mystery Tournament 2",
          date_start: new Date(2013, 5, 7),
          date_end: new Date(2013, 6, 22),
          winners: ["Zecks", "Blechy", "LiteYear"],
          vod: "https://www.twitch.tv/speedrunslive/v/50310469",
          games: "http://pastebin.com/QBCMqgei",
          bracket: "http://speedrunslive.challonge.com/mystery2",
        },
        {
          name: "Mystery Tournament 3",
          date_start: new Date(2013, 9, 18),
          date_end: new Date(2013, 11, 16),
          winners: ["Blechy", "Jorf", "PrinceKaro"],
          vod: "https://www.twitch.tv/speedrunslive/v/45543630",
          games:
            "https://docs.google.com/spreadsheet/ccc?key=0Apa-chT9dW7ZdDVhSVlHZGREdlBsX2J3c3AxTUYzY3c#gid=0",
          bracket: "http://speedrunslive.challonge.com/mystery3",
        },
        {
          name: "Mystery Tournament 4",
          date_start: new Date(2014, 1, 14),
          date_end: new Date(2014, 3, 22),
          winners: ["Capndrake", "Blechy", "iongravirei"],
          vod: "https://www.twitch.tv/speedrunslive/v/43020957",
          games:
            "https://docs.google.com/spreadsheet/ccc?key=0AkhhgdeNGlQ3dHdrdlN4RTZmNzhJQzMtaWFCdHMzQ3c#gid=0",
          bracket: "http://speedrunslive.challonge.com/mystery4",
        },
        {
          name: "Mystery Tournament 5",
          date_start: new Date(2014, 7, 8),
          date_end: new Date(2014, 9, 13),
          winners: ["usedpizza", "FullaLizards", "AND4H"],
          vod: "https://www.youtube.com/watch?v=SpzdfumNXd4",
          games:
            "https://docs.google.com/spreadsheets/d/1EOAaU_I5meb9-s6EyHmeMtZIoOCD1j-2jtppthxi9_0/edit#gid=0",
          bracket: "http://speedrunslive.challonge.com/mystery5",
        },
        {
          name: "Mystery Tournament 6",
          date_start: new Date(2015, 2, 5),
          date_end: new Date(2015, 4, 11),
          winners: ["Capndrake", "AND4H", "Krankdud"],
          vod: "http://www.twitch.tv/speedrunslive/v/4023041",
          games:
            "https://docs.google.com/spreadsheets/d/1CTub42PNjdjGEf5ndDUz5MxyHNGP3NUQJTiZZgh4USM/edit?pli=1#gid=0",
          bracket: "http://speedrunslive.challonge.com/mystery6",
        },
        {
          name: "Mystery Tournament 7",
          date_start: new Date(2015, 4, 9),
          date_end: new Date(2015, 10, 10),
          winners: ["AND4H", "Ramsus88", "Mr_Weables"],
          vod: "http://www.twitch.tv/speedrunslive/v/20147793",
          games:
            "https://docs.google.com/spreadsheets/d/1CTub42PNjdjGEf5ndDUz5MxyHNGP3NUQJTiZZgh4USM/edit#gid=115275270",
          bracket: "http://speedrunslive.challonge.com/mystery7",
        },
        {
          name: "Mystery Tournament 8",
          date_start: new Date(2016, 1, 19),
          date_end: new Date(2016, 3, 26),
          winners: ["AND4H", "Capndrake", "Ramsus88"],
          vod: "http://www.twitch.tv/speedrunslive/v/56983301",
          games:
            "https://docs.google.com/spreadsheets/d/1Qz3RziW5VT__8zhQmSHWHntwIM8Cv2VKdkcySwEvSNI/",
          bracket: "http://speedrunslive.challonge.com/mystery8",
        },
        {
          name: "Mystery Tournament 9",
          date_start: new Date(2016, 7, 19),
          date_end: new Date(2016, 9, 24),
          winners: ["AND4H", "Trisscorp", "Capndrake"],
          vod: "https://www.twitch.tv/speedrunslive/v/91271824",
          games:
            "https://docs.google.com/spreadsheets/d/1KDVIbGY_4KcBfgIto2cRAwpBptklDRovuxLQydsSOrI",
          bracket: "http://speedrunslive.challonge.com/mystery9",
        },
        {
          name: "Mystery Tournament X",
          date_start: new Date(2017, 1, 17),
          date_end: new Date(2017, 4, 8),
          winners: ["AND4H", "Zecks", "Capndrake"],
          vod: "https://www.twitch.tv/videos/134456850",
          games:
            "https://docs.google.com/spreadsheets/d/1Bm9w0f0vpyeD4HhdRptzMR8itx9pUeXAPSw46TR1FJc",
          bracket: "http://speedrunslive.challonge.com/mystery10",
        },
        {
          name: "Mystery Tournament 11",
          date_start: new Date(2017, 7, 25),
          date_end: new Date(2017, 10, 1),
          winners: ["Zecks", "Fullalizards", "Mundungu"],
          vod: "https://www.youtube.com/watch?v=hD5J9lNd8RU",
          games:
            "https://docs.google.com/spreadsheets/d/1qyzFEEUSatHE1SunyrqvWYaamZur4LS4uDkPpP95wkE",
          bracket: "http://speedrunslive.challonge.com/mystery11",
        },
        {
          name: "Mystery Tournament 12",
          date_start: new Date(2018, 1, 9),
          date_end: new Date(2018, 3, 18),
          winners: ["AND4H", "Capndrake", "adam5396"],
          vod: "https://www.youtube.com/watch?v=GB6t1AV21SA",
          games:
            "https://docs.google.com/spreadsheets/d/1xPbdVtu0ZUnV1kGm2mDir24lg_yf5B0YGiwuJcvivvI",
          bracket: "http://speedrunslive.challonge.com/mystery12",
        },
        {
          name: "Mystery Tournament 13",
          date_start: new Date(2018, 8, 14),
          date_end: new Date(2018, 11, 18),
          winners: ["AND4H", "Maurice", "Zecks"],
          vod: "https://www.youtube.com/watch?v=iehV8WuLfN4",
          games:
            "https://docs.google.com/spreadsheets/d/1OuETNksPG--N8cCCSHAKqdnd3sdETD7h2yO46k471UI",
          bracket: "http://speedrunslive.challonge.com/mystery13",
        },
        {
          name: "Mystery Tournament 14",
          date_start: new Date(2019, 7, 30),
          date_end: new Date(2018, 10, 27),
          winners: ["Maurice", "Capndrake", "SirNiko"],
          vod: "https://www.youtube.com/watch?v=wfoi91ytCmM",
          games:
            "https://docs.google.com/spreadsheets/d/15G_anNdmFLF3NUN9XJTQfghpmw67S73v5-KUaCE_rys",
          bracket: "http://speedrunslive.challonge.com/mystery14",
        },
        {
          name: "Mystery Tournament 15",
          date_start: new Date(2020, 9, 1),
          date_end: new Date(2020, 12, 13),
          winners: ["AND4H", "Maurice", "Zecks"],
          vod: "https://www.youtube.com/watch?v=mwXR1JysvAM",
          games:
            "https://docs.google.com/spreadsheets/d/1SvpGOSbMZXtpl_IfdB0uQqv-iFkmNMitRTSsotrAM2o/",
          bracket: "http://speedrunslive.challonge.com/mystery15",
        },
        {
          name: "Mystery Tournament 16",
          date_start: new Date(2021, 11, 10),
          date_end: new Date(2022, 3, 13),
          winners: ["Adam5396", "Someone325", "OkamiofGames"],
          vod: "https://www.youtube.com/watch?v=h2HZ_4C4OCo",
          games:
            "https://docs.google.com/spreadsheets/d/1VPJKgtHDaZDRb0USuGSQckXLQtgluizi8P-EFADl8Ok/edit#gid=0",
          bracket: "https://speedrunslive.challonge.com/mystery16",
        },
        {
          name: "Mystery Tournament 17",
          date_start: new Date(2022, 11, 9),
          date_end: new Date(2023, 3, 12),
          winners: ["Trisscorp", "Pikapals", "Maurice"],
          vod:
            "https://www.youtube.com/watch?v=B6w0RIJKYrE&list=PLvokTc7DrMSNDuAabDU6sWGSgwShCT_i3",
          games:
            "https://docs.google.com/spreadsheets/d/1tYyHOagyimN87z0kB1yCH_9EtfNu5Ni0gObA3IW5h3s/edit#gid=1124956477",
          bracket: "https://speedrunslive.challonge.com/mt17",
        },
        {
          name: "Mystery Tournament 18",
          date_start: new Date(2023, 11, 9),
          date_end: new Date(2024, 3, 17),
          winners: ["Faris_V5", "Maurice", "Someone325"],
          vod:
            "https://www.youtube.com/watch?v=kpRofYsvBUI&list=PLvokTc7DrMSM4uk6p2AE-X3o3RieIHOgB",
          games:
            "https://docs.google.com/spreadsheets/d/18-5xv-5OTaayEFq42ARcaTziehTwudW_43hlJt7pOgk/edit?usp=sharing",
          bracket: "https://speedrunslive.challonge.com/mt18",
        },
        {
          name: "Mystery Tournament 19",
          date_start: new Date(2024, 11, 9),
          date_end: new Date(2025, 3, 17),
          winners: ["Midboss", "Faris_V5", "pikapals"],
          vod: "https://www.youtube.com/watch?v=o4Q3mt3WdIY",
          games:
            "https://docs.google.com/spreadsheets/d/1OaxGA7aoDoBvdqK0WWQQs2yUOsMZ9gMCpNMaSfnz6J4/edit?gid=0#gid=0",
          bracket: "https://speedrunslive.challonge.com/mysterytournament19",
        },
      ],
    };
  },
};
</script>
