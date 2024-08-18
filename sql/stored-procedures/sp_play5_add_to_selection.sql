DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_play5_add_to_selection (
	IN var_selecter_id INT,
	IN var_selected_id INT
)
proc_edure:BEGIN
	DECLARE var_selecter_team_id   INT;
	DECLARE var_selected_team_id   INT;
	DECLARE var_has_4_selections   BOOLEAN;
	DECLARE var_teammates          INT;
	DECLARE var_selected_teammates INT;
	
	--
	-- Initial Checks
	--
	
	-- Get team id of player
	SELECT team_id INTO var_selecter_team_id FROM player_team WHERE player_id = var_selecter_id;
	--
	-- Exit if player doesn't have a team
	IF var_selecter_team_id IS NULL THEN
		SELECT 'player must have team in order to play 5';
		LEAVE proc_edure;
	END IF;
	
	-- Get team id of selected player (0 if team id is NULL) if not in another team
	SELECT
		CASE
			WHEN team_id IS NULL THEN 0
			ELSE team_id
		END
		INTO var_selected_team_id
	FROM  player_team
	WHERE player_id = var_selected_id
	AND   (
		team_id IS NULL
		OR
		team_id = var_selecter_team_id
	);
	--
	-- Exit if player is in another team
	IF var_selected_team_id IS NULL THEN
		SELECT 'the selected player must not be in any other team';
		LEAVE proc_edure;
	END IF;
	
	-- Check whether player has already selected 4 other players
	SELECT count(1) >= 4 INTO var_has_4_selections FROM play5_selections WHERE player_id = var_selecter_id GROUP BY player_id;
	--
	-- Exit if player has already selected 4 other players
	IF var_has_4_selections THEN
		SELECT 'this player has already selected 4 other players';
		LEAVE proc_edure;
	END IF;
	
	
	-- Ensure player selects all teammates before selecting outer player
	IF var_selected_team_id <> var_selecter_team_id THEN
		
		-- Get number of team members
		SELECT (members - 1) INTO var_teammates FROM teams WHERE id = var_selecter_team_id;
		
		-- Get selected teammates
		SELECT count(1) INTO var_selected_teammates
		FROM     play5_selections s
		JOIN     player_team      t ON t.player_id = s.selected_id
		WHERE    s.player_id = var_selecter_id
		AND      t.team_id   = var_selecter_team_id;
		
		
		-- Exit if there is at least one available teammate and selected player is not one
		IF var_teammates > var_selected_teammates THEN
			SELECT 'there is at least one teammate available';
			LEAVE proc_edure;
		END IF;
		
	END IF;
	
	--
	-- Insert
	--
	
	INSERT INTO play5_selections () VALUES (var_selecter_id, var_selected_id);
	
	-- Success
	SELECT 'success';
	
END //

DELIMITER ;