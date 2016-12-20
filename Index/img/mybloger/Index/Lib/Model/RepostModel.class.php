<?php
	/**
	* 
	*/
	class RepostModel extends Model{
		
		function __construct(){
			parent::__construct();
			$site=D('Site')->find(1);
			if($site['niming']==0){
				if(!$_SESSION['uid']){
					$re["re"]="error";
					$re["end"]="不允许匿名评论！";
					return $re;
				}
			}else{
				if(!$_SESSION['uid']){
					$_SESSION['uid']=0;//匿名专用UID
				}
			}
		}
		function add_repost($post){
			$data['pid']=$post['pid'];
			$pre=$this->where($data)->select();
			$data['lc']=count($pre)+1;
			$data['email']=$post['email'];
			$data['time']=time();
			$data['uid']=$_SESSION['uid'];
			$data['text']=$post['text'];
			$data['ip']=$_SERVER['REMOTE_ADDR'];
			$xe=$this->add($data);
			if($_SESSION['uid']=="0"){
				unset($_SESSION['uid']);
			}
			if($xe){
				D('Post')->re_add($post['pid']);
				$re['re']="success";
				$re['end']="发布成功！";
			}else{
				$re['re']="error";
				$re["end"]="发布失败！";
			}
			return $re;
		}
		function del_repost($rid){
			$repost=$this->find($rid);
			$post=D('Post')->own($repost['pid']);
			if($post){
				$xe=$this->delete($rid);
				D('Post')->where("pid='".$repost['pid']."'")->setInc("re",1);
				if($xe){
					$re['re']="success";
					$re['end']="删除成功！";
				}else{
					$re['re']="error";
					$re['end']="删除失败！";
				}
			}else{
				$re['re']="error";
				$re['end']="权限不符！";
			}
			return $re;
		}
		function allrepost($pid){//返回所有评论！
			$sea['pid']=$pid;
			$re=$this->where($sea)->select();
			return $re;
		}
		function post_del($pid){//删除文章并清空该回复
			$post=D('Post')->own($pid);
			if($post){
				$this->where("pid='".$pid."'")->delete();
			}
		}
	}