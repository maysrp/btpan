<?php 
 	class UserAction extends Action{
 		function __construct(){
 			parent::__construct();
 		}
 		function login(){
 			if($_SESSION['uid']){
 				$this->success("你已登入！",U('User/index'));
 				return;
 			}
 			$xe=D('User')->getcookie();
 			if($xe['re']=="success"){
 				$this->success($xe['end'],U('User/index'));
 				return;
 			}
 			if($_POST){
 				$post['name']=$_POST['name'];
 				$post['password']=$_POST['password'];
 				$re=D('User')->login($post);
 				if($re['re']=="success"){
 					D('User')->setcookie();
 					$this->success($re['end'],U('User/index'));
 				}else{
 					$this->error($re['end']);
 				}
 			}else{
 				$this->display();
 			}
 		}
 		function index(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			$re=D('User')->user();
 			$this->assign("user",$re);
 			$this->display();
 		}
 		function add(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST){
 				$post['title']=$_POST['title'];
				$post['tag']=$_POST['tag'];
				$post['text']=$_POST['text'];
				D('Post')->post($post);
				$this->success("发布成功!",'/index.php/User/lpost');
 			}else{
 				$this->display();
 			}
 		}
 		function edit(){
 			$pid=(int)$_GET['pid'];
 			$re=D('Post')->edit_show($pid);
 			if($re['re']=="success"){
 				if($_POST){
 					$post['title']=$_POST['title'];
 					$post['text']=$_POST['text'];
 					$post['tag']=$_POST['tag'];
 					$post['pid']=$_POST['pid'];
 					$re=D('Post')->edit($post);
 					if($re['re']=="success"){
 						$this->success("修改成功!");
 					}else{
 						$this->error($re['end']);
 					}

 				}else{
 					$this->assign("post",$re['end']);
 					$this->display();
 				}
 			}else{
 				$this->error($re['end']);
 			}
 		}
 		function lpost(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			$re=D('Post')->list_post();
 			$list=$re['end'];
 			$count=count($list);
 			import('ORG.Util.Page');
 			$Page=new Page($count,25);
 			if($_GET['p']<1){
 				$_GET['p']=1;
 			}else{
 				$_GET['p']=(int)$_GET['p'];
 			}
 			$my=array_slice($list, 25*($_GET['p']-1),25);
 			$this->assign("list",$my);
 			$show=$Page->show();
 			$this->assign("page",$show);
 			$this->display();
 		}
 		function delete(){
 			$pid=(int)$_GET['pid'];
 			$re=D('Post')->del($pid);
 			if($re['re']=="success"){
 				$this->success($re['end']);
 			}else{
 				$this->error($re['end']);
 			}
 		}
 		function tag(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			$tid=(int)$_GET['tid'];
 			$tag=$_GET['tag'];
 			if($tid){
 				$list=D('Tag')->tid_find($tid);
 				if($list){
 					$taginfo=D('Tag')->find($tid);
 					$count=count($list);
 					import('ORG.Util.Page');
 					$Page=new Page($count,25);
 					if($_GET['p']<1){
 						$_GET['p']=1;
 					}else{
 						$_GET['p']=(int)$_GET['p'];
 					}
 					$my=array_slice($list, 25*($_GET['p']-1),25);
 					$this->assign("tag",$taginfo['tag']);
 					$this->assign("list",$my);
 					$show=$Page->show();
 					$this->assign("page",$show);
 					$this->display();
 					return;
 				}else{
 					$this->display();
 					return;
 				}
 			}else{
 				$this->error("无该标签！");
 				return;
 			}
 			if($tag){
 				$list=D('Tag')->tag_find($tag);
 				if($list){
 					$count=count($list);
 					import('ORG.Util.Page');
 					$Page=new Page($count,25);
 					if($_GET['p']<1){
 						$_GET['p']=1;
 					}else{
 						$_GET['p']=(int)$_GET['p'];
 					}
 					$my=array_slice($list, 25*($_GET['p']-1),25);
 					$this->assign("list",$my);
 					$show=$Page->show();
 					$this->assign("page",$show);
 					$this->assign("tag",$tag);
 					$this->display();
 					return;
 				}else{
 					$this->assign("tag",$tag);
 					$this->display();
 					return;
 				}
 			}else{
 				$this->error("无该标签！");
 				return;
 			}
 		}
 		function alltag(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			$all=D('Tag')->order("num desc")->select();
 			$this->assign("all",$all);
 			$this->display();
 		}
 		function footer(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST['footer']){
 				$save['footer']=$_POST['footer'];
 				$save['sid']=1;
 				D('Site')->save($save);
 				$this->success("修改成功！");
 			}
 		}
 		function javascript(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST['javascript']){
 				$save['sid']=1;
 				$save['javascript']=$_POST['javascript'];
 				D('Site')->save($save);
 				$this->success("修改成功！");
 			}	
 		}
 		function footer_javascript(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST){
 				$save['sid']=1;
 				$save['description']=$_POST['description'];
 				$save['keywords']=$_POST['keywords'];
 				$save['footer']=$_POST['footer'];
 				$save['javascript']=$_POST['javascript'];
 				D('Site')->save($save);
 				$this->success("修改成功！");
 			}	
 		}
 		function page(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST['page']){
 				$save['sid']=1;
 				$save['page']=(int)$_POST['page'];
 				D('Site')->save($save);
 				$this->success("修改成功！");
 			}	
 		}
 		function niming(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST['niming']){
 				$save['sid']=1;
 				$save['niming']=is_bool($_POST['niming']);
 				D('Site')->save($save);
 				$this->success("修改成功！");
 			}	
 		}
 		function site(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST){
 				$save['sid']=1;
 				$save['name']=$_POST['name'];
 				$save['logo']=$_POST['logo'];
 				$save['image']=$_POST['image'];
 				$save['niming']=$_POST['niming'];
 				$save['background-attachment']=$_POST['background-attachment'];
 				$save['background-repeat']=$_POST['background-repeat'];
 				$save['page']=(int)$_POST['page'];
 				D('Site')->save($save);
 				$this->success("修改成功！");
 			}	
 		}
 		function logout(){
 			session_destroy();
 			setcookie("auth","",time()-3600,"/");
 			D('User')->delcookie();
 			$this->success("成功离开！",U('User/login'));
 		}
 		function change(){//密码修改
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if ($_POST) {
 				$primary=$_POST['primary'];
 				$old=$_POST['old'];
 				$new=$_POST['new'];
 				if ($old==$new) {
	 				$re=D('User')->password($old,$primary);
	 				if ($re['re']=="success") {
	 					$this->success($re['end']);
	 				}else{
	 					$this->error($re['end']);
	 				}
 				}else{
 					$this->error("两次密码输入不同！");
 				}
 				
 			}else{
 				$this->error("请输入密码");
 			}
 		}
 		function repost(){
 			$list=D('repost')->order('time desc')->select();//全部文章的评论！
 			$count=count($list);
 			import('ORG.Util.Page');
 			$Page=new Page($count,25);
 			if($_GET['p']<1){
 				$_GET['p']=1;
 			}else{
 				$_GET['p']=(int)$_GET['p'];
 			}
 			$my=array_slice($list, 25*($_GET['p']-1),25);
 			$this->assign("list",$my);
 			$show=$Page->show();
 			$this->assign("page",$show);
 			$this->display();

 		}
 		function delrepost(){
 			$rid=(int)$_GET['rid'];
 			$re=D('Repost')->del_repost($rid);
 			if($re['re']=="success"){
 				$this->success($re['end']);
 			}else{
 				$this->error($re['end']);
 			}
 		}
 		function image(){
 			if($_SESSION['uid']){
 				import('ORG.Net.UploadFile');
 				$upload=new UploadFile();
 				$upload->maxSize=2408200;
 				$upload->allowExts=array('jpg','png','jpeg','gif');
 				$upload->savePath="./Uploads/tx/";
 				$upload->thumb=true;
 				$upload->thumbPrefix='m_';
 				$upload->thumbMaxWidth="300";
 				$upload->thumbMaxHeight="300";
 				if(!$upload->upload()){
 					$re['re']="error";
 					$re['end']=$this->error($upload->getErrorMsg());
 				}else{
 					$re['re']="success";
 					$re['end']=$upload->getUploadFileInfo();
 					$save['uid']=1;
 					$name=$upload->thumbPrefix.$re['end']['0']['savename'];
 					$path=$re['end'][0]['savepath'].$name;
 					$path=substr($path,1);
 					$save['image']=$path;
 					D('User')->save($save);
 				}
 				$this->ajaxReturn($re);
 			}
 		}
 		function deltag(){
 			$tid=(int)$_GET['tid'];
 			$re=D('Tag')->del_tag($tid);
 			if($re['re']=="success"){
 				$this->success($re['end']);
 			}else{
 				$this->error($re['end']);
 			}
 		}
 		function wechat(){
 			$uid=$this->_session('uid');
 			if(!$uid){
 				$this->error("请先登入！");
 				return;
 			}
 			if($_POST){
 				$add['we']=1;
 				$add['wekey']=$_POST['wekey'];
 				$add['token']=$_POST['token'];
 				$add['fromusername']="";
 				$add['time']=time();
 				$add['is_join']=0;
 				D('We')->save($add);
 			}
 			$we=D('We')->find(1);
 			$this->assign('we',$we);

 			$this->display();
 		}
 		
 	}