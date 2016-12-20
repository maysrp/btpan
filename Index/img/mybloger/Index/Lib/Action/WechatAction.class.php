<?php

	class WechatAction extends Action{

		function index(){
			$we=D('We')->find(1);
			//var_dump($we);
		  	$jugg=$this->jugg($we);
		  	//$this->responseMsg();
		  	if($jugg){
		  		//echo $_GET["echostr"];//如果微信开发页面成功验证后即可删除该行
		  		//$this->responseMsg();

		  		$ac_msg=$GLOBALS['HTTP_RAW_POST_DATA'];
				$add['info']=$ac_msg;
				D('Wechat')->add($add);
		  		if($we['is_join']){
		  			$this->sendpost();//发送帖子
		  		}else{
		  			$this->is_join();
		  		}
		  		
		  		//$this->responseMsg();
		  		
		  	} 
		
		}

		function jugg($we){
			
			$signature = $_GET["signature"];
        	$timestamp = $_GET["timestamp"];
        	$nonce = $_GET["nonce"];		
			$token = $we['token'];
			$tmpArr = array($token, $timestamp, $nonce);
			sort($tmpArr);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );
			if( $tmpStr == $signature ){
				return true;
			}else{
				return false;
			}
		}
		function access_token(){
				$appid="wxd0924d1fe9e3cf9c";
				$appsecret="8a5fbf85efc9af3fd1b018a9ca697f7e";
				$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
				$res=file_get_contents($url);
				$res_arr=json_decode($res,true);
				$_SESSION['access_token']=$res_arr['access_token'];
				$_SESSION['token_time']=time()+7200;
				return $res_arr['access_token'];
		}
		function responseMsg(){
			$my=(array)simplexml_load_string($ac_msg,'SimpleXMLElement',LIBXML_NOCDATA);
			switch ($my['MsgType']) {
				case 'text':
					$this->my_text($my);
	
					break;
				case 'image':
					//$my['pic_url']=$msg_obj->PicUrl;
					//$my['media_id']=$msg_obj->MediaId;
	
					break;
				case 'voice':
					//$my['media_id']=$msg_obj->MediaId;
					//$my['format']=$msg_obj->Format;

					break;
				case 'video':
					//$my['media_id']=$msg_obj->MediaId;
					//$my['thumb_media']=$msg_obj->ThumbMedia;
					//$title=$msg_obj->Title;
					//$description=$msg_obj->Description;

					break;
				case 'location'://不处理
					//$my['location__x']=$msg_obj->Location_x;
					//$my['location__y']=$msg_obj->Location_y;
					//$my['label']=$msg_obj->Label;//显示位置
					//$my['scale']=$msg_obj->Scale;//比例放大，可以理解为精度
					# code...
					break;
				case 'event':
					$this->my_event($my);
	
					break;
				case 'link':
					//$my['title']=$msg_obj->Title;
					//$my['description']=$msg_obj->Description;
					//$my['url']=$msg_obj->Url;
					# code...
					break;
				default:
					
					break;
			}

		}
		
		function sendpost(){//与blog绑定发送帖子
			$ac_msg=$GLOBALS['HTTP_RAW_POST_DATA'];
			$add['info']=$ac_msg;
			D('Wechat')->add($add);
			$my=(array)simplexml_load_string($ac_msg,'SimpleXMLElement',LIBXML_NOCDATA);
			switch ($my['MsgType']) {
				case 'text':
					$content=D('Post')->wechat($my['Content']);
					$this->return_text($my,$content);
	
					break;
				case 'image':
					$imgurl=$my['PicUrl'];
					//$my['media_id']=$msg_obj->MediaId;
					$content=D('Post')->wechat_image($imgurl);
					$this->return_text($my,$content);
	
					break;
				case "link":
					$add['title']=$my['Title'];
					$add['description']=$my['Description'];
					$add['url']=$my['Url'];
					$content=D('Post')->wechat_link($add);
					$this->return_text($my,$content);

					break;
				case 'location'://不处理
					$add['location_x']=$my['Location_X'];
					$add['location_y']=$my['Location_Y'];
					$add['label']=$my['Label'];//显示位置
					$add['scale']=$my['Scale'];//比例放大，可以理解为精度
					$content=D('Post')->wechat_location($add);
					$this->return_text($my,$content);

					break;
				default:
					
					break;
			}
		}
		function is_join(){
			$ac_msg=$GLOBALS['HTTP_RAW_POST_DATA'];
			$my=(array)simplexml_load_string($ac_msg,'SimpleXMLElement',LIBXML_NOCDATA);
			if($my['MsgType']=="text") {
				$we=D('We')->find(1);
				if(trim($my['Content'])==trim($we['wekey'])){
					$save['we']="1";
					$save['fromusername']=$my['FromUserName'];
					$save['time']=time();
					$save['is_join']=1;
					D('We')->save($save);
				}
			}

		}
		function return_text($my,$content){
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
						</xml>";
						if($content){
							$content="发送成功";
							$type = "text";	
                			$time=time();
                			$resultStr = sprintf($textTpl,$my['FromUserName'], $my['ToUserName'], $time, $type, $content);
                			echo $resultStr;

						}else{
							$content="发送失败";
							$type = "text";	
                			$time=time();
                			$resultStr = sprintf($textTpl,$my['FromUserName'], $my['ToUserName'], $time, $type, $content);
                			echo $resultStr;
						}


		}
		
		function my_text($my){
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
						</xml>";
						$username['fromusername']=$my['FromUserName'];
						$user=D('Wechat_user')->where($username)->select();
						if($user){
							$name=$user[0]['name'];
							$text=$this->content($my['Content']);
							if($text){
								$content=$text;
							}else{
								$content= $name.":发送了“".$my['Content']." ” ;";
							}
						}else{
							$yh=preg_match("/用户/", $my['Content']);
							if($yh){
								$u_a=explode(" ", $my['Content']);
								$add['fromusername']=$my['FromUserName'];
								$add['name']=$u_a[1];
								D('Wechat_user')->add($add);
								$name=$u_a[1];
								$content= $name." 发送了欢迎加入中北老朋友！";	
							}else{
								$content= "发送 用户 姓名 ，开始注册吧！（如 用户 姚步兵）";
							}

						}
				$type = "text";	
                $time=time();
                $resultStr = sprintf($textTpl,$my['FromUserName'], $my['ToUserName'], $time, $type, $content);
                echo $resultStr;
		}
		function my_event($my){
			

		}
		function content($text){
			$y=preg_match("/[飞]/",$text);
			if($y){
				return "阿飞！我好想你啊！！！";
			}

		}


	}