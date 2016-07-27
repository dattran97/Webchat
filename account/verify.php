<?php
	session_start();
	If(empty($_SESSION['regcode']) && empty($_SESSION['resetcode'])){
		header('Location:index.php');
	}
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		<p class="form_title">Xác nhận tài khoản</p>
		<?php
			if(isset($_SESSION['regcode'])){echo $_SESSION['regcode'];
				If(isset($_GET['key']) || isset($_GET['submit'])){
					If($_GET['key']==$_SESSION['regcode']){
						mysql_query("INSERT INTO members(fullname,username,sex,password,email,avatar) VALUES ('".$_SESSION['regfullname']."','".$_SESSION['regusername']."','".$_SESSION['regsex']."','".$_SESSION['regpassword']."','".$_SESSION['regemail']."','default.jpg')");
						$row=mysql_fetch_array(mysql_query("SELECT username FROM members WHERE username='".$_SESSION['regusername']."'"));
						session_destroy();
						session_start();
						$_SESSION['username']=$row['username'];
						$_SESSION['avatar']='default.jpg';
						header('location:../account/setavatar.php');
					}else{
						echo'<span id="red">(*)Mã xác nhận không đúng</span><br>';
					}
				}
			}else{
				If(isset($_SESSION['resetcode'])){echo $_SESSION['resetcode'];
					If(isset($_GET['key']) || isset($_GET['submit'])){
						If($_GET['key']==$_SESSION['resetcode']){
							mysql_query("UPDATE members SET password='".$_SESSION['resetcode']."'WHERE email='".$_SESSION['resetemail']."'");
							$row=mysql_fetch_array(mysql_query("SELECT username FROM members WHERE email='".$_SESSION['resetemail']."'"));		
							echo'<p id="red">Tài khoản <strong>'.$row['username'].'</strong> đã được thay đổi mật khẩu thành <strong>"'.$_SESSION['resetcode'].'"</strong></p><br><br>';
							echo'<span>Nhấn vào <a href="../account/login.php">đây</a> để đăng nhập tài khoản và thay đổi mật khẩu</span><br><br>';
							session_destroy();
							echo'</div><div class="sidenav"></div>';
							include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";
							exit;
						}else{
							echo'<span id="red">(*)Mã xác nhận không đúng</span><br>';
						}
					}
				}else{
				echo'</div><div class="sidenav"></div>';
				include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";
				exit;
				}
			}
		?>
		<form method='get'>
			<span>Chúng tôi đã gửi một mã xác nhận đến email của bạn, bạn vui lòng vào email để kiểm tra và điền mã xác nhận vào ô bên dưới</span><br><br>
			Nhập mã xác nhận vào đây: <input name="key"><br><br>
			<input class="form_submit" type="submit" name="submit" value="Submit"><br>
		</form>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>