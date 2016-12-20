<?php
	class FileModel extends Model{
		function file($info,$tid,$hash,$encoding){
			$add['hash']=$hash;
			$add['tid']=$tid;
			foreach ($info as $key => $value) {
				if(is_array($value['path'])){
					if(count($value['path'])==2){
						$add['filename']=$this->encoding($value['path'][1],$encoding);
						$add['type']=$this->type($add['filename']);
					}else{
						$add['filename']=$this->encoding($value['path']['0'],$encoding);
						$add['type']=$this->type($add['filename']);
					}
				}else{
					$add['filename']=$this->encoding($value['path'],$encoding);
					$add['type']=$this->type($add['filename']);
				}
				$add['size']=$value['length'];
				$this->add($add);
			}
		}
		function type($name){
			$ar=explode(".", $name);
			$swap=array_pop($ar);
			$ex=strtolower($swap);
			switch ($ex) {
				case 'jpg':
				case 'gif':
				case 'bmp':
				case 'png':
				case 'ps':
					return "glyphicon glyphicon-picture";
					break;
				case 'mp4':
				case 'ogg':
				case 'webm':
				case '3gp':
				case 'mkv':
				case 'avi':
				case 'rm':
				case 'rmvb':
				case 'wmv':
					return "glyphicon glyphicon-film";
					break;
				case 'exe':
				case 'dll':
					return "glyphicon glyphicon-th-large";
					break;
				case 'apk':
					return "glyphicon glyphicon-phone";
					break;
				case 'html':
					return "glyphicon glyphicon-globe";
					break;
				case 'mp3':
				case 'wav':
				case 'ape':
				case 'flac':
					return "glyphicon glyphicon-music";
					break;
				case 'flv':
					return "glyphicon glyphicon-flash";
					break;
				case 'zip':
				case 'rar':
				case 'gz':
				case 'tgz':
					return "glyphicon glyphicon-compressed";
					break;
				case 'txt':
					return "glyphicon glyphicon-file";
					break;
				case 'pdf':
					return "glyphicon glyphicon-book";
					break;
				default:
					return "glyphicon glyphicon-folder-close";
					break;
			}

		}
		function encoding($str,$encoding){
        	if (strtolower($encoding)=="utf-8") {
            	return $str;
        	}else{
            	return iconv($encoding, "utf-8", $str);
        	}
   		}
	}