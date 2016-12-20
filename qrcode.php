<?php 
	echo qrcode($_GET['url']);
	function qrcode($url){
		include "phpqrcode.php";
		return QRcode::png($url);
	}