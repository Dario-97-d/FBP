DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_create (
    IN var_team_name VARCHAR(63),
    IN var_player_id INT
)
proc_edure:BEGIN
	DECLARE var_player_has_team    BOOLEAN;
	DECLARE var_team_name_is_taken BOOLEAN;
	
	DECLARE var_inserted_team      INT;
	DECLARE var_updated_player     INT;
	
	--
	-- Initial Checks
	--
	
	-- Check whether player already has team
	SELECT EXISTS (SELECT 1 FROM player_team WHERE player_id = var_player_id AND team_id IS NOT NULL) INTO var_player_has_team;
	
	-- Exit if player already has team
	IF var_player_has_team THEN
		SELECT 'this player already has a team';
		LEAVE proc_edure;
	END IF;
	
	
	-- Check whether team name is available
	SELECT EXISTS (SELECT 1 FROM teams WHERE team_name = var_team_name) INTO var_team_name_is_taken;
	
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
	
	SELECT row_count() INTO var_inserted_team;
	
    -- Retrieve the ID of the newly inserted team
    SELECT LAST_INSERT_ID() INTO @new_team_id;
    
	-- Update player's team affiliation
	UPDATE player_team
	SET
		team_id = @new_team_id,
		staff_role = 'Captain'
	WHERE player_id = var_player_id;
	
	SELECT row_count() INTO var_updated_player;
	
	-- Delete player's team applications
	DELETE FROM player_team_applications WHERE player_id = var_player_id;
	
	-- Delete team invites to player
	DELETE FROM team_player_invites WHERE player_id = var_player_id;
	
	--
	-- Check ROW_COUNT
	--
	
	IF var_inserted_team <> var_updated_player THEN
		SELECT 'number of inserted rows for team isn\'t match for number of updated rows for player';
		LEAVE proc_edure;
	END IF;
	
	IF var_inserted_team <> 1 THEN
		SELECT 'number of rows for inserted team is not 1';
		LEAVE proc_edure;
	END IF;
	
	-- ------- --
	-- Success --
	-- ------- --
	
	SELECT 'success';
	
END //

DELIMITER ;