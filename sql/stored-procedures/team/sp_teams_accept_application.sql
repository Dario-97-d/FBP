DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_accept_application (
	IN var_team_id   INT,
	IN var_player_id INT
)
BEGIN
	DECLARE var_player_has_team                     BOOLEAN;
	DECLARE var_team_exists                         BOOLEAN;
	DECLARE var_player_has_application_to_this_team BOOLEAN;
	
	DECLARE var_updated_player                      INT;
	DECLARE var_updated_team                        INT;
	
	--
	-- Initial Checks
	--
	
	-- Check whether player has an application to this team
	-- (implicitly ensures both player and team exist)
	SELECT EXISTS (SELECT 1 FROM player_team_applications WHERE player_id = var_player_id AND team_id = var_team_id) INTO var_player_has_application_to_this_team;
	
	-- Exit if player doesn't have application to this team
	IF NOT var_player_has_application_to_this_team THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'application not found';
	END IF;
	
	-- Check whether player already has team
	SELECT EXISTS ( SELECT 1 FROM player_team WHERE player_id = var_player_id AND team_id IS NOT NULL ) INTO var_player_has_team;
	
	-- Exit if player has team
	IF var_player_has_team THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'this player already has a team';
	END IF;
	
	--
	-- Updates and Deletes
	--
	
	-- Update player team status
	UPDATE player_team SET team_id = var_team_id, staff_role = 'Free' WHERE player_id = var_player_id;
	
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
	
	-- Delete player applications
	DELETE FROM player_team_applications WHERE player_id = var_player_id;
	
	-- Delete invites to player
	DELETE FROM team_player_invites WHERE player_id = var_player_id;
	
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