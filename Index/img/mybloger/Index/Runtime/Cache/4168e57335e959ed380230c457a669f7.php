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
		


		<div class="row">
	<div class="col-md-4 col-md-offset-8">
		<form action="" method="post">
			<p>用户名：</p>
			<p>
				<input type="text" name="name" class="form-control">
			</p>
			<p>密码：</p>
			<p>
				<input type="password" name="password" class="form-control">
			</p>		
			<p class="text-right">
				<input type="submit" name="" value="登入" class='btn btn-info'>
			</p>
		</form>
	</div>
</div>

	</div>
</body>
<script type="text/javascript">
<?php echo ($site['javascript']); ?>

</script>