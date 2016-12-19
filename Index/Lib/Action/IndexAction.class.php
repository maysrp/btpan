<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		$this->display();
    }
    function up(){
    	if ($_FILES['torrent']['name']) {
    		if($_FILES['torrent']['size']<15000000){//15MB
    			$name=md5_file($_FILES['torrent']['tmp_name']);
    			$arr=explode(".", $_FILES['torrent']['name']);
    			$swap=array_pop($arr);
    			$ex=strtolower($swap);
    			if ($ex=="torrent") {
    				$torrent="./uploads/".$name.".torrent";
    				move_uploaded_file($_FILES['torrent']['tmp_name'], $torrent);
    				$ar=$this->torrent($torrent);
    				$tid=D('Torrent')->torrent($ar,$torrent);
					$this->redirect('/Index/tid/tid/'.$tid);
    			}else{
    				$this->error("非种子文件");
    			}
    		}else{
    			$thie->error("该文件大于15MB");
    		}
    	}else{
    		$this->error("无文件上传");
    	}
    }
    function tid(){
    	$tid=intval($_GET['tid']);
    	$info=D('Torrent')->find($tid);
    	if($info){
    		$where['tid']=$tid;
    		$file=D('File')->where($where)->select();
    		$this->assign("info",$info);
    		$this->assign("file",$file);
    		$this->display();
    	}else{
    		$this->error("无文件");
    	}

    }
    function torrent($torrent){
    	include_once "lightbenc.php";
		$Lightbenc = new Lightbenc();
		$file_info = $Lightbenc->bdecode_getinfo($torrent);
    	return $file_info;
    }
    

}