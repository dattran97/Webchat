<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect_hav.php";?>
	<?php
		echo'
		<div class="content">';
			$id=$_GET['id'];
			$name = mysql_query("SELECT name FROM title WHERE id='".$id."'");
			$re = mysql_query("SELECT id,eng,vie,kind,pronounce,learned FROM content WHERE title='".$id."'");
			$i=0;
			echo '<ul>';
			While(($row = mysql_fetch_array($re))) {
				echo '<li>'.$row[0].'>> '.$row[1];
				If($row[3]!=''){ echo ' ('.$row[3].')';}
				If($row[4]!=''){ echo ' /'.$row[4].'/';}
				echo ' : '.$row[2].'</li>';
				$num[$i]=$row[0];
				$eng[$i]=$row[1];
				$vie[$i]=$row[2];
				$i++;
			}
			echo '</ul><br><a href="../hav/index.php">Trở về trang chủ</a>';
			echo'
		</div>
		<div class="sidenav">
			<form method="post">
				<input type="submit" name="submit" value="Learn">
				<input type="submit" name="submit" value="Add">
				<input type="submit" name="submit" value="Delete">
				<input type="submit" name="submit" value="Edit">
				<input type="submit" name="submit" value="Test"><br/>
			';
			If(isset($_POST['submit'])){
				switch ($_POST['submit']){
					case "Learn":
						echo '<p>Nhập số từ bạn muốn học hôm nay: <input value="'. ((isset($_POST['num'])) ? $_POST['num'] : '') .'" name="num"></p>
						<input type="submit" name="submit2" value="Learn">';
						break;
					case "Add":
						echo '<p>Nhập tiếng anh: <input value="'. ((isset($_POST['eng'])) ? $_POST['eng'] : '') .'" name="eng" /></p>
						<p>Nhập tiếng việt: <input value="'. ((isset($_POST['vie'])) ? $_POST['vie'] : '') .'" name="vie"></p>
						<input type="submit" name="submit2" value="Add">'; 
						break;
					case "Delete": 
						echo '<p>Nhập id của từ bạn muốn xoá: <input value="'.((isset($_POST['id'])) ? $_POST['id'] : '').'" name="id"></p>
						<input type="submit" name="submit2" value="Delete">'; 
						break;
					case "Edit": 
						echo '<p>Nhập id của từ bạn muốn sửa: <input value="'.((isset($_POST['id'])) ? $_POST['id'] : '').'" name="id"></p>
						<p>Nhập lại tiếng anh: <input value="'.((isset($_POST['eng'])) ? $_POST['eng'] : '').'" name="eng"></p>
						<p>Nhập lại tiếng việt: <input value="'.((isset($_POST['vie'])) ? $_POST['vie'] : '').'" name="vie"></p>
						<input type="submit" name="submit2" value="Edit">'; 
						break;
					case "Test":
						$row = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM content WHERE title='".$id."' AND learned=1"));
						echo'<ul><li><a href="test.php?id='.$id.'&choose=1&total='.$row[0].'">Vietnamese to English</a></li><li><a href="test.php?id='.$id.'&choose=0&total='.$row[0].'">English to Vietnamese</a></li></ul>';
						break;
				}
			}
			If(isset($_POST['submit2'])){
				switch ($_POST['submit2']){
					case "Learn": 
						echo '<p>Bạn muốn học '.$_POST['num'].' từ mới ? </p><a href="words.php?num='.$_POST['num'].'&id='.$_GET['id'].'">Đến bài học hôm nay</a>';
						break;
					case "Add":
						mysql_query("INSERT INTO content (eng,vie,title) VALUES('".$_POST['eng']."','".$_POST['vie']."',".$_GET['id'].")");
						break;
					case "Delete":
						mysql_query("DELETE FROM content WHERE id='".$_POST['id']."' LIMIT 1");
						break;
					case "Edit":
						mysql_query("DELETE FROM content WHERE id='".$_POST['id']."'");
						mysql_query("INSERT INTO content (id,eng,vie,title) VALUES('".$_POST['id']."','".$_POST['eng']."','".$_POST['vie']."',".$_GET['id'].")");
						break;
				}
			}
			echo'
			</form>
		</div>';
	?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>