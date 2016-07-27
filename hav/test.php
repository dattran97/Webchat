<?php 
	session_start();
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect_hav.php";?>
	<?php
		If(!$_SESSION['id_list']){
		$_SESSION['id_list']=0;}
		If (((!isset($_SESSION['true']))and(!isset($_SESSION['false'])))or($_SESSION['id_list']!=$_GET['id'])){
			$_SESSION['true']=0;
			$_SESSION['false']=0;
			$_SESSION['tam']=0;
		}
		$_SESSION['id_list']=$_GET['id'];
		$_SESSION['ans_old'] = isset($_SESSION['ans']) && $_SESSION['ans'] != '' ? $_SESSION['ans'] : '' ;
		echo'
		<form method="post" class="testt">
			<div class="content">';
				$id=$_GET['id'];
				$choose=$_GET['choose'];
				$total=$_GET['total'];
				If($total==0){
					echo'<div><h3>Bạn chưa học từ nào trong danh sách này</h3><br>Phần kiểm tra chỉ dùng để ôn tập lại những từ đã học</div><br>
					<a href="action.php?id='.$id.'"><li>Go to a current list</li></a>';
					echo'</div></form>';
					include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";
					exit;
				}else{
					If(($_SESSION['true']+$_SESSION['false']>=$total)and(isset($_POST['next']))){
						if($_GET['choose']==1){$tam=0;}else{$tam=1;}
						echo'<h3>Bạn đã hoàn thành bài kiểm tra</h3><br>
						<ul>
							<a href="test.php?id='.$id.'&choose='.$tam.'&total='.$total.'"><li>Do the other test</li></a>
							<a href="action.php?id='.$id.'"><li>Go to a current list</li></a>
						</ul>';
						unset($_SESSION['true']);
						unset($_SESSION['false']);
						echo'</div></form>';
						include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";
						exit;
					}
				}
				If (($_SESSION['true']==0)and($_SESSION['false']==0)and(!isset($_POST['submit']))){
					$row = mysql_fetch_array(mysql_query("SELECT id,eng,vie,kind,pronounce FROM content WHERE title='".$id."' AND learned=1 ORDER BY RAND() LIMIT 1"));
					$_SESSION['id']=$row[0];
					If ($choose!=1){
						$_SESSION['ques']=$row['eng'];
						$_SESSION['ans'] = $row['vie'];
					}else{
						$_SESSION['ques']=$row['vie'];
						$_SESSION['ans'] = $row['eng'];
					}
					$_SESSION['kind']=$row['kind'];
					$_SESSION['pronounce']=$row['pronounce'];
				}else {
					if(isset($_POST['next'])){
						$row = mysql_fetch_array(mysql_query("SELECT id,eng,vie,kind,pronounce FROM content WHERE id NOT IN(".$_SESSION['id'].") AND title='".$id."' AND learned=1 ORDER BY RAND() LIMIT 1"));
						$_SESSION['id']=$_SESSION['id'].",".$row[0];
						If ($choose!=1){
							$_SESSION['ques']=$row['eng'];
							$_SESSION['ans'] = $row['vie'];
						}else{
							$_SESSION['ques']=$row['vie'];
							$_SESSION['ans'] = $row['eng'];
						}
						$_SESSION['kind']=$row['kind'];
						$_SESSION['pronounce']=$row['pronounce'];
					}
				}
				echo '<p>'.$_SESSION['ques'];
				If($_SESSION['kind']!=''){ echo ' ('.$_SESSION['kind'].')';}
				If(($_SESSION['pronounce']!='')and($choose!=1)){ echo ' /'.$_SESSION['pronounce'].'/';}
				echo'<br><input type="text" name="answer" placeholder="Nhập câu trả lời vào đây" value="'. ((isset($_POST['answer'])) && $_POST['answer']==$_SESSION['ans']  ? $_POST['answer'] : '') .'"></p>
				<input type="submit" name="submit" value="Check"><br>
				<input type="submit" name="submit" value="Show answer"><br>';
				If(isset($_POST['submit'])){
					echo '<input type="submit" value="Từ tiếp theo" name="next"><br>';
					switch ($_POST['submit']){
						case "Check":
							If($_POST['answer'] <> $_SESSION['ans_old'] && $_SESSION['ans_old'] != ''){
							echo '<span>Oop! Try again</span>';
							if($_SESSION['tam']==0){$_SESSION['false']++;}
							}else{
							echo '<span>Correct!!!</span>';
							if($_SESSION['tam']==0){$_SESSION['true']++;}
							}
					    break;
					    case "Show answer":
							echo '<span>The correct answer is "'.$_SESSION['ans'].'"';
							If(($_SESSION['pronounce']!='')and($choose==1)){ echo ' /'.$_SESSION['pronounce'].'/';}
							echo'</span>';
							if($_SESSION['tam']==0){$_SESSION['false']++;}
					    break;
					}
					$_SESSION['tam']=1;
				}
				if(isset($_POST['next'])){
					$_SESSION['tam']=0;
				}
				echo'</div><div class="sidenav">';
					echo '<ul><li><h2>Số câu đúng : '.$_SESSION['true'].'</h2></li><li><h2>Số câu sai : '.$_SESSION['false'].'</h2></li></ul>';
				echo'
				</div></form>';
	?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>