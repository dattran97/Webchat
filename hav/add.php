<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/header.php";?>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect_hav.php";?>
	<div class="content">
		<form method="post" class="add">
        	<input value="<?php echo (isset($_POST['title'])) ? $_POST['title'] : ''; ?>" name="title" placeholder="Nhập tiêu đề"><br>
			<textarea name="text" placeholder="Nhập nội dung"><?php echo (isset($_POST['text'])) ? $_POST['text'] : ''; ?></textarea><br>
            <input type="submit" name="submit">
            <p>Introduce</p>
        <?php
			if(isset($_POST['submit'])){
				$title=$_POST['title'];
				$array0=array('');
				$array1=array('');
				$array2=array('');
				$text=strtolower(str_replace("\n","/", $_POST['text']));
				$array=explode("/",$text);
				$count=count($array);
				For ($i=0;$i<$count;$i++){
					If(strpos($array[$i],"[")<=0){
						$array[$i]=str_replace(":","[ :",$array[$i]);
					}
					$array_tam0=explode('[',$array[$i]);
					$array0=array_merge($array0,$array_tam0);
				}
				For ($i=1;$i<($count*2);$i= $i+2){
					If(strpos($array0[$i],"(")<=0){
						$array0[$i].="( ";
					}
					$array_tam1=explode('(',$array0[$i]); 
					$array1=array_merge($array1,$array_tam1);
					If(strpos($array0[$i+1],"]")<=0){
						$array0[$i+1] =" ]".$array0[$i+1];
					}
					$array_tam2=explode(']',$array0[$i+1]);
					$array2=array_merge($array2,$array_tam2);
				}
				echo '<ul class="result"><h2>'.$title.'</h2><br>';
				For ($i=1;$i<($count*2);$i = $i+2){
					$array1[$i+1]=str_replace(")","",$array1[$i+1]);
					$array2[$i+1]=str_replace(":","",$array2[$i+1]);
					array_map('trim',$array1);
					array_map('trim',$array2);
					echo '<li>'.$array1[$i];
					If($array1[$i+1]!=' '){ echo ' ('.$array1[$i+1].')';}
					If($array2[$i]!=' '){ echo ' /'.$array2[$i].'/';}
					echo ' : '.$array2[$i+1].'</li>';
				}
				echo '</ul><br><br>
				<p>Bạn có chắc chắn muốn thêm chúng vào bài học</p>
				<input type="submit" name="submit1" value="Có"/>
				<a href="add.php"><input type="submit" value="Nhập lại"/></a>';
			}
			if(isset($_POST['submit1'])){ 
				$title=$_POST['title'];
				$array0=array('');
				$array1=array('');
				$array2=array('');
				$text=strtolower(str_replace("\n","/", $_POST['text']));
				$array=explode("/",$text);
				$count=count($array);
				For ($i=0;$i<$count;$i++){
					If(strpos($array[$i],"[")<=0){
						$array[$i]=str_replace(":","[ :",$array[$i]);
					}
					$array_tam0=explode('[',$array[$i]);
					$array0=array_merge($array0,$array_tam0);
				}
				For ($i=1;$i<($count*2);$i= $i+2){
					If(strpos($array0[$i],"(")<=0){
						$array0[$i].="( ";
					}
					$array_tam1=explode('(',$array0[$i]); 
					$array1=array_merge($array1,$array_tam1);
					If(strpos($array0[$i+1],"]")<=0){
						$array0[$i+1] =" ]".$array0[$i+1];
					}
					$array_tam2=explode(']',$array0[$i+1]);
					$array2=array_merge($array2,$array_tam2);
				}
				mysql_query("INSERT INTO title (name) VALUES ('".$title."')");
				$num = mysql_insert_id();
				For ($i=1;$i<($count*2);$i=$i+2){
					$array1[$i+1]=str_replace(")","",$array1[$i+1]);
					$array2[$i+1]=str_replace(":","",$array2[$i+1]);
				}
				$array1=array_map('trim',$array1);
				$array2=array_map('trim',$array2);
				For ($i=1;$i<($count*2);$i=$i+2){
					$sql="INSERT INTO content (eng,vie,kind,pronounce,title) VALUES('".mysql_escape_string($array1[$i])."','".mysql_escape_string($array2[$i+1])."','".$array1[$i+1]."','".mysql_escape_string($array2[$i])."',".$num.")";
					mysql_query($sql);
				}
				echo '<span>Đã thêm thành công, mời bạn quay về trang chủ</span>';
			}
		?></form>

        <br><a href="../hav/index.php">Trờ về trang chủ</a>
	</div>
<?php include"{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/footer.php";?>