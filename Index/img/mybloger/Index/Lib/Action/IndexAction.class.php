<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		$all=D('Post')->order("time desc")->select();
		$count=count($all);
		$site=D('Site')->find(1);
		$xpage=$site['page'];
		import('ORG.Util.Page');
		$Page=new Page($count,$xpage);
		if($_GET['p']<1){
             $_GET['p']=1;
        }else{
             $_GET['p']=(int)$_GET['p'];//
        }
        $list=array_slice($all, $xpage*($_GET['p']-1),$xpage);
        $this->assign('list',$list);
        $show=$Page->show();
      	$this->assign('page',$show);
        $is_mobile=is_mobile();
        if($is_mobile){
            $this->display("mobile_index");
            return;
        }
      	$this->display();
    }
    function post(){
    	$pid=(int)$_GET['pid'];
    	$post=D('Post')->find($pid);
    	if ($post) {
    		$repost=D('Repost')->allrepost($pid);
    		import('ORG.Util.Page');
    		$count=count($repost);
    		$Page=new Page($count,25);
       		$Page->setConfig('header',"条评论");
       		if($_GET['p']<1){
            	$_GET['p']=1;
            }else{
               $_GET['p']=(int)$_GET['p'];//
            }
            $list=array_slice($repost, 25*($_GET['p']-1),25);
        	$this->assign('repost',$list);
        	$show=$Page->show();
      		$this->assign('page',$show);
    		$this->assign("post",$post);
    		D('Post')->view_add($pid);
            $is_mobile=is_mobile();
            if($is_mobile){
                $this->display("mobile_post");
                return;
            }
    		$this->display();
    	}else{
    		$this->error("无该文章！");
    	}
    }
    function tag(){
    	$tid=(int)$_GET['tid'];
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
    }
    function search(){
        $is_mobile=is_mobile();
        if($is_mobile){//移动页面搜索
            if(!$_GET){
                $this->display("mobile_search");
                return;
            }else{
                $sea=$_GET['search'];
                $se['title']=array('like',"%".$sea."%");
                $all=D("Post")->where($se)->select();
                $count=count($all);
                import('ORG.Util.Page');
                $Page=new Page($count,20);
                if($_GET['p']<1){
                    $_GET['p']=1;
                }else{
                    $_GET['p']=(int)$_GET['p'];//
                }
                $list=array_slice($all, 20*($_GET['p']-1),20);
                $this->assign('list',$list);
                $show=$Page->show();
                $this->assign('page',$show);
                $this->display("mobile_search");
                return;
            }
        }
    	$sea=$_GET['search'];
        $se['title']=array('like',"%".$sea."%");
        $all=D("Post")->where($se)->select();
        $count=count($all);
        import('ORG.Util.Page');
		$Page=new Page($count,20);
		if($_GET['p']<1){
             $_GET['p']=1;
        }else{
             $_GET['p']=(int)$_GET['p'];//
        }
        $list=array_slice($all, 20*($_GET['p']-1),20);
        $this->assign('list',$list);
        $show=$Page->show();
      	$this->assign('page',$show);
      	$this->display();
    }
    function repost(){
    	if($_POST){
            if($_SESSION['uid']){
                $post['email']="me";
            }else{
                $post['email']=$this->_post('email');
            }
    		$post['pid']=$_POST['pid'];
    		$post['text']=$_POST['text'];
    		$re=D('Repost')->add_repost($post);
            //判断手机页面直接跳转，JqueryMobile无法二次跳转，需要改进
            $is_mobile=is_mobile();
            if($is_mobile){
                header("Location:".$_SERVER['HTTP_REFERER']);
                return;
            }
    		if($re['re']=="success"){
    			$this->success($re['end']);
    			//header("Location:".$_SERVER['HTTP_REFERER']);
    		}else{
    			$this->error($re['end']);
    		}
    	}else{
    		$this->error($re['end']);
    	}
    }
}