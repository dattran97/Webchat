<?php
	session_start();
	if(isset($_SESSION['username'])){
		header('Location:index.php');
	}
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		<p class="form_title">Đăng kí tài khoản</p>		
		<?php
			$simplepass=array('123456','1234567','123456789','01234556789','1234567890');
			$captcha_array=array('625708','571196','071497003','538132','6625512','6360424');
			$error = array();
			function check($str,$x){
				$subject=$str;
				$boolean=false;
				switch ($x){
					case 'username':
					$pattern='#^[a-z][a-z0-9_]{4,32}$#';
					break;
					case 'password':
					$pattern='#^.{6,32}$#';
					break;
					case 'email':
					$pattern='#^[A-Za-z][A-Za-z0-9_\-\.]{2,32}@[a-z0-9_\-\-.]{2,32}.([a-z]{2,10}){1,4}$#';
					break;
				}
				if(preg_match($pattern,$subject)==1){
					$boolean=true;
				}
				return $boolean;
			}
			if(isset($_POST['submit'])){
				If(!($_POST['fullname'])){
					$error[]="Bạn chưa nhập họ và tên";
				}
				If($_POST['username']!=''){
					If(check($_POST['username'],'username') == false){
						$error[]="Tên đăng nhập không hợp lệ";
					}else{
						if(mysql_num_rows(mysql_query("SELECT username FROM members WHERE username='".$_POST['username']."'"))>0){
							$error[]="Tên đăng nhập này đã có người sử dụng, xin vui lòng chọn tên khác";
						}
					}
				}else{
					$error[]="Bạn chưa điền vào tên đăng nhập";
				}
				If($_POST['password']!=''){
					If(check($_POST['password'],'password') == false){
						$error[]="Mật khẩu không hợp lệ";
					}else{
						Foreach($simplepass as $key => $val){
							If($_POST['password']==$val){
								$error[]="Mật khẩu của bạn quá đơn giản";
							}
						}
					}
				}else{
					$error[]="Bạn chưa nhập mật khẩu";
				}
				If($_POST['repassword']!=''){
					If($_POST['repassword'] != $_POST['password']){
						$error[]="Mật khẩu nhập lại chưa chính xác";
					}
				}else{
					$error[]="Bạn chưa nhập lại mật khẩu";
				}
				If($_POST['email']!=''){
					If(check($_POST['email'],'email') == false){
						$error[]="Email bạn nhập không hợp lệ";
					}else{
						if(mysql_num_rows(mysql_query("SELECT email FROM members WHERE email='".$_POST['email']."'"))>0){
							$error[]="Email này đã có người sử dụng, xin vui lòng chọn email khác";
						}
					}
				}else{
					$error[]="Bạn chưa nhập email";
				}
				If(empty($_POST['sex'])){
					$error[]="Bạn chưa chọn giới tính";
				}
				If($_POST['captcha']!=''){
					If($_POST['captcha'] != $_POST['captcha_ans']){
						$error[]="Captcha bạn nhận chưa chính xác";
					}
				}else{
					$error[]="Bạn chưa nhập captcha";
				}
				If(count($error)>0){
					foreach($error as $key => $val){
						echo '<span id="red">(*) '.$val.'</span><br>';
					}
				}else{
					$_SESSION['regfullname']=$_POST['fullname'];
					$_SESSION['regusername']=$_POST['username'];
					$_SESSION['regpassword']=addslashes($_POST['password']);
					$_SESSION['regemail']=$_POST['email'];
					$_SESSION['regsex']=$_POST['sex'];
					function rand_string( $length ) {
						$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
						$size = strlen( $chars );
						$str='';
						for( $i = 0; $i < $length; $i++ ) {
							$str .= $chars[ rand( 0, $size - 1 ) ];
						}
						return $str;
					}
					$_SESSION['regcode']=rand_string(rand(5,10));
					header('Location:verify.php');
				}
			}
			$captcha=$captcha_array[array_rand($captcha_array)];
		?>
		<script>
			function showintro(string){
				switch (string){
					case 'fullname':
						var str="Họ và tên từ 2-32 kí tự, không sử dụng kí tự đặc biệt, nên viết tiếng Việt có dấu";
						break;
					case 'username':
						var str="Tên tài khoản từ 4 - 32 ký tự, chỉ được sử dụng số, chữ thường và dấu gạch dưới, không sử dụng tiếng Việt có dấu";
						break;
					case 'password':
						var str="Mật khẩu từ 6 - 32 kí tự, không sử dụng mật khẩu quá đơn giản";
						break;
					case 'email':
						var str="Hãy sử dụng email thật, vì email dùng để kích hoạt tài khoản, khôi phục mật khẩu,...";
						break;
				}
				document.getElementById(string).innerHTML=str;
			}
			function hideintro(string){
				document.getElementById(string).innerHTML='';
			}
		</script>
		<form method='post'>
			<table class="form_table">
				<tr>
					<td><input name="fullname" placeholder="Họ tên đầy đủ" onfocus="showintro('fullname');" onblur="hideintro('fullname');" value="<?php echo (isset($_POST['fullname'])) ? $_POST['fullname'] : ''; ?>"></td>
					<td><span id="fullname"></span></td>
				</tr>
				<tr>
					<td><input name="username" placeholder="Tên tài khoản" onfocus="showintro('username');" onblur="hideintro('username');" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>"></td>
					<td><span id="username"></span></td>
				</tr>
				<tr>
					<td>Nam:<input type="radio" name="sex" value="Nam">
					Nữ:<input type="radio" name="sex" value="Nữ"></td>
				</tr>
				<tr>
					<td><input type="password" placeholder="Mật khẩu" onfocus="showintro('password');" onblur="hideintro('password');" name="password" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : ''; ?>"></td>
					<td><span id="password"></span></td>
				</tr>
				<tr>
					<td><input type="password" placeholder="Nhập lại mật khẩu" name="repassword" value="<?php echo (isset($_POST['repassword'])) ? $_POST['repassword'] : ''; ?>"></td>
				</tr>
				<tr>
					<td><input name="email" placeholder="Email" onfocus="showintro('email');" onblur="hideintro('email');" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>"></td>
					<td><span id="email"></span></td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="captcha_ans" value="<?php echo$captcha;?>">
						<img src="../img/captcha/<?php echo $captcha;?>.jpg">
						<input name="captcha" placeholder="Nhập mã captcha">
					</td>
				</tr>
			</table>
			<input type="submit" value="Đăng kí" name="submit" class="form_submit";>
		</form>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>