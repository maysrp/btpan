<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<title>BT转换</title>
	<style type="text/css">
		body{
			
			background-color: #FCFAFA;
			background-repeat: no-repeat;
			background-position: top;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row" style="margin-top:100px;">
	<center><h2>BT转换</h2></center>
</div>
<div class="row" >
	<div class="col-md-8 col-md-offset-2">
		<form action="/index.php/Index/up" method="post" enctype="multipart/form-data">
			<div class="input-group">
				<input type="file" name="torrent" accept="application/x-bittorrent" class="form-control">
				<span class="input-group-btn">
					<input type="submit" name="submit" value="转换" class="btn btn-primary">
				</span>
			</div>
		</form>
	</div>
</div>
	</div>
</body>
</html>