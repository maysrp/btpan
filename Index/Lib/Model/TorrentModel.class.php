<?php
	class TorrentModel extends Model{
		function torrent($info,$torrent){
			$add['hash']=$info['info_hash'];
			if(!$id=$this->jugg($add['hash'])){
				$add['uid']=$_SESSION['uid']?$_SESSION['uid']:"66666666666";
				$add['encoding']=$info['encoding']?$info['encoding']:"utf-8";
				$add['magnet']="magnet:?xt=urn:btih:".$add['hash'];
				$add['name']=$this->encoding($info['info']['name'],$add['encoding']);
				$add['up_time']=time();
				$add['up_ip']=$_SERVER['REMOTE_ADDR'];
				$add['size']=$info['info']['size'];
				$add['filecount']=$info['info']['filecount'];
				$add['file']=json_encode($info['info']['files']);
				$add['torrent']=$torrent;
				$add['time']=date("Y-m-d H:i",$info['creation date']);
				$add['createby']=$info['created by'];
				$add['comment']=$info['comment']?$info['comment']:$add['name'];
				$tid=$this->add($add);
				D('File')->file($info['info']['files'],$tid,$add['hash'],$add['encoding']);
				return $tid;
			}else{
				return $id;
			}
		}
		function jugg($hash){
			$where['hash']=$hash;
			$re=$this->where($where)->select();
			if($re){
				return $re[0]['tid'];
			}
		}
		function ms($ms){
			$save['tid']=$ms['tid'];
			$info=$this->find($save['tid']);
			if ($info['uid']==$_SESSION['uid']) {
				$save['ms']=$ms['ms'];
				$save['title']=$ms['title'];
				$this->save($save);
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