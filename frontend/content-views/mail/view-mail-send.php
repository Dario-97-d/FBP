
<h1>Send Message</h1>

<form action="mail-send" method="POST" onsubmit="return confirm('Send message to <?= $_to_username ?>?')">
	
	<label for="username">To</label>
	<input type="text" id="username" name="to-username" value="<?= $_to_username ?>" autocomplete="on" placeholder="Username" required>
	
	<br /><br />
	
	<label for="message"></label>
	<textarea id="message" name="message" maxlength="1000" placeholder="Message" required><?= $_mail_text ?></textarea>
	
	<br /><br />
	
	<input type="submit" class="button1" name="send" value="Send" />
</form>

<h3><a href="mail-box">Messages received</a></h3>
<h3><a href="mail-sent">Messages sent</a></h3>