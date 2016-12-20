<?php
	/**
	* 
	*/
	class UserModel extends Model
	{
		function __construct(){
			parent::__construct();
			$this->cookie_auth();
		}
		function name_info($name){
			$where['name']=$name;
			$re=$this->where($where)->select();
			if($re){
				return $re[0];
			}else{
				return false;
			}
		}
		function salt_create(){
			return mt_rand(100000,999999);
		}
		function login($name,$pass){
			$neo=$this->name_info($name);
			if($neo){
				$userpass=$neo['pass'];
				$salt=$neo['salt'];
				$uid=$neo['uid'];
				$swap=md5(md5($pass).$salt);
				if ($swap==$userpass) {
					$this->session($uid);
					$re['status']=true;
				}else{
					$re['status']=false;
					$re['z']="用户名或者密码错误！";
				}
			}else{
				$re['status']=false;
				$re['z']="用户名或者密码错误！";
			}
			return $re;
		}
		function session($uid){
			$_SESSION['uid']=$uid;
		}
		function destroy_session(){
			session_destroy();
		}
		function join($info){
			$name_jugg=$this->name_info($info['name']);
			if ($name_jugg) {
				$re['status']=false;
				$re['z']="用户名重复";
				return $re;
			}
			$add['join_ip']=$_SERVER['REMOTE_ADDR'];
			$add['join_time']=time();
			$add['login_info']=json_encode($add);
			$add['image']=$info['image']?$info['image']:"null";//设置初始头像
			$add['name']=$info['name'];
			$add['salt']=$this->salt_create();
			$add['pass']=md5(md5($info['pass']).$add['salt']);
			$add['cookie']=$this->cookie_create($add['pass']);
			$uid=$this->add($add);
			$this->session($uid);
			$re['status']=true;
			$re['z']=$uid;
			return $re;

		}
		function cookie_create($auth){
			$cookie=md5($auth.time());
			setcookie("auth",$cookie,time()+86400*30);
			return $cookie;
		}
		function cookie_auth(){
			if($_COOKIE['auth']){
				$where['cookie']=$_COOKIE['auth'];
				$info=$this->where($where)->select();
				if($info[0]){
					$this->session($info['0']['uid']);
				}
			}
		}
		function cookie_destroy(){
			$this->session_destroy();
		}
		function logout(){
			$this->cookie_destroy();
		}
		function image($info){
			$save['uid']=$_SESSION['uid'];
			$save['image']=$info;
			$this->save($info);
		}
	}