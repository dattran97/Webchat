<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect_hav.php";?>
	<div class="content">
		<?php
			If(isset($_GET['num'])){
				echo'<h3>Từ mới hôm nay</h3><br>';
				$words=$_GET['num'];
				$id=$_GET['id'];
				$re = mysql_query("SELECT id,eng,vie,kind,pronounce FROM content WHERE title='".$id."' AND learned=0");
				$j=0;
				While(($row = mysql_fetch_array($re))) {
					$num[$j]=$row[0];
					$j++;
				}
				If($j<>0){
					$count=count($num);
					If ($count<$words){
						echo'<p>Danh sách của bạn chỉ còn '.$count.' từ để học</p>';
						$words=$count;
					}
					shuffle($num);
					echo '<ol>';
					For ($i=0; $i<$words; $i++){
						$row=mysql_fetch_array(mysql_query("SELECT eng,vie,kind,pronounce FROM content WHERE id='".$num[$i]."'"));
						echo '<li>'.$row[0];
						If($row[2]!=''){ echo ' ('.$row[2].')';}
						If($row[3]!=''){ echo ' /'.$row[3].'/';}
						echo ' : '.$row[1].'</li>';
						mysql_query("UPDATE content SET learned=1 WHERE id='".$num[$i]."'");
					}
					echo'</ol><a href="../hav/index.php">Trờ về trang chủ</a>';
				}else{echo'<p>Bạn đã học tất cả các từ trong danh sách này, hãy xem <a href="../hav/index.php">danh sách khác</a> hoặc <a href="test.php?id='.$id.'">kiểm tra</a></p>';}
			}else {
				echo'<h3>Những từ đã học</h3><br>';
				$re = mysql_query("SELECT eng,vie,kind,pronounce FROM content WHERE learned=1");
				echo '<ol>';
				While(($row = mysql_fetch_array($re))) {
					echo '<li>'.$row[0];
						If($row[2]!=''){ echo ' ('.$row[2].')';}
						If($row[3]!=''){ echo ' /'.$row[3].'/';}
						echo ' : '.$row[1].'</li>';
				}
				echo'</ol><a href="../hav/index.php">Trờ về trang chủ</a>';
			}
		?>
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>