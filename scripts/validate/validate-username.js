// -- Validate Username --
const validateUsername = (username) =>
{
	username = username.trim();
	
	const username_length = username.length;
	
	// Prepare fail message.
	let fail_msg = '';
	
	// -- Check length, accepted chars, min 1 letter --
	
	// Check whether length is 3 to 15 chars.
	if ( username_length < 3 || username_length > 15)
	{
		fail_msg += '\n- Username must be 3 to 15 chars.';
	}
	
	// Check for unaccepted chars.
	if ( ! /^[a-zA-Z0-9_-]+$/.test( username ) )
	{
		fail_msg += '\n- Username must be only letters, numbers, underscore and hyphen.';
	}
	
	// Check for minimum of 1 letter.
	if ( ! /[a-zA-Z]{1,}/.test( username ) )
	{
		fail_msg += '\n- Username must have at least 1 letter.';
	}
	
	// -- Success --
	if ( fail_msg.length == 0 ) return { isValid: true, handled: username };
	
	// -- Fail --
	return { isValid: false, message: fail_msg };
}