<?php
	session_start();
	If(isset($_SESSION['username'])){
		header('Location:index.php');
	}
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		<p class="form_title">Khôi phục mật khẩu</p><br>
		<?php
			If(isset($_POST['submit'])){
				if(mysql_num_rows(mysql_query("SELECT email FROM members WHERE email='".$_POST['email']."'"))>0){
					$_SESSION['resetemail']=$_POST['email'];
					function rand_string( $length ) {
						$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
						$size = strlen( $chars );
						$str='';
						for( $i = 0; $i < $length; $i++ ) {
							$str .= $chars[ rand( 0, $size - 1 ) ];
						}
						return $str;
					}
					$_SESSION['resetcode']=rand_string(rand(7,10));
					header('Location:verify.php');
				}else{
					echo'<span id="red">(*)Email này chưa được dùng để đăng kí, click vào <a href="../account/register.php">đây</a> để đăng kí tài khoản mới</span><br><br>';
				}
			}
		?>
		<form method='post'>
			<p>Nhập địa chỉ email mà bạn đã đăng kí: <input name="email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : '';?>")></p>
			<input class="form_submit" type="submit" name="submit" value="Submit">
		</form>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>