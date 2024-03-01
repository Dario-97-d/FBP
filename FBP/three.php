<?php include("header.php");
if(!isset($_GET['id'])||!ctype_digit($_GET['id'])||$_GET['id']==$uid){exit(header("Location: playthree"));}$pid=$_GET['id'];
$player=sql_query($conn,"SELECT skl,rtg,name FROM uatts a JOIN umate u ON a.id=u.id WHERE u.id=".$pid."");
if(mysqli_num_rows($player)!=1){exit(header("Location: playthree"));}
extract($pdata=mysqli_fetch_assoc($player),EXTR_PREFIX_ALL,"p");$rtg+=15;$p_rtg+=8;$skl+=10;$p_skl+=8;
$b1=ceil(($rtg+$p_rtg)/2);$b2=floor(($rtg+$p_rtg)/2);
$t_rtg=$rtg*$p_rtg;$b_rtg=$b1*$b2;
$f1=1+((substr(microtime(true),-1,1)%5)/50);
$f2=1+((substr(microtime(true),-2,1)%5)/50);
$f3=1-((substr(microtime(true),-3,1)%5)/50);
$f4=1-((substr(microtime(true),-4,1)%5)/50);
$perf=round($f1*($skl/$rtg)*$rtg*$t_rtg/$b_rtg,2);
$p_perf=round($f2*($p_skl/$p_rtg)*$p_rtg*$t_rtg/$b_rtg,2);
$b1_perf=round($f3*$b1*$t_rtg/$b_rtg,2);
$b2_perf=round($f4*$b2*$t_rtg/$b_rtg,2);
//$perf=round(10*$rtg*($rtg+$p_rtg)/($b_rtg*($t_rtg+$b_rtg)),1);
//$p_perf=round(10*$p_rtg*($rtg+$p_rtg)/($b_rtg*($t_rtg+$b_rtg)),1);
//$b1_perf=round(10*$b1*($b1+$b2)/($t_rtg*($t_rtg+$b_rtg)),1);
//$b2_perf=round(10*$b2*($b1+$b2)/($t_rtg*($t_rtg+$b_rtg)),1);
?>
<h1>Practice 3v3</h1>
<table class="table2" id="table2-qmatch" cellpadding="8" cellspacing="0">
	<tr><th><?php echo $name."</th><th>".$p_name."</th><th>vs</th><th>Bot1</th><th>Bot2";?></th></tr>
	<tr><td><?php echo $rtg."</td><td>".$p_rtg."</td><td>RTG</td><td>".$b1."</td><td>".$b2."</td>";?></tr>
	<tr><td><?php echo $skl."</td><td>".$p_skl."</td><td>SKL</td><td>".$b1."</td><td>".$b2."</td>";?></tr>
	<tr><td><?php echo $perf."</td><td>".$p_perf."</td><td>Performance</td><td>".$b1_perf."</td><td>".$b2_perf;?></td></tr>
	<tr><td colspan="2"><?php echo round(5*$f1*$f2*$perf*$p_perf/$b_rtg);?></td><td>Result</td><td colspan="2"><?php echo round(5*$f3*$f4*$b1_perf*$b2_perf/$t_rtg);?></td></tr>
	<tr><td colspan="5" style="background:limegreen;"></td></tr>
</table>
<h3>You won and played best.<br />Well done! Skill +1</h3>
<h3>You weren't that good but your mate won the game for you.<br />Random ATT +1</h3>
<h3>Too close to call!<br />You need to do better next time</h3>
<h3>Your side lost but it wasn't all bad.<br />Random ATT +1</h3>
<h3>What a disgrace.<br />Maybe you should start working harder!</h3>
<table class="table2" cellpadding="8">
	<tr><th colspan="5">RTG: <?php echo $rtg;?></th></tr>
	<tr><th width="48px">STR</th><th width="48px">MOV</th><th width="48px">SKL</th><th width="48px">ATK</th><th width="48px">DFS</th></tr>
	<?php echo'<tr><td>'.$str.'</td><td>'.$mov.'</td><td>'.$skl.'</td><td>'.$atk.'</td><td>'.$dfs.'</td></tr>';?>
	<tr><th colspan="5"><?php echo $tps;?></th></tr>
</table>
<?php include("footer.php");?>