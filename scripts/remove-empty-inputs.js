// -- Remove empty input elements on form submit --
for ( let formElm of document.getElementsByTagName('form') )
{
	formElm.addEventListener( 'submit', function( event )
	{
		// Remove empty input elements.
		this.querySelectorAll('input')
			.forEach( input =>
			{
				if ( ! input.value.trim() )
				{
					input.parentNode.removeChild( input );
				}
			}
		)
		
		// Remove "?" from the address bar if no inputs found.
		if ( this.querySelectorAll('input:not([type="submit"])').length == 0 )
		{
			event.preventDefault();
			
			window.location.href = this.action;
		}
	})
}