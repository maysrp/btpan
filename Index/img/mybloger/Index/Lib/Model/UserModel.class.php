<?php
	class UserModel extends Model{
		function user(){//个人用户获取后台数据用改方法
			if ($_SESSION['uid']) {
				$userinfo=$this->find($_SESSION['uid']);
				$userinfo['info']=json_decode($userinfo['info'],true);
				return $userinfo;
			}
		}
		function uid($uid){
			if($uid){
				$uid_info=$this->find($uid);
				if($uid_info){
					$data['name']=$uid_info['name'];
					$data['uid']=$uid_info['uid'];
					$data['info']=json_decode($uid_info['info'],true);
					$data['ip']=$uid_info['ip'];
					$data['time']=$uid_info['time'];
					$re['re']="success";
					$re['end']=$data;
				}else{
					$re['re']="error";
					$re["end"]="未发现该用户!";
				}
			}else{
				$re['re']="error";
				$re["end"]="请填写用户id";
			}
			return $re;
		}

		function login($login_info){
			$user['name']=$login_info['name'];
			$password=$login_info['password'];
			$u_info=$this->where($user)->select();
			if($u_info['0']){
				$user_info=$u_info['0'];
				$password=md5(md5($password).$user_info['salt']);
				if($password==$user_info['password']){
					$_SESSION['uid']=$user_info['uid'];
					$_SESSION['name']=$user_info['name'];
					$this->login_info();//每次登入时写入数据库
					$re['re']="success";
					$re['end']="成功登入！";
				}else{
					$re['re']="error";
					$re['end']="密码错误！";
				}				
			}else{
				$re['re']="error";
				$re['end']="密码错误！";
			}
			return $re;
		}
		function login_info(){//添加登入信息
			if($_SESSION['uid']){
				$user_info=$this->find($_SESSION['uid']);
				if($user_info){
					$swap=json_decode($user_info['login_history'],true);
					$add['time']=time();
					$add['ip']=$_SERVER['REMOTE_ADDR'];
					$swap[]=$add;
					$add['login_history']=json_encode($swap);
					$add['uid']=$_SESSION['uid'];
					$this->save($add);
				}
			}
		}
		function join($data){
			$all=D('Site')->find(1);
			if($all['other']==1){
				$name=$this->name($data['name']);
				if($name['re']=="error"){
					$re['re']="error";
					$re['end']="用户名重复";
				}elseif ($name['re']=="success") {
					$user['time']=time();
					$user['ip']=$_SERVER['REMOTE_ADDR'];
					$swap[]=$user;
					$user['login_history']=json_encode($swap);
					$salt=mt_rand(100000,999999);
					$password=md5(md5($data['password']).$salt);
					$user['name']=$data['name'];
					$user['password']=$data['password'];
					$user['time']=time();
					$user['image']=$data['image'];
					$this->add($user);
					$re['re']="success";
					$re['end']="注册成功";
				}
			}else{
				$re['re']="error";
				$re['end']="未开放注册！";
			}
			return $re;
		}
		function name($name){
			$user['name']=$name;
			$all=$this->where($user)->select();
			if($all[0]){
				$re['re']="error";
			}else{
				$re['re']="success";
			}
			return $re;
		}
		function password($password,$primary){
			$me=$this->find($_SESSION['uid']);
			$me_primary=md5(md5($primary).$me['salt']);
			if($me_primary!=$me['password']){
				$re['re']="error";
				$re['end']="原密码错误！";
				return $re;
			}
			$salt=mt_rand(100000,999999);
			$password=md5(md5($password).$salt);
			$uid=$_SESSION['uid'];
			$data['uid']=$uid;
			$data['password']=$password;
			$data['salt']=$salt;
			$end=$this->save($data);
			if ($end) {
				$re['re']="success";
				$re['end']="密码修改成功！";
			}else{
				$re['re']="error";
				$re['end']="密码修改失败！";
			}
			return $re;
		}
		function setcookie(){//md5(md5($password).$uid)
			if ($_SESSION['uid']) {
				$all=$this->find($_SESSION['uid']);
				$rand=mt_rand(100000,999999);
				$cookie=md5(md5($all['password']).$_SESSION['uid'].$rand);
				setcookie("auth",$cookie,time()+86400*30,"/");
				$save['uid']=$_SESSION['uid'];
				$save['cookie']=$cookie;
				$this->save($save);
			}
		}
		function getcookie(){//验证登入,如果有cookie直接跳转
			$data['cookie']=$_COOKIE['auth'];
			$auth=$this->where($data)->select();
			if($auth){
				$_SESSION['uid']=$auth[0]['uid'];
				$_SESSION['name']=$auth[0]['name'];
				$this->login_info();//登入
				$re['re']="success";
				$re['end']="登入中.....";
				return $re;
			}
		}
		function delcookie(){
			$save['uid']=$_SESSION['uid'];
			$save['cookie']="";
			$this->save($save);
		}
		function image($image){
			if ($_SESSION['uid']) {
				if(is_file($image)){
					$data['uid']=$_SESSION['uid'];
					$data['image']=$image;
					$x=$this->save($data);//保持
					if($x){
						$re['re']="success";
						$re['end']="修改成功！";
					}else{
						$re['re']="error";
						$re['end']="修改失败！";
					}
				}else{
					$re['re']="error";
					$re["end"]="未发现该图片！";
				}
				return $re;
			}
		}
		function info($info){//INFO为 JSON的string数据 ,$info传入的为array
			if($_SESSION['uid']){
				$data['uid']=$_SESSION['uid'];
				$data['info']=json_encode($info);
				$x=$this->save($data);
				if($x){
					$re['re']="success";
					$re["end"]="修改成功！";
				}else{
					$re['re']="error";
					$re["end"]="修改失败";
				}
				return $re;
			}//没有UID 不执行
		}
	



	}