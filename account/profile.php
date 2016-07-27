<?php
	session_start();
	If(empty($_SESSION['username'])){
		header('Location:../account/login.php');
	}
?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";?>
	<div class="content">
		
		<?php
			if(isset($_GET['user'])){
				$row = mysql_fetch_array(mysql_query("SELECT id,fullname,username,email,avatar,sex FROM members WHERE username='".$_GET['user']."'"));
			}else{
				$row = mysql_fetch_array(mysql_query("SELECT * FROM members WHERE username='".$_SESSION['username']."'"));
			}
		?>
		<div style="width:560px;height:250px;">
		<div class="left" style="width:200px;height:250px;">
			<img src="../img/avatar/<?php echo $row['avatar'];?>" width=200px; height=200px; class="left">
			<a href="../account/setavatar.php" style="width:200px;display:block;text-align:center;float:left;">Thay đổi Avatar</a>
		</div>
		<p class="form_title">Thông tin tài khoản</p>
		</div>
		<table class="profile_table">
			<tr>
				<td>Id tài khoản:</td>
				<td><?php echo $row['id']; ?></td>
			</tr>
			<tr>
				<td>Họ và tên:</td>
				<td><?php echo $row['fullname']; ?></td>
			</tr>
			<tr>			
				<td>Tên đăng nhập:</td>
				<td><?php echo $row['username']; ?></td>
			</tr>
			<tr>				
				<td>Giới tính:</td>
				<td><?php echo $row['sex']; ?></td>
			</tr>
			<?php
				if(empty($_GET['user'])){
					echo'
			<tr>			
				<td>Mật khẩu:</td>
				<td>';for($i=0;$i<count(str_split($row['password']));$i++){echo'*';} echo'</td>
			</tr>
				';}
			?>
			<tr>			
				<td>Email:</td>
				<td><?php echo $row['email']; ?></td>
			</tr>				
		</table>
		<?php
			if(empty($_GET['user'])){
				echo'<a href="../account/changeinfo.php"><button class="form_submit";>Thay đổi thông tin</button></a>';
			}
		?>
	</div>
	<div class="sidenav">
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>