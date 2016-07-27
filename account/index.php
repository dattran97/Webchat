<?php
	session_start();
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		<ul>
			<li><a href="../wc/index.php">Chat</a></li>
			<li><a href="../account/login.php">Đăng nhập</a></li>
			<li><a href="../account/register.php">Đăng kí</a></li>
			<li><a href="../account/profile.php">Quản lí tài khoản</a></li>
			<li><a href="../account/resetpass.php">Quên mật khẩu</a></li>
			<li><a href="../account/logout.php">Đăng xuất</a></li>
			<li><a href="../account/setavatar.php">Thay đổi Avatar</a></li>
		</ul>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>