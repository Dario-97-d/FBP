DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_accept_invite (
	IN var_player_id INT,
	IN var_team_id   INT
)
proc_edure:BEGIN
	DECLARE var_team_has_invite_to_this_player BOOLEAN;
	DECLARE var_player_has_team                BOOLEAN;
	
	DECLARE var_updated_player                 INT;
	DECLARE var_updated_team                   INT;
	
	--
	-- Initial Checks
	--
	
	-- Check whether team has an invite to this player
	-- (implicitly ensures both player and team exist)
	SELECT EXISTS (SELECT 1 FROM team_player_invites WHERE team_id = var_team_id AND player_id = var_player_id) INTO var_team_has_invite_to_this_player;
	
	-- Exit if team doesn't have invite to this player
	IF NOT var_team_has_invite_to_this_player THEN
		SELECT 'invite not found';
		LEAVE proc_edure;
	END IF;
	
	
	-- Check whether player has team
	SELECT EXISTS (SELECT 1 FROM player_team WHERE player_id = var_player_id AND team_id IS NOT NULL) INTO var_player_has_team;
	
	-- Exit if player has team
	IF var_player_has_team THEN
		SELECT 'this player already has a team';
		LEAVE proc_edure;
	END IF;
	
	--
	-- Updates and Deletes
	--
	
	-- Update player's team status
	UPDATE player_team SET team_id = var_team_id, staff_role = 'Free' WHERE player_id = var_player_id AND team_id IS NULL;
	
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
	
	-- Remove player applications
	DELETE FROM player_team_applications WHERE player_id = var_player_id;
	
	-- Remove invites to player
	DELETE FROM team_player_invites WHERE player_id = var_player_id;
	
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