<?phpsession_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta name="description" content="description"/>
		<meta name="keywords" content="keywords"/> 
		<meta name="author" content="author"/> 
		<link rel="stylesheet" type="text/css" href="../css/default.css" media="screen"/>
		<title>My site-My life</title>
	</head>
	
	<body>
		<div class="top">			
			<div class="header">
				<div class="left">
					My Site-My Life
				</div>
				<div class="right"></div>
			</div>	
		</div>
		<div class="container">	
			<div class="navigation">
				<div class="menu_left">
					<a href="../index.php">Home</a>
					<a href="../wc/index.php">Chat</a>
					<a href="../hav/index.php">HAV</a>
					<a href="../account/index.php">Tài khoản</a>
					<a href="http://facebook.com/daylausername" target="_blank">Facebook</a>
					<a href="../contact.php">Contact</a>
				</div>
				<div class="menu_right">
					<?php
						if(isset($_SESSION['username'])){
							echo'<img src="../img/avatar/'.$_SESSION['avatar'].'" width=30px height=30px class="avatar_header">
							<span> Xin chào, '.$_SESSION['username'].'</span>';
						}
					?>
				</div>
				<div class="clearer"><span></span></div>
			</div>
			<div class="main">
				<div class="sidenav1">
					<ul>
						<?php
								if(isset($_SESSION['username'])){
									echo
										'<li><a href="../account/profile.php">Quản lí tài khoản</a></li>
										<li><a href="../account/logout.php">Đăng xuất</a></li>';
								}else{
									echo'
										<li><a href="../account/login.php">Đăng nhập</a></li>
										<li><a href="../account/register.php">Đăng kí</a></li>';
								}
						?>
					</ul>
				</div>