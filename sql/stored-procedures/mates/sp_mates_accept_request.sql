DELIMITER //

CREATE PROCEDURE IF NOT EXISTS sp_mates_accept_request (
	IN var_accepter_id INT,
	IN var_accepted_id INT
)
BEGIN
	
	-- Try to delete existing mate request
	DELETE FROM mate_requests WHERE requester_id = var_accepted_id AND requested_id = var_accepter_id;
	
	IF row_count() <> 1 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'request not found';
	END IF;
	
	-- Insert mate relationship values
	INSERT INTO mates VALUES (var_accepter_id, var_accepted_id);
	
END //

DELIMITER ;