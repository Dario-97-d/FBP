<?php include("header.php");
if(isset($_SESSION['uid'])){exit(header("Location: index"));}
// still to be verified
$receiver="";
$pmtext="";
// handle username
if(isset($_GET['to'])){$receiver = handle_name($_GET['to']);} // echo-ed later in input
if(isset($_POST['send'])){
	// handle username
	$receiver = handle_name($_POST['to']);
	// check name is valid
	if($receiver != "Invalid Username"){
		// look for the person who's set to receive the message
		$checkplayer = sql_query($conn, "SELECT id FROM users WHERE name='".$receiver."'");
		// check player exists
		if(mysqli_num_rows($checkplayer) != 1){$receiver = "User not found";}
		else{
			/* STILL TESTING -- ENCODE textarea ? function handle_text()
			// handle text
			$pmtext = handle_text($_POST['pmtext']);
			if($pmtext != ""){echo $pmtext;}
			else{
				// send
				sql_query("INSERT INTO mailbox (time,pmfrom,pmto,pmtext,seen) 
				VALUES ('".time()."','".$name."','".$receiver."','".$pmtext."',0)");
				echo "Message sent";
			}
			STILL TESTING */
		}
	}
}
?>
<h1>Message Sender</h1>
<form action="msend" method="POST">
	To
	<br />
	<input type="text" name="to" value="<?php echo $receiver?>"/>
	<br /><br />
	<textarea name="pmtext" maxlength="800"><?php echo $pmtext?></textarea>
	<br /><br />
	<input type="submit" class="button1" name="send" value="Send"/>
</form>
<?php include("footer.php");?>