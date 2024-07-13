DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_player_leave (
	IN var_player_id INT
)
BEGIN
	DECLARE var_team_id           INT;
	DECLARE var_player_staff_role VARCHAR(63);
	
	DECLARE var_updated_player    INT;
	DECLARE var_updated_team      INT;
	
	--
	-- Initial Checks
	--
	
	-- Get team_id and staff_role of player for checks
	SELECT team_id, staff_role INTO var_team_id, var_player_staff_role FROM player_team WHERE player_id = var_player_id;
	
	-- Exit if player not found (implicit - staff_role cannot be null)
	IF var_player_staff_role IS NULL THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'player not found';
	END IF;
	
	-- Exit if player doesn't have team (team_id is null when player doesn't have team)
	IF var_team_id IS NULL THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'this player doesn\'t have a team';
	END IF;
	
	-- Exit if player isn't Free
	IF var_player_staff_role != 'Free' THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'this player is not free to leave the team';
	END IF;
	
	--
	-- Updates
	--
	
	-- Update player
	UPDATE player_team SET team_id = NULL, staff_role = 'None' WHERE player_id = var_player_id AND team_id = var_team_id AND staff_role = 'Free';
	
	SELECT row_count() INTO var_updated_player;
	
	-- Update team
	UPDATE teams SET
		members = (
			SELECT count(player_id)
			FROM player_team
			WHERE team_id = var_team_id
			GROUP BY team_id
		),
		rating = (
			SELECT sum(f.rating)
			FROM football_players f
			JOIN player_team      t ON t.player_id = f.id
			WHERE t.team_id = var_team_id
			GROUP BY t.team_id
		)
	WHERE id = var_team_id;
	
	SELECT row_count() INTO var_updated_team;
	
	--
	-- Check ROW_COUNT
	--
	
	IF var_updated_player <> var_updated_team THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'number of updated rows isn\'t match for player and team';
	END IF;
	
	IF var_updated_player <> 1 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'number of rows for updated player is not 1';
	END IF;
	
	-- ------- --
	-- Success --
	-- ------- --
	
END //

DELIMITER ;