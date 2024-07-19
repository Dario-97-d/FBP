DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_create (
    IN var_team_name VARCHAR(63),
    IN var_player_id INT
)
proc_edure:BEGIN
	DECLARE var_player_has_no_team BOOLEAN;
	DECLARE var_team_name_is_taken BOOLEAN;
	
	--
	-- Initial Checks
	--
	
	-- Check whether player has *no team*
	-- (implicitly ensures player exists)
	SELECT EXISTS (SELECT 1 FROM player_team WHERE player_id = var_player_id AND team_id IS NULL) INTO var_player_has_no_team;
	--
	-- Exit if player already has team
	IF NOT var_player_has_no_team THEN
		SELECT 'this player already has a team';
		LEAVE proc_edure;
	END IF;
	
	
	-- Check whether team name is available
	SELECT EXISTS (SELECT 1 FROM teams WHERE team_name = var_team_name) INTO var_team_name_is_taken;
	--
	-- Exit if team name is taken
	IF var_team_name_is_taken THEN
		SELECT 'this team name is taken';
		LEAVE proc_edure;
	END IF;
	
	--
	-- Insert, Update and Deletes
	--
	
	-- Insert team
    INSERT INTO teams (team_name, rating)
    VALUES
	(
		var_team_name,
		(SELECT rating FROM football_players WHERE id = var_player_id)
	);
	
    -- Retrieve the ID of the newly inserted team
    SELECT LAST_INSERT_ID() INTO @new_team_id;
    
	-- Update player's team affiliation
	UPDATE player_team
	SET
		team_id = @new_team_id,
		staff_role = 'Captain'
	WHERE player_id = var_player_id;
	
	-- Delete player's team applications
	DELETE FROM player_team_applications WHERE player_id = var_player_id;
	
	-- Delete team invites to player
	DELETE FROM team_player_invites WHERE player_id = var_player_id;
	
	-- ------- --
	-- Success --
	-- ------- --
	
	SELECT 'success';
	
END //

DELIMITER ;