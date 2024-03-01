<?php include("header.php");
if(!isset($_GET['id'])||is_int($pid=$_GET['id'])){exit(header("Location: players"));}
$player=mysqli_query($conn,"SELECT a.*,name FROM uatts a JOIN umate u ON a.id=u.id WHERE u.id=".$pid."") or die(mysqli_error($conn));
if(mysqli_num_rows($player)!=1){exit(header("Location: players"));}
extract($pdata=mysqli_fetch_assoc($player),EXTR_PREFIX_ALL,"p");?>
<h1><?php echo $p_name?></h1>
<table class="table2" cellpadding="8" cellspacing="0">
	<tr><th width="48px">STR</th><th width="48px">MOV</th><th width="48px">SKL</th><th width="48px">ATK</th><th width="48px">DFS</th></tr>
	<tr><td><?php echo $p_str?></td><td><?php echo $p_mov?></td><td><?php echo $p_skl?></td><td><?php echo $p_atk?></td><td><?php echo $p_dfs?></td></tr>
</table>
<?php echo ($pid!=$uid?'<h3><a href="playthree?id='.$pid.'">3v3</a></h3>':'');?>
<h3><a href="qmatch">Challenge</a> <a href="msend">Message</a></h3>
<?php include("footer.php");?>