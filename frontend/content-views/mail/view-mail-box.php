
<h2>Mail Box</h2>

<h3><a href="mail-send">Write message</a></h3>
<h3><a href="mail-sent">Messages sent</a></h3>

<?php

	if ( is_array( $_mail_entries ) )
	{
		foreach ( $_mail_entries as $message )
		{
			?>
			
			<div class="mail-entry">
				
				<div class="mail-entry-header">
					
					<span class="mail-entry-header-sender">By <a href="mail-send?to-username=<?= $message['sender_username'] ?>"><?= $message['sender_username'] ?></a></span>
					<span class="mail-entry-header-time"><?=$message['time_stamp'] ?></span>
					
				</div>
				
				<div class="mail-entry-text">
					<?= nl2br( $message['mail_text'] ) ?>
				</div>
				
			</div>
			
			<?php
		}
	}
	else
	{
		?>
		
		<p>No messages to show</p>
		
		<?php
	}

?>