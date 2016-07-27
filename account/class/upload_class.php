<?php
	class Upload{
		var $_fileName;//Lưu trữ tên
		var $_fileSize;//Lưu trữ kích thước
		var $_fileExtension;//Lưu trữ phần mở rộng
		var $_fileTmp;//Lưu trữ đường dẫn của thư mục tạm
		var $_fileWidth;//Lưu trữ width
		var $_fileHeight;//Lưu trữ height
		var $_uploadDir;//Lưu trữ đường dẫn trên server
		var $_error;//Lưu trữ lỗi
		
		//Phương thức khởi tạo đối tượng
		function __construct($file_name){
			$fileinfo = $_FILES[$file_name];
			$this->_fileName = $fileinfo['name'];
			$this->_fileSize = $fileinfo['size'];
			$this->_fileExtension = $this->getFileExtension();
			$this->_fileTmp = $fileinfo['tmp_name'];
			$size=getimagesize($fileinfo['tmp_name']);
			$this->_fileWidth = $size[0];
			$this->_fileHeight = $size[1];
		}
		
		//Lấy thành phần mở rộng
		function getFileExtension(){
			$subject = $this->_fileName;
			$pattern = '#\.([^\.]+)$#i';
			preg_match($pattern,$subject,$matches);
			return $matches[1];
		}
		
		//Thiết lập thành phần mở rộng được phép Upload
		//ex:(jpg|gif|png)
		function setFileExtension($value){
			$subject=$this->_fileExtension;
			$pattern='#('.$value.')#i';
			if(preg_match($pattern,$subject)!=1){
				$this->_error[]="Phần mở rộng của file không hợp lệ";
			}
		}
		
		//Thiết lập kích thước tối thiểu được upload
		//ex:300x300px
		function setFileWidthHeight($width,$height){
			if($this->_fileWidth < $width || $this->_fileHeight < $height){
				$this->_error[]="Kích thước tập tin không hợp lệ";
			}
		}
		
		//Thiết lập dung lượng tối đa được upload
		//param ex:100 = 100kb
		function setFileSize($value){
			if(($this->_fileSize)>($value*1024)){
				$this->_error[]="Dung lượng tập tin upload quá lớn";
			}
		}
		
		//Thiết lập thư mục chứa tập tin trên server
		//param ex: img/
		function setUploadDir($value){
			if(file_exists($value)){
				$this->_uploadDir = $value;
			}else{
				$this->_error[]="Thư mục không tồn tại";
			}
		}
		
		//Kiểm tra điều kiện upload
		function isVail(){
			$flagError = false;
			if(count($this->_error)>0){
				$flagError = true;
			}
			return $flagError;
		}
		
		//Phương thức upload tập tin
		function upload($rename = false,$rename=''){
			$source = $this->_fileTmp;
			if($rename == false){
				$dect = $this->_uploadDir . $this->_fileName;
			}else{
				$dect = $this->_uploadDir . 'file_' . $rename . '.' . $this->_fileExtension;
			}copy($source,$dect);
		}
	}
?>