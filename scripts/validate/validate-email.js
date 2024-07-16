// -- Validate Email --
const validateEmail = (email) =>
{
	email = email.trim();
	
	const email_length = email.length;
	
	// -- Check length and valid chars --
	
	// Prepare fail message.
	let fail_msg = '';
	
	// Check whether length is 7 to 63 chars.
	if ( email_length < 7 || email_length > 63 )
	{
		fail_msg += '\n- Email must be 7 to 63 chars.';
	}
	
	if ( ! /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test( email ) )
	{
		fail_msg += '\n- Email is not valid.';
	}
	
	// -- Success --
	if ( fail_msg.length == 0 ) return { isValid: true, handled: email };
	
	// -- Fail --
	return { isValid: false, message: fail_msg };
}