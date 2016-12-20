<?php
	class PostModel extends Model{
		function own($pid){
			$uid=$_SESSION['uid'];
			$post=$this->find($pid);
			if($post['uid']==$uid){
				$pos=json_decode($post['tag'],true);
				$post['tag']=implode(" ", $pos);
				return $post;
			}
		}
		function view_add($pid){
			$x=$this->find($pid);
			if($x){
				$this->where("pid='".$pid."'")->setInc("view");
			}
		}
		function re_add($pid){
			$x=$this->find($pid);
			if($x){
				$this->where("pid='".$pid."'")->setInc("re");
			}
		}
		function re_dec($pid){
			$x=$this->find($pid);
			if($x){
				$this->where("pid='".$pid."'")->setDec("re");
			}
		}
		function show($pid){
			$end=$this->find($pid);
			if($end){
				$end['tag']=json_decode($end['tag'],true);
				$re['re']="success";
				$re['end']=$end;
				$this->view_add($pid);
			}else{
				$re['re']="error";
				$re['end']="没有找到该文章！";
			}
			return $re;
		}
		function post($post){
			if(!$_SESSION['uid']){
				$re['re']="error";
				$re["end"]="权限不服！";
				return $re;
			}
			$post['tag']=strip_tags($post['tag']);
			$data['title']=$post['title'];
			$data['text']=$post['text'];
			$data['time']=time();
			$data['uid']=$_SESSION['uid'];
			preg_match_all('/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?\/>/i', $post['text'], $image);
			if(count($image)){
				$data['image']=json_encode($image[0]);
			}
			$tag=preg_replace('/\s+/', ' ', $post['tag']);
			$tag_array=explode(" ", $tag);
			$data['tag']=json_encode($tag_array);
			$pid=$this->add($data);
			foreach ($tag_array as $key => $value) {
				if(!$value){
					continue;
				}
				$zx=D('Tag')->tag_add($value,$pid);//return $tid_$tag
				$tid_tag[$zx['tid']]=$zx;
			}
			$add_tid['tid']=json_encode($tid_tag);
			$add_tid['pid']=$pid;
			D('Shelves')->post_add($pid);
			$this->save($add_tid);//
			return $pid;
		}
		function edit_show($pid){
			$jugg=$this->own($pid);
			if($jugg){
				$re['re']="success";
				$re["end"]=$jugg; 

			}else{
				$re['re']="error";
				$re["end"]="权限不服！";
			}
			return $re;
		}
		function del($pid){
			$dre=$this->own($pid);
			if($dre){
				D('Repost')->post_del($pid);//删除文章并清空该回复
				$tid_array=json_decode($dre['tid'],true);//删除TID
				foreach ($tid_array as $key=>$value ) {
					D('Tag')->tag_del_one($pid,$key);
				}
				$x=$this->delete($pid);
				if($x){
					D('Shelves')->post_del($dre);//
					$re['re']="success";
					$re['end']="成功删除！";
				}else{
					$re['re']="error";
					$re['end']="删除失败！";
				}
			}else{
				$re['re']="error";
				$re['end']="权限不服！";
			}
			return $re;
		}
		function edit($post){
			$dre=$this->own($post['pid']);
			if($dre){
				D('Tag')->post_del_tag($post['pid']);
				$data['title']=$post['title'];
				$data['text']=$post['text'];
				$post['tag']=strip_tags($post['tag']);
				preg_match_all('/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?\/>/i', $post['text'], $image);
				if(count($image)){
					$data['image']=json_encode($image[0]);
				}
				$data['retime']=time();
				$tag=preg_replace('/\s+/', ' ', $post['tag']);
				$tag_array=explode(" ", $tag);
				$data['tag']=json_encode($tag_array);
				foreach ($tag_array as $key => $value) {
					if(!$value){
						continue;
					}
					$zx=D('Tag')->tag_add($value,$post['pid']);//return $tid_$tag
					$tid_tag[$zx['tid']]=$zx;
				}
				$data['tid']=json_encode($tid_tag);
				$data['pid']=$post['pid'];
				$en=$this->save($data);
				if($en){
					$re['re']="success";
					$re['end']=$post['pid'];
				}else{
					$re['re']="error";
					$re['end']="修改失败！";
				}
			}else{
				$re['re']="error";
				$re["end"]="权限不服！";
			}
			return $re;
		}
		function list_post(){
			$uid['uid']=$_SESSION['uid'];
			$list=$this->where($uid)->order("time desc")->select();//找到
			if($list){
				$re['re']="success";
				$re['end']=$list;
			}else{
				$re['re']="error";
				$re['end']="";
			}
			return $re;
		}
		function shelves($pid){
			$p=$this->find($pid);
			if($p){
				$post['pid']=$p['pid'];
				$post['title']=$p['title'];
				$post['time']=$p['time'];
				return $post;
			}
		}
		function wechat($content){
			if($content){
				$con=explode("<>", $content);
				$add['tag']="微信";
				$add['title']=$con[0];
				$add['text']=$con[1]?$con[1]:$con[0];
				$_SESSION['uid']=1;
				$re=$this->post($add);
				$_SESSION['uid']=0;
				return $re;
			}

		}
		function wechat_location($con){
			$add['title']=$con['label'];
			$add['tag']="微信 位置";
			$add['text']=$con['location_x']."x".$con['location_y']." ".$con['scale'];
			$_SESSION['uid']=1;
			$re=$this->post($add);
			$_SESSION['uid']=0;
				return $re;


		}
		function wechat_image($image){
			$name=time();
			$name=$name.mt_rand(1000,9999);
			$dir="./Uploads/image/wechat/".$name.".jpg";
			wechat_download($image,$dir);
			$add['title']="随拍:".date("m-d")."日";
			$h_dir=substr($dir, 1);
			$add['text']="<img src=".$h_dir." style=\"max-width:400px\"/>";
			$add['tag']="微信 随拍";
			$_SESSION['uid']=1;
			$re=$this->post($add);
			$_SESSION['uid']=0;
				return $re;
			


		}
		
		


	}