<?php session_start();?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<script type="text/javascript" src="../js/javascript.js"></script>
	<div class="content">
		<div id="chat">
		</div>
		<?php
				If(isset($_SESSION['username'])){
					echo'
		<div class="chat_content">
			<form action="javascript:sendmessage();">
				<input type="hidden" id="limit" value=25>
				<div class="editor">
					<input type="button" value="B" id="bold" style="font-weight: bold;" onclick="addTag(0);">
					<input type="button" value="I" id="italic" style="font-style: italic;" onclick="addTag(1);">
					<input type="button" value="U" id="underline" style="text-decoration: underline;" onclick="addTag(2);">
				</div>
				<textarea id="message" name="message" placeholder="Nội dung tin nhắn"></textarea>
				<input type="submit" value="Send" name="submit" class="button">
			</form>
		</div>';
				}else{
					echo'<span>Bạn phải <a href="../account/login.php">đăng nhập</a> hoặc <a href="../account/register.php">đăng kí</a> để tham gia cuộc trò chuyện</span>';
				}
			?>
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>