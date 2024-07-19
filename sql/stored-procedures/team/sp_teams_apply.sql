DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_apply (
	IN var_player_id INT,
	IN var_team_id   INT
)
proc_edure:BEGIN
	DECLARE var_player_has_team                     BOOLEAN;
	DECLARE var_count_player_applications           INT;
	DECLARE var_player_has_application_to_this_team BOOLEAN;
	
	DECLARE var_inserted_application                INT;
	
	--
	-- Initial Checks
	--
	
	-- Check whether player already has team
	SELECT EXISTS (SELECT 1 FROM player_team WHERE player_id = var_player_id AND team_id IS NOT NULL) INTO var_player_has_team;
	
	-- Exit if player has team
	IF var_player_has_team THEN
		SELECT 'this player already has a team';
		LEAVE proc_edure;
	END IF;
	
	
	-- Check whether player already has 5 applications
	SELECT count(player_id) INTO var_count_player_applications FROM player_team_applications WHERE player_id = var_player_id GROUP BY player_id;
	
	-- Exit if player has 5 applications
	IF var_count_player_applications >= 5 THEN
		SELECT 'this player already has 5 applications';
		LEAVE proc_edure;
	END IF;
	
	
	-- Check whether player already has an application to this team
	SELECT EXISTS (SELECT 1 FROM player_team_applications WHERE player_id = var_player_id AND team_id = var_team_id) INTO var_player_has_application_to_this_team;
	
	-- Exit if player already has application to this team
	IF var_player_has_application_to_this_team THEN
		SELECT 'this player already has an application to this team';
		LEAVE proc_edure;
	END IF;
	
	--
	-- Insert
	--
	
	-- Insert application
	INSERT INTO player_team_applications (player_id, team_id)
	VALUES (
		( SELECT id FROM football_players WHERE id = var_player_id ),
		( SELECT id FROM teams WHERE id = var_team_id)
	);
	
	SELECT row_count() as var_inserted_application;
	
	--
	-- Check ROW_COUNT
	--
	
	IF var_inserted_application <> 1 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'number of rows for inserted application is not 1';
	END IF;
	
	-- ------- --
	-- Success --
	-- ------- --
	
	SELECT 'success';
	
END //

DELIMITER ;