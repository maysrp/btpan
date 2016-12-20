<?php
	/**
	* 
	*/
	class CommontModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
			if (!$_SESSION['uid']) {
				$re['status']=false;
				$re['z']="未登入！";
			}
		}
		function replay($info){
			$add['tid']=$info['tid'];
			$add['uid']=$_SESSION['uid'];
			$add['text']=$info['text'];
			$add['time']=time();
			$add['ip']=$_SERVER['REMOTE_ADDR'];
			$re['z']=$this->add($add);
			$re['status']=true;
			return $re;
		}
	}