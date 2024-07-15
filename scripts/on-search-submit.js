// -- Handle form submission for Search forms --
// Add Event listener to the <form> elements with data-search="true".
for ( let formElm of document.querySelectorAll('form[data-search="true"]') )
{
	formElm.addEventListener( 'submit', function( event )
	{
		// Remove attribute 'name' from empty <input> elements.
		this.querySelectorAll('input:not([type="submit"])')
			.forEach( input =>
			{
				if ( ! input.value.trim() )
				{
					input.removeAttribute('name');
				}
			}
		)
		
		// Redirect to search page instead of submitting, if no valid inputs found.
		if ( this.querySelectorAll('input:not([type="submit"])[name]').length == 0 )
		{
			event.preventDefault();
			
			window.location.href = this.action;
		}
	})
}