<?php
session_start();
include"../includes/mysql_connect.php";
	$limit=$_POST['limit'];
	$count=$_POST['count'];
	$r=mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM chatinfo"));
	if($r[0]>$count){
		echo '<input type="hidden" id="scroll" value="1">';
	}else{
		echo '<input type="hidden" id="scroll" value="0">';
	}
	$count=$r[0];
	echo '<input type="hidden" id="count" value="'.$count.'">';
	If($limit!=0){
		$r=mysql_query("SELECT * FROM chatinfo ORDER BY id DESC LIMIT 0,".$limit."");
	}else{
		$r=mysql_query("SELECT * FROM chatinfo ORDER BY id DESC");
	}
	While($row=mysql_fetch_array($r)){
		$db[]=array('name'=>$row['name'],'message'=>$row['message'],'time'=>$row['time']);
	}
	if(count($db)>25){
		echo'<a href="#" style="text-align:center;" id="limit_button" onclick="setlimit();">'.(($limit==0)?'Ẩn tin nhắn' : 'Hiển thi thêm tin nhắn').'</a>';
	}
	echo'<table>';
	If(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
	}else{
		$username='';
	}
	For ($i=(count($db)-1);$i>=0;$i--){
		If($db[$i]['name']!=$username){
			$bl='left';$span='right';
		}else{
			$bl='right';$span='left';
		}
		$r=mysql_fetch_array(mysql_query("SELECT avatar FROM members WHERE username='".$db[$i]['name']."'"));
		echo'
			<tr class="box_chat">
				<td class="'.$bl.'"><fieldset><legend>'.$db[$i]['name'].'</legend>'.$db[$i]['message'].'</fieldset></td>
				<td class="'.$bl.'"><a href="../account/profile.php?user='.$db[$i]['name'].'"><img src="../img/avatar/'.$r['avatar'].'" class="avatar"></a></td>
				<td class="'.$bl.'"><span class="'.$span.'"></span></td>
			</tr>';
	}echo'</table>';
?>