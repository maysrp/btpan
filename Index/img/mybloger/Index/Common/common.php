<?php
	function uidname($uid){
		$re=D('User')->find($uid);
		if($re){
			if($uid==1){
				return "管理员";
			}
			return $re['name'];
		}else{
			return "匿名者";
		}
	}
	function tagss($tag){
		$tags=json_decode($tag,true);
		$count=count($tags);
		$ix=($count>3)?2:$count-1;
		$re="";
		foreach ($tags as $key => $value) {
			$re=$re."<a class=\"text-warning\" href=/index.php/User/tag/tid/".$key.">".$value['tag']."</a> .";
		}
		return $re;
	}
	function radio($va,$x){//选择
		if($va==$x){
			return "checked";
		}
	}
	function active($va,$x){//激活 模版 内容
		if($va==$x){
			return "active";		
		}
	}
	function tpl_use($a,$b,$c="active"){//上面两个函数的集合
		if($a==$b){
			return $c;
		}
	}
	function tags($tag){//跳转
		$tags=json_decode($tag,true);
		$count=count($tags);
		$ix=($count>3)?2:$count-1;
		$re="";
		foreach ($tags as $key => $value) {
			$re=$re."<a class=\"text-warning\" href=/index.php/Index/tag/tid/".$key.">".$value['tag']."</a> .";
		}
		return $re;
	}
	function hottag(){
		$tag_array=D('Tag')->order("num desc")->limit(10)->select();
		$re="<p>";
		foreach ($tag_array as $va) {
			$re=$re."<a class=\"text-warning\" href=/index.php/Index/tag/tid/".$va['tid'].">".$va['tag']."</a> ";
		}
		$re=$re."</p>";
		return $re;
	}
	function lastpost(){
		$post=D('Post')->limit(5)->order("time desc")->select();
		$re="<ul>";
		foreach ($post as $va) {
			$re=$re."<li><a href=/index.php/Index/post/pid/".$va['pid'].">".$va['title']."</a></li>";
		}
		$re=$re."</ul>";
		return $re;
	}
	function site(){
		$site=D('Site')->find(1);
		return $site;
	}
	function pidtitle($pid){
		$re=D('Post')->find($pid);
		if ($re) {
			echo "<a href=\"/index.php/Index/post/pid/".$re['pid']."\">". $re['title']."</a>";
		}
	}
	function postimage($v){
		$image=json_decode($v,true);
		if(count($image)){
			if($count>2){
				echo "<p>".$image[0].$image[1]."</p>";
			}else{
				echo "<p>".$image[0]."</p>";
			}
		}
	}
	function shelves(){
		$info=D('Shelves')->shelves();
		echo "<ul>";
		foreach ( $info as $key => $value) {
			echo "<li>".$key."年</li>";
			echo "<ul>";
				foreach ($value as $key_1 => $value_1) {
					echo "<li class=\"slide_click_moon\" value=\"".$key.$key_1."\" style=\"margin-left:-30px;\">".$key_1."月</li>";
					echo "<div id=\"moon".$key.$key_1."\" style=\"display:none\"><ul>";				
					foreach ($value_1 as $key_2 => $value_2) {
						echo "<li class=\"slide_click\" style=\"margin-left:-60px;\" value=\"".$key_1.$key_2."\">".$key_1."月".$key_2."日</li>";
						echo "<div id=\"li".$key_1.$key_2."\" style=\"display:none\"><ul style=\"margin-left:-30px;\">";
							foreach ($value_2 as $key_3 => $value_3) {
								echo "<li style=\"margin-left:-60px;\"><a href=\"/index.php/Index/post/pid/".$key_3."\" >".$value_3['title']."</a></li>";
							}
						echo "</ul></div>";
					}
					echo "</ul></div>";		
				}
			echo "</ul>";
		}
		echo "</ul>";	
	}
	function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    	$url = 'https://www.gravatar.com/avatar/';
    	$url .= md5( strtolower( trim( $email ) ) );
   		$url .= "?s=$s&d=$d&r=$r";
    	if ( $img ) {
        	$url = '<img src="' . $url . '"';
        	foreach ( $atts as $key => $val )
            	$url .= ' ' . $key . '="' . $val . '"';
        	$url .= ' />';
    	}
    	return $url;
	}
	function avatar($info){
		if($info['uid']){
			$user=D('User')->find($info['uid']);
			return $user['image'];
		}else{
			return get_gravatar($info['email'],50);
		}
	}
	function tag_text($tid){
		$info=json_decode($tid,true);
		foreach ($info as $key => $value) {
			echo $value['tag']." ";
		}
	}
	function is_mobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    	if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        	return true;
    
    //此条摘自TPM智能切换模板引擎，适合TPM开发
    	if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
        	return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    	if (isset ($_SERVER['HTTP_VIA']))
        	//找不到为flase,否则为true
       	 return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    	if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        	$clientkeywords = array(
            	'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
        	);
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        	if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            	return true;
        	}
    	}
    //协议法，因为有可能不准确，放到最后判断
    	if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        	if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            	return true;
        	}
    	}
    	return false;
 	}
function download($url, $dir) {//用于下载页面,$dir为下载到本地的地址
    $ch = curl_init($url);
    $fp = fopen($dir, "wb");
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $res=curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}
function wechat_download($url,$dir){
	$img=file_get_contents($url);
	file_put_contents($dir,$img);
}
