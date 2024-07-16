// -- Validate Password --
const validatePassword = (pass_word) =>
{
	const password_length = pass_word.length;
	
	// Prepare fail message.
	let fail_msg = '';
	
	// Check whether length is 7 to 63 chars.
	if ( password_length < 7 || password_length > 63 )
	{
		fail_msg += '\n- Password must be 7 to 63 chars.';
	}
	
	// -- Success --
	if ( fail_msg.length == 0 ) return { isValid: true };
	
	// -- Fail --
	return { isValid: false, message: fail_msg };
}