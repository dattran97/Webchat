<?php
	session_start();
	If(empty($_SESSION['username'])){
		header('Location:../account/login.php');
	}
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		<p class="form_title">Thay đổi avatar</p>
		<?php
			require_once "{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/account/class/upload_class.php";
			$row=mysql_fetch_array(mysql_query("SELECT id FROM members WHERE username='".$_SESSION['username']."'"));
			if(isset($_POST['submit'])){
				$upload = new Upload('upload');
				$upload->setFileExtension('jpg|png');
				$upload->setFileSize(1024);
				$upload->setUploadDir('../img/avatar/');
				$upload->setFileWidthHeight(300,300);
				if($upload->isVail() == false){
					echo'<p id="red">Thay đổi avatar thành công</p><br><br>';
					echo'<span>Nhấn vào <a href="index.php">đây</a> để trở về trang chủ</span><br><br>';
					$upload->upload(true,$row['id']);
					$_SESSION['avatar']='file_'.$row['id'].'.'.$upload->_fileExtension;
					mysql_query("UPDATE members SET avatar='".$_SESSION['avatar']."' WHERE username='".$_SESSION['username']."'");
				}else{
					foreach($upload->_error as $key => $val){
						echo '<span id="red">(*) '.$val.'</span><br>';
					}
				}
			}
		?>
		<div>
			<div style="width:200px;" class="right"><span>Yêu cầu:</span>
				<ul>
					<li>Định dạng <span id="red">jpg</span> hoặc <span id="red">png</span></li>
					<li>Không vượt quá <span id="red">2MB</span></li>
					<li>Kích thước lớn hơn <span id="red">300*300px</span></li>
				</ul>
			</div>
			<img width=300px height=300px class="left" src="../img/avatar/<?php echo $_SESSION['avatar'];?>">
		</div>
		<form method='post' enctype='multipart/form-data'>
			<input type="file" id="upload" name="upload">
			<input class="form_submit" type="submit" name="submit">
		</form>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>	