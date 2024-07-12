DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_mates_send_request (
	IN var_requester_id       INT,
	IN var_requested_username VARCHAR(63)
)
BEGIN
    DECLARE var_requested_id INT;
	
	DECLARE var_found_rows   INT;
	
	-- Get id of user by username
	SELECT id INTO var_requested_id FROM game_users WHERE username = var_requested_username;
	--
	-- Exit if user not found
	IF var_requested_id IS NULL THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'user not found';
	END IF;
	
	-- Check whether there is already a mate request between these users
	SELECT count(1) INTO var_found_rows
	FROM mate_requests
	WHERE
		( requester_id = var_requester_id AND requested_id = var_requested_id)
	OR
		( requester_id = var_requested_id AND requested_id = var_requester_id);
	--
	-- Exit if there is request
	IF var_found_rows > 0 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'there is already a pending request';
	END IF;
	
	-- Check whether these users are mates
	SELECT count(1) INTO var_found_rows
	FROM mates
	WHERE
		( user1_id = var_requester_id AND user2_id = var_requested_id)
	OR
		( user1_id = var_requested_id AND user2_id = var_requester_id);
	--
	-- Exit if these users are mates
	IF var_found_rows > 0 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'these users are already mates';
	END IF;
	
	-- Insert mate request
	INSERT INTO mate_requests VALUES (var_requester_id, var_requested_id);
	
END //

DELIMITER ;