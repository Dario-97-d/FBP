DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_teams_eliminate (
    IN var_team_id INT
)
proc_edure:BEGIN
	DECLARE var_team_exists             BOOLEAN;
	DECLARE var_number_of_team_elements INT;
	
	DECLARE var_deleted_team            INT;
	
	--
	-- Initial Checks
	--
	
	-- Check whether team exists
	SELECT EXISTS (SELECT 1 FROM teams WHERE id = var_team_id) INTO var_team_exists;
	
	IF NOT var_team_exists THEN
		SELECT 'team not found';
		LEAVE proc_edure;
	END IF;
	
	-- Check whether the team has more than 1 permanent member
	SELECT count(*) INTO var_number_of_team_elements FROM player_team WHERE team_id = var_team_id AND staff_role != 'Free' GROUP BY staff_role;
	
	IF var_number_of_team_elements > 1 THEN
		SELECT 'this team has permanent members';
		LEAVE proc_edure;
	END IF;
	
	--
	-- Deletes and Updates
	--
	
	-- Delete applications
	DELETE FROM player_team_applications WHERE team_id = var_team_id;
	
	-- Delete invites
	DELETE FROM team_player_invites      WHERE team_id = var_team_id;
	
	-- Update players' team affiliations
	UPDATE player_team SET team_id = NULL, staff_role = 'None' WHERE team_id = var_team_id;
	
	-- Delete team
    DELETE FROM teams WHERE id = var_team_id;
	
	--
	-- Check ROW_COUNT
	--
	
	IF var_deleted_team <> 1 THEN
		SELECT 'number of rows for deleted team is not 1';
		LEAVE proc_edure;
	END IF;
	
	-- ------- --
	-- Success --
	-- ------- --
	
	SELECT 'success';
	
END //

DELIMITER ;