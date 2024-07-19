DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_expel_player (
	IN var_player_username VARCHAR(63),
	IN var_team_id         INT
)
proc_edure:BEGIN
	DECLARE var_player_id         BOOLEAN;
	DECLARE var_player_staff_role VARCHAR(63);
	
	DECLARE var_updated_player    INT;
	DECLARE var_updated_team      INT;
	
	--
	-- Initial Checks
	--
	
	-- Get player id
	SELECT id INTO var_player_id FROM game_users WHERE username = var_player_username;
	
	-- Exit if player not found
	IF var_player_id IS NULL THEN
		SELECT 'player not found';
		LEAVE proc_edure;
	END IF;
	
	
	-- Get staff_role of player if it is in this team
	SELECT staff_role INTO var_player_staff_role FROM player_team WHERE player_id = var_player_id AND team_id = var_team_id;
	
	-- Exit if player isn't in this team
	IF var_player_staff_role IS NULL THEN
		SELECT 'this player is not in this team';
		LEAVE proc_edure;
	END IF;
	
	-- Exit if player is Captain
	IF var_player_staff_role = 'Captain' THEN
		SELECT 'this player is a captain of this team';
		LEAVE proc_edure;
	END IF;
	
	--
	-- Updates
	--
	
	-- Update player
	UPDATE player_team SET team_id = NULL, staff_role = 'None' WHERE player_id = var_player_id;
	
	SELECT row_count() INTO var_updated_player;
	
	-- Update team
	UPDATE teams SET
		members = (
			SELECT   count(player_id)
			FROM     player_team
			WHERE    team_id = var_team_id
			GROUP BY team_id
		),
		rating = (
			SELECT   sum(f.rating)
			FROM     football_players f
			JOIN     player_team      t ON t.player_id = f.id
			WHERE    t.team_id = var_team_id
			GROUP BY t.team_id
		)
	WHERE id = var_team_id;
	
	SELECT row_count() INTO var_updated_team;
	
	--
	-- Check ROW_COUNT
	--
	
	IF var_updated_player <> var_updated_team THEN
		SELECT 'number of updated rows isn\'t match for player and team';
		LEAVE proc_edure;
	END IF;
	
	IF var_updated_player <> 1 THEN
		SELECT 'number of rows for updated player is not 1';
		LEAVE proc_edure;
	END IF;
	
	-- ------- --
	-- Success --
	-- ------- --
	
	SELECT 'success';
	
END //

DELIMITER ;