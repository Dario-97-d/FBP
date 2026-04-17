
<section id="play-7-arrange-formation">

  <h1>Play 7 Formation </h1>

  <h2>Current Lineup</h2>

  <div class="play-7-lineup">
    <div class="outer-lines">

      <div class="center-semi-circle"></div>

      <div class="goal-box"></div>
      <div class="penalty-box"></div>

      <div class="round-icon GK">G</div>
      <div class="round-icon <?= $_positions_players[1] ?>">P</div>
      <div class="round-icon <?= $_positions_players[2] ?>">P</div>
      <div class="round-icon <?= $_positions_players[3] ?>">P</div>
      <div class="round-icon <?= $_positions_players[4] ?>">P</div>
      <div class="round-icon <?= $_positions_players[5] ?>">P</div>
      <div class="round-icon <?= $_positions_players[6] ?>">P</div>

    </div>
  </div>

  <form method="POST">
    <br>
    <button type="submit" name="switch-formation">Switch Formation</button>
  </form>

</section>
