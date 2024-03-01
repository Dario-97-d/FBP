<?php
// Functions

$conn = mysqli_connect('localhost', 'root', 'uchihasasukeitachi97D', 'fbp');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit(include("footer.php"));
}

function handle_name($name){
	$name=trim($name);
	// check length, safe chars, min 4 letters
	if(strlen($name) < 4 || strlen($name) > 16){$name="Name must be 4-16 chars long";}
	elseif(!ctype_alnum(str_replace(array('_','-',' '),'',$name))){$name="Characters allowed include only numbers, letters, underscore, hyphen and space";}
	elseif(strlen(str_replace(array('_','-',' ','0','1','2','3','4','5','6','7','8','9'),'',$name))<1){$name="Name must contain minimum 1 letter";}
	return $name;
}

function handle_text($text){
	$text=trim($text);
	if(strlen($text) < 1){$text="Text is null";}
	elseif(strlen($text) > 256){$text="Text is too long. Max chars: 256";} // 256 ?
	
}

function sql_query($conn,$query){
	$query = mysqli_query($conn, $query) or die(mysqli_error($conn));
	return $query;
}

function sql_select($conn, $column, $table, $rowid){
	$stmt = mysqli_prepare($conn, "SELECT ".$column." FROM ".$table." WHERE id=?") or die(mysqli_error($conn));
	mysqli_stmt_bind_param($stmt, "i", $rowid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt);
}

function select($conn, $column, $table, $whereid){
	$select = mysqli_query($conn, "SELECT ".$column." FROM ".$table." WHERE ".$whereid."") or die(mysqli_error($conn));
}

function update($conn, $table, $setcolval, $whereid){
	$update = mysqli_query($conn, "UPDATE ".$table." SET ".$setcolval." WHERE ".$whereid."") or die(mysqli_error($conn));
}

function unset_key($search, $array){
	$key = array_search($search, $array);
	unset($array[$key]);
}

function exiter($page){
	exit(header("Location: ".$page));
}
?>