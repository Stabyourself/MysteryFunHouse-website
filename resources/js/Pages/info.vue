<template>
  <div>
    <Head title="Intel" />

    <v-container>
      <v-slide-x-transition appear>
        <h1>For your<br />eyes only</h1>
      </v-slide-x-transition>

      <p>
        Mystery Tournament is an event in which players will participate in a
        series of matches, racing against a single opponent per round in short
        to medium length goals. These goals will be for games that are not
        revealed until moments before the race actually begins, with just enough
        time to download the game.
      </p>

      <p>
        Players are likely to encounter games they've never played before, seen
        before, or, most frequently, have never even heard of. This event is
        designed to determine not just who has the most gaming experience but
        the best overall racing abilities!
      </p>

      <h2>How does it work?</h2>

      <v-expansion-panels accordion>
        <v-expansion-panel>
          <v-expansion-panel-header>
            Scheduling Your Match
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <p>
              Once brackets are generated after registration closes, we
              recommend seeing who your opponent is and contacting them as soon
              as possible to schedule your first match. Each match will
              generally take between 20 and 60 minutes to complete, but between
              the players’ skill and the goal’s difficulty, this time frame is
              not a guarantee. Additionally, there's time taken to set up the
              race and the game - please try to have at 2 hours free for the
              entire race.
            </p>
            <p>
              You will have at least 3 days per round to play each match, round
              deadlines will be specified on the challonge bracket. You and your
              oponent can communicate through discord to schedule your match. If
              you're having trouble contacting your opponent or you are not able
              to meet up during a round's duration, please let us know as soon
              as possible. Asynchronous races, where each player plays the same
              goal when they have availability and the final times are compared,
              are possible as a last resort.
            </p>
            <p>
              The tournament schedule will be shown on the round labels in the
              brackets. While each round will have a deadline, if players finish
              their matches early and have their opponent determined, they are
              free to play ahead of schedule if they choose to do so.
            </p>
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header>
            Starting The Race
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <p>
              When you and your opponent are both ready to race and you are both
              in discord, one of you must ping the @GIVEGAME role; this tells us
              that you are both ready to go.
            </p>
            <p>
              When both players' streams are up and are displaying the
              appropriate emulator, the game, goal, download link, and
              informational Pastebin will be provided. After setting the game up
              and reading the given information, and confirming that a moderator
              can see the both player's game properly on stream, the race is
              ready to go.
            </p>
            <p>
              Though races in Mystery Tournament are intended to be blind - that
              is, with neither player having prior experience - it is impossible
              to verify this and unfair to punish competitors for having a wider
              array of game experience, therefore no games will be forcefully
              redrawn for a match. Still, to allow players to experience new
              games and have fun races, if you are familiar with a game revealed
              for your match, it is considered good form to tell your opponent
              and moderator, and if both players agree there may be an
              advantage, they can request a new game be given (don't feel bad
              about doing this, for experienced players this happens quite a
              lot).
            </p>
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header>
            Racing the Game
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <p>
              During the race you must not view your opponent's stream or
              rebroadcasts at any time, and must hide your stream chat if a
              viewer attempts to assist you, as player assistance is a massive
              advantage and is not allowed. Additionally, with the exception of
              the Pastebin provided with the goal, you must not use any other
              sources of assistance, such as walkthroughs, manuals, etc.
            </p>
            <p>
              Due to how situational most bugs, crashes, and errors are, we
              cannot moderate these occurrences consistently and fairly. If
              anything happens during your race, please notify the moderator in
              the IRC race channel, and work quickly to resolve it. Depending on
              the severity and cause of the occurence, the race may be nullified
              and redrawn, your final time may be adjusted after the fact to
              compensate for time lost fixing the problem and regaining
              progress, or there may even be no changes made to the race.
            </p>
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header>
            Determining the Result
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <p>
              If you completed the goal and reached the point described by the
              pastebin before your opponent (barring any retimes due to
              technical problems), you will advance to to the next round of the
              tournament. If you lose, you will be moved into the loser's
              bracket, or eliminated if you were already there. If you have a
              next opponent, try get in touch with them and schedule your next
              match. If you don't, keep in mind, anyone is always welcome to
              join every race they have time for, so stick around to keep
              playing games!
            </p>
            <p>
              Though all goals are intended to be completed in under 60 minutes,
              differences in player skill, adaptation to game mechanics, and
              other unexpected factors can lead to races running longer. There
              will be a hard cutoff for the results of the match at the 90
              minute mark. Whichever player has clearly made the most progress
              towards completing the goal (at any point of the race: lost
              progress is not counted against you) will be awarded the victory.
              In the cases where both players have reached the same point,
              whoever reached that point earlier in the race will win. If this
              still does not produce clear results, any further tiebreakers will
              be at the moderator's discretion.
            </p>
            <p>
              If both players complete the goal in 15 minutes or less, the race
              will be nullified and a redraw will occur unless both players
              agree that the race should determine the result of their match.
            </p>
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header>
            Top 8
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <p>
              Unlike the rest of the matches which happen when the players
              schedule them, Mystery Tournament Top 8 is a full weekend event
              and is rebroadcast on the GamesDoneQuick twitch channel. Players
              who qualify are expected to be around for the full duration - if
              you start getting close and won't be available, please let an
              organizer know as soon as possible to see what we can do about the
              situation.
            </p>
            <p>
              The top 4 will all be best of 3 matches, with a new game drawn for
              each round. Grand finals will not follow the traditional double
              elimination structure; while the loser going into grand finals
              would traditionally be required to win two matches and the winner
              would be required to win only one, both remaining participants
              will only play one best of 5 match, regardless of the outcome. The
              winner going into grand finals will automatically have a one-game
              lead, meaning they must only win twice while the loser must win
              three times to win the tournament.
            </p>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </div>
</template>

<script>
export default {};
</script>
