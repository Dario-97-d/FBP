// -- Handle form submission for the Register form --
// Add Event listener to the <form> elements with data-register="true".
for ( let formElm of document.querySelectorAll('form[data-register="true"]') )
{
	formElm.addEventListener( 'submit', function( event )
	{
		// Attempt to validate input.
		const validate_username    = validateUsername  ( document.getElementById('username')   .value );
		const validate_player_name = validatePlayerName( document.getElementById('player-name').value );
		const validate_password    = validatePassword  ( document.getElementById('password')   .value );
		const validate_email       = validateEmail     ( document.getElementById('email')      .value );
		
		// -- Alert fail message and return false if any input isn't valid --
		
		if ( ! validate_username.isValid )
		{
			alert( 'Fail:\n' + validate_username.message );
			event.preventDefault();
			return false;
		}
		
		if ( ! validate_player_name.isValid )
		{
			alert( 'Fail:\n' + validate_player_name.message );
			event.preventDefault();
			return false;
		}
		
		if ( ! validate_password.isValid )
		{
			alert( 'Fail:\n' + validate_password.message );
			event.preventDefault();
			return false;
		}
		
		if ( ! validate_email.isValid )
		{
			alert( 'Fail:\n' + validate_email.message );
			event.preventDefault();
			return false;
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