<?php
	class TagModel extends Model{
		function tag_add($tag,$pid){
			$se['tag']=$tag;
			$en=$this->where($se)->select();
			$pid=D('Post')->find($pid);
			if(!$pid){
				return;
			}
			if($en){//如果原来的存在
				$post=json_decode($en[0]['post'],true);
				$post[]=$pid['pid'];
				$num=count($post);
				$xe['num']=$num;
				$xe['tid']=$en[0]['tid'];
				$post=array_unique($post);
				$xe['post']=json_encode($post);
				$this->save($xe);
				$re['tid']=$xe['tid'];
				$re['tag']=$tag;
				return $re;
			}else{
				$post[]=$pid['pid'];
				$xe['time']=time();
				$xe['tag']=$tag;
				$xe['post']=json_encode($post);
				$xe['uid']=$_SESSION['uid'];
				$xe['num']=1;
				$tid=$this->add($xe);
				$re['tid']=$tid;
				$re['tag']=$tag;
				return $re;
			}
		}
		function del_tag($tid){
			if($_SESSION['uid']==1){//admin
				$info=$this->find($tid);
				$pid_array=json_decode($info['post']);
				foreach ($pid_array as $key => $value) {
					$post=D('Post')->find($value);
					if ($post) {
						$tid_array=json_decode($post['tid'],true);
						unset($tid_array[$tid]);
						$save['pid']=$value;
						$save['tid']=json_encode($tid_array);
						D('Post')->save($save);
					}
				}
				$xe=$this->delete($tid);
				if($xe){
					$re['re']="success";
					$re['end']="删除成功！";
				}else{
					$re['re']="error";
					$re["end"]="删除失败！";
				}
			}else{
				$re["re"]="error";
				$re["end"]="权限不服！";
			}
			return $re;
		}
		function tag($tag){
			$se['tag']=$tag;
			$en=$this->where($se)->select();
			if ($en) {
				$end=$en[0];
				$end['post']=json_decode($end['post'],true);
				$re['re']="success";
				$re['end']=$end;
			}else{
				$re['re']="error";
				$re["end"]="未找到该标签！";
			}
			return $re;
		}
		function tag_del_one($pid,$tid){//删除Tid中的PID
			$xe=$this->find($tid);
			$arr=json_decode($xe['post'],true);//ARRAY
			$xee=in_array($pid, $arr);
			if($xee){
				$key=array_search($pid ,$arr);
				array_splice($arr,$key,1);
				$save['post']=json_encode($arr);
				$save['tid']=$tid;
				$save['num']=$xe['num']-1;
				$this->save($save);
			}
		}
		function post_del_tag($pid){//删除POST中对应的tag
			$pre=D('Post')->find($pid);
			$tag=json_decode($pre['tid'],true);//获得全部
			foreach ($tag as  $value) {
				$this->tag_del_one($pid,$value['tid']);
			}

		}
		function tid_find($tid){
			$my=$this->find($tid);
			$post=json_decode($my['post'],true);
			foreach ($post as $key => $value) {
				$re[]=D('Post')->find($value);
			}
			arsort($re);
			return $re;
		}
		function tag_find($tag){
			$t['tag']=$tag;
			$my=$this->where($t)->select();
			$post=json_decode($my[0]['post'],true);
			foreach ($post as $key => $value) {
				$re[]=D('Post')->find($value);
			}
			arsort($re);
			return $re;
		}
		
	}