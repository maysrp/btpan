<?php 
	class ShelvesModel extends Model{
		function shelves(){
			$xe=$this->find(1);
			if(!$xe){
				$add['vid']="1";
				$add['info']="";
				$this->add($add);
			}
			$info=json_decode($xe['info'],true);
			return $info;
		}
		function post_add($pid){
			$info=$this->shelves();
			$post=D('Post')->shelves($pid);
			if($post){
				$y=date('Y');
				$m=date('m');
				$d=date('d');
				$info[$y][$m][$d][$pid]=$post;
				$this->save_change($info);
			}
		}
		function post_del($xe){
			$info=$this->shelves();	
			if($xe){
				$y=date("Y",$xe['time']);
				$m=date("m",$xe['time']);
				$d=date("d",$xe['time']);
				unset($info[$y][$m][$d][$xe['pid']]);
				$this->save_change($info);
			}
		}
		function save_change($info){
			$json['info']=json_encode($info);
			$json['vid']="1";
			$this->save($json);
		}

	} 

