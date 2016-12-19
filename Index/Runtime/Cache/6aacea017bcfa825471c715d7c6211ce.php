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
		<div class="row" style="margin-top:100px">
	<h2 class="text-center"><a href="/">BT转换</a></h2>
</div>
<div class="row" >
	<span class="row">
		<h3><?php echo ($info['name']); ?></h3>
	</span>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<span class="row">
				创建者:<?php echo ($info['createby']); ?>
			</span>
			<span class="row">
				描述:<?php echo ($info['comment']); ?>
			</span>
			<span class="row">
				大小:<?php echo (thesize($info['size'])); ?>
			</span>
			<span class="row">
				做种时间:<?php echo ($info['time']); ?>
			</span>
			<span class="row">
				文件个数:<?php echo ($info['filecount']); ?>
			</span>
			<span class="row">
				<span class="glyphicon glyphicon-magnet"></span>:
				<?php echo ($info['magnet']); ?>
			</span>
			<span class="row">
				<a href="<?php echo (tr($info['torrent'])); ?>" class="btn btn-primary btn-sm">下载种子</a>
			</span>
		</div>
		<div class="col-md-6" style="background-color: #F1F1F1;overflow-y:scroll;height: 300px;border-radius: 5px;border:2px solid">
			<?php if(is_array($file)): $i = 0; $__LIST__ = $file;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><span class="<?php echo ($vo['type']); ?>"></span> <?php echo ($vo['filename']); ?></span><span class="text-muted"> <?php echo (thesize($vo['size'])); ?></span><br><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>	
	</div>
	
</div>
	</div>
</body>
</html>