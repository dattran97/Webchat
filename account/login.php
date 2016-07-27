<?php
	session_start();
	if(isset($_SESSION['username'])){
		header('Location:index.php');
	}
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		<p class="form_title">Đăng nhập</p>
		<?php
			If(isset($_POST['submit'])){
				if(mysql_num_rows(mysql_query("SELECT username FROM members WHERE username='".$_POST['username']."'"))>0){
					$r=mysql_query("SELECT * FROM members WHERE username='".$_POST['username']."'");
					While($row=mysql_fetch_array($r)){
						if($row['password']==$_POST['password']){
							$_SESSION['username'] = $row['username'];
							$_SESSION['avatar'] = $row['avatar'];
						}else{
							echo'<span id="red">Bạn nhập sai mật khẩu, click vào <a href="../account/resetpass.php">đây</a> để khởi tạo mật khẩu mới</span>';
						}
					}
				}else{
					echo'<span id="red">Tài khoản này không tồn tại, click vào <a href="../account/register.php">đây</a> để đăng kí</span>';
				}
			}
			if(isset($_SESSION['username'])){
				echo '<table>';
				echo '<tr><h1>Đăng nhập thành công</h1><tr>
					  <tr>click vào <a href="index.php">đây</a> để trở về trang chủ</tr></table>';
				echo '</div><div class="sidenav"></div>';
				include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";
				exit;
			}
		?>
		<form method='post'>
			<table class="form_table">
				<tr>
					<td><input placeholder="Tên đăng nhập" name="username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>"></td>
					<td><span><a href="../account/register.php">Chưa có tài khoản?</a></span></td>
				</tr>
				<tr>
					<td><input placeholder="Mật khẩu" type="password" name="password"></td>
					<td><span><a href="../account/resetpass.php">Quên mật khẩu</a></span></td>
				</tr>
			</table>
			<input class="form_submit" type="submit" name="submit" value="Đăng nhập">
		</form>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>