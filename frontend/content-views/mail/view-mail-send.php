
<h1>Send Message</h1>

<form action="mail-send" method="POST" onsubmit="return confirm('Send message to <?= $_to_username ?>?')">
	<label for="to-username">To</label>
	<input type="text" name="to-username" value="<?= $_to_username ?>" />
	<br /><br />
	<label for="message"></label>
	<textarea name="message" maxlength="255" placeholder="Message"><?= $_mail_text ?></textarea>
	<br /><br />
	<input type="submit" class="button1" name="send" value="Send"/>
</form>