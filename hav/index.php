<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect_hav.php";?>
	<div class="content">
		<p></p>
        <ul>
       		<?php
				$re = mysql_query("SELECT id,name FROM title");
				While(($row = mysql_fetch_array($re))) {
					echo '<li><a href="action.php?id='.$row[0].'">'.$row[1].'</li>';
				}
			?>
        </ul>
	</div>
	<div class="sidenav">
		<ul>
			<li><a href="add.php">Thêm vào bài học mới</a></li>
			<li><a href="words.php">Xem từ đã học</a></li>
		</ul>
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>