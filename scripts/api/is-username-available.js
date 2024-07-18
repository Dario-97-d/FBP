// -- Check availability of Username --
const isUsernameAvailable = async (username) =>
{
	try
	{
		const response = await fetch(
			'api/is-username-available?username='+username,
			{
				method: 'GET',
				headers: {
					'ContentType': 'application/json'
				}
			});
		
		return response.status === 200 ? await response.json() : null;
	}
	catch (error)
	{
		return null;
	}
}