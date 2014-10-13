<?php
class UploadFile{

		private $filepath; //指定上传文件保存路径

		private $allowtype=array('gif','jpg','png','jpeg'); //允许上传文件类型

		private $maxsize=1000000; //允许上传文件最大值

		private $israndname=true; //是否随机重命名文件

		private $originName; //源文件名称

		private $tmpFileName; //临时文件名

		private $fileType; //文件类型

		private $fileSize; //文件大小

		private $newFileName; //新文件名

		private $errorNum=0; //错误号

		private $errorMess=""; //错误消息

		//用于对上传文件初始化

		//1.指定上传路径， 2.允许类型， 3.限制大小， 4.是否使用随机文件名

		function __construct($option=array()){

			foreach($option as $key=>$value){

				$key=strtolower($key);

				if(!in_array($key, get_class_vars(get_class($this)))){

					continue;

				}

				$this->setOption($key,$value);

			}

		}

		private function getError(){

			$str="上传文件{$this->originName}时出错:";

			switch ($this->errorNum) {

				case 4:

					$str.="没有文件补上传";

					break;

				case 3:

					$str.="文件只被部分上传";

					break;

				case 2:

					$str.="上传文件超过了html表单中MAX_FILE_SIZE中设定的值";

					break;

				case 1:

					$str.="上传文件超过了php.ini中upload_max_filesize选项的值";

					break;

				case -1:

					$str.="未允许的类型";

					break;

				case -2:

					$str.="文件过大，上传不能超过{$this->maxsize}个字节";

					break;

				case -3:

					$str.="上传失败";

					break;

				case -4:

					$str.="建立存放上传文件目录失败，请重新指定上传目录";

					break;

				case -5:

					$str.="必须指定上传文件的路径";

					break;

				default:

					$str.="未知错误";

					break;

			}

			return $str."
";

		}

		//检查文件上传路径

		private function checkFilePath(){

			if(empty($this->filepath)){

				$this->setOption('errorNum',-5);

				return false;

			}

			if(!file_exists($this->filepath)||!is_writable($this->filepath)){

				if(!@mkdir($this->filepath,0755)){

					$this->setOption('errorNum',-4);

					return false;

				}

			}

			return true;

		}

		//用于检查上传文件大小

		private function checkFileSize(){

			if($this->fileSize> $this->maxsize){

				$this->setOption('erroNum',-2);

				return false;

			}else{

				return true;

			}

		}

		//用于检查文件上传类型

		private function checkFileType(){

			if(in_array(strtolower($this->fileType),$this->allowtype)){

				return true;

			}else{

				$this->setOption('errorNum',-1);

				return false;

			}

		}

		//设置上传后的文件名称

		private function setNewFileName(){

			if($this->israndname){

				$this->setOption('newFileName',$this->proRandName());

			}else{

				$this->setOption('newFileName',$this->originName);

			}

		}

		//设置随机文件名称

		private function proRandName(){

			$fileName=date("YmdHis").rand(100,999);

			return $fileName.'.'.$this->fileType;

		}

		private function setOption($key, $value){

			$this->$key=$value;

		}

		//用于上传文件

		function uploadFile($fileField){

			$return=true;

			//检查文件上传路径

			if(!$this->checkFilePath()){

				$this->errorMess=$this->getError();

				return false;

			}

			$name=$_FILES[$fileField]['name'];

			$tmp_name=$_FILES[$fileField]['tmp_name'];

			$size=$_FILES[$fileField]['size'];

			$error=$_FILES[$fileField]['error'];

			//判断是否上传多个文件

			if(is_array($name)){

				$errors=array();

				for($i=0;$i<count($name);$i++){
					if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){

						if(!$this->checkFileSize()||!$this->checkFileType()){

							$errors[]=$this->getError();

							return false;

						}

					}else{

						$errors[]=$this->getError();

						return false;

					}

					if(!$return){

						$this->setFiles(); //错误 时初始化

					}

				}

				if($return){

					$fileNames=array();

					for($i=0;$i<count($name);$i++){
						if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){

							$this->setNewFileName();

							if(!$this->copyFile()){

								$errors=$this->getError();

								$return=false;

							}else{

								$fileNames[]=$this->newFileName;

							}

						}

					}

					$this->newFileName=$fileNames;

				}

				$this->errorMess=$errors;

				return $return;

			}else{

				if($this->setFiles($name,$tmp_name,$size,$error)){

				if($this->checkFileSize()&&$this->checkFileType()){

					$this->setNewFileName();

					if($this->copyFile()){

						return true;

					}else{

						return false;

					}

				}else{

					$return=false;

				}

			}else{

				$return=false;

			}

			if(!$return){

				$this->errorMess=$this->getError();

			}

			return $return;

			}

		}

		private function copyFile(){

			if(!$this->errorNum){

				$filepath=rtrim($this->filepath, '/').'/';

				$filepath.=$this->newFileName;

				if(@move_uploaded_file($this->tmpFileName, $filepath)){

					return true;

				}else{

					$this->setOption('errorNum',-3);

					return false;

				}

			}else{

				return false;

			}

		}

		//设置与$_FILES有关的内容

		private function setFiles($name="",$tmp_name="",$size=0,$error=0){

			$this->setOption('errorNum',$error);

			if($error){

				return false;

			}

			$this->setOption('originName',$name);

			$this->setOption('tmpFileName',$tmp_name);

			$arrStr=explode('.',$name);

			$this->setOption('fileType',strtolower($arrStr[count($arrStr)-1]));

			$this->setOption('fileSize',$size);

			return true;

		}

		//用于获取上传后文件的文件名

		function getNewFileName(){

			return $this->newFileName;

		}

		//上传如果失败，则调用这个方法查看错误报告

		function getErrorMsg(){

			return $this->errorMess;

		}

	}

?>