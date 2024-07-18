// -- Handle form submission for the Register form --
// Add Event listener to the <form> elements with data-register="true".
for ( let formElm of document.querySelectorAll('form[data-register="true"]') )
{
	formElm.addEventListener( 'submit', function( event )
	{
		// Validate input.
		const validate_username    = validateUsername  ( document.getElementById('username')   .value );
		const validate_player_name = validatePlayerName( document.getElementById('player-name').value );
		const validate_password    = validatePassword  ( document.getElementById('password')   .value );
		const validate_email       = validateEmail     ( document.getElementById('email')      .value );
		
		// Alert fail message and return false if any input isn't valid.
		for ( let validate_input of [ validate_username, validate_player_name, validate_password, validate_email ] )
		{
			if ( ! validate_input.isValid )
			{
				alert( 'Fail:\n' + validate_input.message );
				return false;
			}
		}
		
		// Prepare confirmation message.
		let message = 'Register?\n';
		message += '\n- Username: '    + validate_username   .handled;
		message += '\n- Player name: ' + validate_player_name.handled;
		message += '\n- Email: '       + validate_email      .handled;
		
		if ( ! confirm(message) )
		{
			event.preventDefault();
			return false;
		}
	})
}