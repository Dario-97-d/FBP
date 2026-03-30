DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_play5_use_bots (
  IN var_player_id INT
)
proc_edure:BEGIN
  DECLARE var_team_id        INT;
  DECLARE var_count_selected INT;
  DECLARE var_i              INT default 0;

  --
  -- Initial Checks
  --

  -- Get team id of player.
  SELECT team_id INTO var_team_id FROM player_team WHERE player_id = var_player_id;
  --
  -- Exit if player isn't in a team.
  IF var_team_id IS NULL THEN
    SELECT 'player must be in a team in order to play 5v5';
    LEAVE proc_edure;
  END IF;

  -- Check whether player has already selected 4 other players.
  SELECT count(1) INTO var_count_selected FROM play5_selections WHERE player_id = var_player_id GROUP BY player_id;
  --
  IF var_count_selected IS NULL THEN
    SET var_count_selected = 0;
  END IF;
  --
  -- Exit if player has already selected 4 other players.
  IF var_count_selected >= 4 THEN
    SELECT 'this player has already selected 4 other players';
    LEAVE proc_edure;
  END IF;

  -- The player can use bots even if there are teammates available.

  --
  -- Insert
  --

  -- Delete current bot selections, if any.
  DELETE FROM play5_selections WHERE player_id = var_player_id AND selected_id < 0;

  -- Insert bot selections. Bots get negative ids.
  WHILE var_i < 4 - var_count_selected DO
    SET var_i = var_i + 1;
    INSERT INTO play5_selections () VALUES (var_player_id, -var_i);
  END WHILE;


  -- Success.
  SELECT 'success';

END //

DELIMITER ;
