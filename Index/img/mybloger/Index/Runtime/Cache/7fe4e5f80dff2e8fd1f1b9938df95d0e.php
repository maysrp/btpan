<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<?php $site=site(); ?>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/src/css/bootstrap.min.css">
	<script src="/src/js/jquery.js"></script>
	<script src="/src/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			background-color:#F3F3F3; 
			background-image:url(<?php echo ($site['image']); ?>);
			background-repeat:<?php echo ($site['background-repeat']); ?>;
			background-attachment:<?php echo ($site['background-attachment']); ?>; 
		}
		img{
			max-width: 600px;
		}
	</style>
	<meta name="keywords" content="<?php echo ($site['keywords']); ?>"/>
	<meta name="description" content="<?php echo ($site['description']); ?>" />
	<title><?php echo ($site['name']); ?></title>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="row">
	<div class="col-md-1">
		<span><a href="/index.php"><img src="<?php echo ($site['logo']); ?>" width="100px" style="margin-top:20px;" /></a></span>
	</div>
	<div class="col-md-1">
		<h3><a href="" class="text-info"><small><?php echo ($site['name']); ?></small></a></h3>
	</div>
	<?php if($_SESSION['uid'] > 0): ?><div class="col-md-1 col-md-offset-8">
			<h3><a href="/index.php/User/index" class="text-info"><small>用户中心</small></a></h3>
		</div><?php endif; ?>
		

</div>
		</div>
		


		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<?php if(isset($message)): ?><h1>:)</h1>
<p class="success"><?php echo($message); ?></p>
<?php else: ?>
<h1>:(</h1>
<p class="error"><?php echo($error); ?></p><?php endif; ?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>

	</div>
</body>
<script type="text/javascript">
<?php echo ($site['javascript']); ?>

</script>