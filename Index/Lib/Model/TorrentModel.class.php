<?php
	class TorrentModel extends Model{
		function torrent($info,$torrent){
			$add['hash']=$info['info_hash'];
			if(!$id=$this->jugg($add['hash'])){
				//$add['uid']=$_SESSION['uid'];
				$add['magnet']="magnet:?xt=urn:btih:".$add['hash'];
				$add['name']=$info['info']['name'];
				$add['size']=$info['info']['size'];
				$add['filecount']=$info['info']['filecount'];
				$add['encoding']=$info['encoding'];
				$add['file']=json_encode($info['info']['files']);
				$add['torrent']=$torrent;
				$add['time']=date("Y-m-d H:i",$info['creation date']);
				$add['createby']=$info['created by'];
				$add['comment']=$info['comment'];
				$tid=$this->add($add);
				D('File')->file($info['info']['files'],$tid,$add['hash']);
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
	}