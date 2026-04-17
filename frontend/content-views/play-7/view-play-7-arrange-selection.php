
<section id="play-7-arrange-selection">

  <h1>Play 7 Formation </h1>

  <h2>Current Selection</h2>

  <table class="play-7-selection">
    <tr><th>Pos</th><th>Player Name</th><th>X</th></tr>

    <?php
      $i = 0;
      foreach ( $_selected as $selected )
      {
        ?>

        <tr>
          <td><?= $_positions[ $selected['position_number'] ] ?></td>
          <td><?= $selected['player_name'] ?></td>
          <td>
            <form method="POST">
              <button type="submit" name="deselect-player-id" value="<?= $selected['player_id'] ?>">X</button>
            </form>
          </td>
        </tr>

        <?php
        $i++;
      }
    ?>
  </table>

  <?php
  if ( ! empty( $_unselected ) )
  {
    ?>

    <h2>Available</h2>

    <table class="play-7-available">
      <tr><th>Player Name</th><th>Select</th></tr>

      <?php
        foreach ( $_unselected as $unselected )
        {
          ?>

          <tr>
            <td><?= $unselected['player_name'] ?></td>
            <td>
              <form method="POST">
                <input type="hidden" name="player-id" value="<?= $unselected['player_id'] ?>">
                <select name="position-number">
                  <?php
                    foreach ( $_available_positions as $key => $position )
                    {
                      ?>

                      <option value="<?= $key ?>"><?= $position ?></option>

                      <?php
                    }
                  ?>
                </select>
                <button type="input" name="select-player">+</button>
              </form>
            </td>
          </tr>

          <?php
        }
      ?>
    </table>

    <?php
  }
  ?>

</section>
