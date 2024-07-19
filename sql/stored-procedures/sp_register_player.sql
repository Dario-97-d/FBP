DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_register_player (
	IN var_username    VARCHAR(63),
	IN var_player_name VARCHAR(63),
	IN var_email       VARCHAR(63),
	IN var_password    VARCHAR(63)
)
proc_edure:BEGIN
    DECLARE var_username_exists BOOLEAN;
	DECLARE var_email_exists    BOOLEAN;
	
	
	-- Check whether username already exists
	SELECT EXISTS (SELECT 1 FROM game_users WHERE username = var_username) INTO var_username_exists;
	--
	-- Exit if username exists
	IF var_username_exists THEN
		SELECT 'this username is taken';
		LEAVE proc_edure;
	END IF;
	
	
	-- Check whether email already exists
	SELECT EXISTS (SELECT 1 FROM game_users WHERE email = var_email) INTO var_email_exists;
	--
	IF var_email_exists THEN
		SELECT 'this email is already registered';
		LEAVE proc_edure;
	END IF;
	
	
	-- Insert Values --
	
	INSERT INTO game_users         (username, email, pass_word) VALUES (var_username, var_email, var_password);
	INSERT INTO user_mates         ()                           VALUES ();
	INSERT INTO football_players   (player_name)                VALUES (var_player_name);
	INSERT INTO generic_attributes ()                           VALUES ();
	INSERT INTO playing_attributes ()                           VALUES ();
	INSERT INTO player_stats       ()                           VALUES ();
	INSERT INTO player_team        ()                           VALUES ();
	
	-- Success
	SELECT 'success';
	
END //

DELIMITER ;