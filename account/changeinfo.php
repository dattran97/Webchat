<?php
	session_start();
	If(empty($_SESSION['username'])){
		header('Location:../account/login.php');
	}
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		<p class="form_title">Thông tin tài khoản</p>
		<?php
			$simplepass=array('123456','1234567','123456789','01234556789','1234567890');
			$error = array();
			$row = mysql_fetch_array(mysql_query("SELECT * FROM members WHERE username='".$_SESSION['username']."'"));
			if(isset($_POST['submit'])){
				If($_POST['fullname']==''){
					$error[]="Bạn chưa nhập họ và tên";
				}
				If($_POST['password']!=''){
					If(preg_match('#^.{6,32}$#',$_POST['password'])!=1){
						$error[]="Mật khẩu mới không hợp lệ";
					}else{
						Foreach($simplepass as $key => $val){
							If($_POST['password']==$val){
								$error[]="Mật khẩu mới của bạn quá đơn giản";
							}
						}
					}
				}else{
					$error[]="Bạn chưa nhập mật khẩu mới";
				}
				If($_POST['repassword']!=''){
					If($_POST['repassword'] != $_POST['password']){
						$error[]="Mật khẩu nhập lại chưa chính xác";
					}
				}else{
					$error[]="Bạn chưa nhập lại mật khẩu mới";
				}
				If($_POST['oldpassword']!=''){
					If($_POST['oldpassword']!=$row['password']){
						$error[]="Mật khẩu cũ của bạn không chính xác";
					}
				}else{
					$error[]="Bạn chưa nhập mật khẩu cũ";
				}
				If(count($error)>0){
					foreach($error as $key => $val){
						echo '<span id="red">(*) '.$val.'</span><br>';
					}
				}else{
					mysql_query("UPDATE members SET password='".$_POST['password']."',fullname='".$_POST['fullname']."'");
					header('Location:../account/profile.php');
				}
			}			
		?>
		<form method='post'>
			<table class="profile_table">
				<tr>
					<td>Id tài khoản:</td>
					<td><?php echo $row['id']; ?></td>
				</tr>
				<tr>
					<td>Họ và tên:</td>
					<td><input name="fullname" value="<?php echo (count($error)>0) ? $_POST['fullname'] : $row['fullname']; ?>"></td>
				</tr>
				<tr>
					<td>Tên đăng nhập:</td>
					<td><?php echo $row['username'];?></td>
				</tr>
				<tr>
					<td>Giới tính:</td>
					<td><?php echo $row['sex']; ?></td>
				</tr>
				<tr>
					<td>Mật khẩu mới:</td>
					<td><input type="password" name="password" value="<?php echo (count($error)>0) ? '' : $row['password']; ?>"></td>
				</tr>
				<tr>
					<td>Nhập lại mật khẩu mới:</td>
					<td><input type="password" name="repassword" value="<?php echo (count($error)>0) ? '' : $row['password']; ?>"></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?php echo $row['email'];?></td>
				</tr>
				<tr>
					<td>Mật khẩu cũ:</td>
					<td><input type="password" name="oldpassword"></td>
				</tr>
			</table>
		<input class="form_submit" type="submit" name="submit" value="Thay đổi">
		</form>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>