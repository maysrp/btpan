<?php
	class PostAction extends Action{
		function __construct(){
			parent::__construct();
			if(!$_SESSION['uid']){
				$this->error("请先登入！",U('User/login'));
			}
		}
		function index(){
			if($_POST){
				$post['title']=$_POST['title'];
				$post['tag']=$_POST['tag'];
				$post['text']=$_POST['text'];
				$post['pid']=$_POST['pid'];
				D('Post')->post($post);
			}else{
				$this->display();
			}

		}
	}