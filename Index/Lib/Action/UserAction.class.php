<?php
	/**
	* 
	*/
	class UserAction extends Action{
		function __construct()
		{
			parent::__construct();
		}
		function login(){
			D('User')->cookie_auth();
			if ($_SESSION['uid']) {
				$this->redirect("/Index/index");//自动跳转*
			}
			if ($_POST['name']) {
				$name=$_POST['name'];
				$pass=$_POST['pass'];
				$re=D('User')->login($name,$pass);
				if ($re['status']) {
					$this->redirect("/Index/index");//自动跳转*
				}else{
					$this->error($re['z']);
				}
			}else{
				$this->display();
			}
		}
		function join(){
			if ($_SESSION['uid']) {
				$this->redirect("/Index/index");//自动跳转*
			}
			if($_POST['name']){
				$info['name']=$_POST['name'];
				$info['pass']=$_POST['pass'];
				$re=D('User')->join($info);
				if($re['status']){
					$this->redirect("/Index/index");//自动跳转*
				}else{
					$this->error($re['z']);
				}
			}else{
				$this->display();
			}
		}
	}