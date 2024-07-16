// -- Validate Player name --
const validatePlayerName = (player_name) =>
{
	player_name = player_name.trim();
	
	// Replace consecutive whitespaces with single space.
	player_name = player_name.replace(/\s{2,}/g, ' ');
	
	const player_name_length = player_name.length;
	
	// Prepare fail message.
	let fail_msg = '';
	
	// -- Check length and accepted chars --
	
	// Check whether length is 7 to 31 chars.
	if ( player_name_length  < 7 || player_name_length > 31 )
	{
		fail_msg += '\n- Player name must be 7 to 31 chars.';
	}
	
	// Check whether every char is either letter or whitespace.
	if ( ! /^[a-zA-Z ]+$/.test( player_name ) )
	{
		fail_msg += '\n- Player name must be only letters and whitespace.';
	}
	
	// -- Success --
	if ( fail_msg.length == 0 ) return { isValid: true, handled: player_name };
	
	// -- Fail --
	return { isValid: false, message: fail_msg };
}