DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_send_mail (
	IN var_sender_id         INT,
	IN var_receiver_username VARCHAR(63),
	IN var_text              VARCHAR(255)
)
proc_edure:BEGIN
    DECLARE var_receiver_id INT;
	
	-- Get user id by username
	SELECT id INTO var_receiver_id FROM game_users WHERE username = var_receiver_username;
	
	-- Exit if username not found
	IF var_receiver_id IS NULL THEN
		SELECT 'user not found';
		LEAVE proc_edure;
	END IF;
	
	
	-- Insert --
	
	INSERT INTO mail VALUES (var_sender_id, var_receiver_id, var_text);
	
	SELECT 'success';
	
END //

DELIMITER ;