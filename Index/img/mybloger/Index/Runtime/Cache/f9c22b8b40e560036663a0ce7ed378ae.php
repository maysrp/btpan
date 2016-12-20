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
	<div class="col-md-9">
		<div class="row" style="background-color:#FFFFFF;border-radius:5px;padding:10px;margin-top:20px;">
				<a href="/index.php/Index">Home</a>
		</div>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><div class="row" style="background-color:#FFFFFF;border-radius:10px;padding:10px;margin-top:20px;">
				<p><h4><b ><a href="/index.php/Index/post/pid/<?php echo ($post['pid']); ?>" class="text-muted"><?php echo ($post['title']); ?></a></b> <small data-toggle="modal" data-target="#post_<?php echo ($post['pid']); ?>"><span class="glyphicon glyphicon-new-window"></span></small></h4></p>
				<p><small>作者 <?php echo (uidname($post['uid'])); ?> 发布于 <?php echo (date("Y-m-d H:i",$post['time'])); ?> / <span class="glyphicon glyphicon-eye-open"></span> <?php echo ($post['view']); ?> / <span class="glyphicon glyphicon-comment"></span> <?php echo ($post['re']); ?> / 标签 <?php echo (tags($post['tid'])); ?></small></p>
				
				<div id="post_<?php echo ($post['pid']); ?>" class="modal fade" >
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title"><b ><a href="/index.php/Index/post/pid/<?php echo ($post['pid']); ?>" class="text-muted"><?php echo ($post['title']); ?></a></b></h4>
								<small>作者 <?php echo (uidname($post['uid'])); ?> 发布于 <?php echo (date("Y-m-d H:i",$post['time'])); ?> / <span class="glyphicon glyphicon-eye-open"></span> <?php echo ($post['view']); ?> / <span class="glyphicon glyphicon-comment"></span> <?php echo ($post['re']); ?> / 标签 <?php echo (tags($post['tid'])); ?></small>
							</div>
							<div class="modal-body">
								<p>
									<?php echo ($post['text']); ?>
								</p>
							</div>
							<div class="modal-footer">
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								 <a href="/index.php/Index/post/pid/<?php echo ($post['pid']); ?>" class="btn btn-primary">详情</a>
							</div>
						</div>
					</div>
				</div>
			
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div class="col-md-3">
		<div class="row" style="background-color:#FFFFFF;border-radius:7px;padding:10px;margin-top:20px;margin-left:10px;">
	<form method="get" action="/index.php/Index/search">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="输入查询" name="search" >
			<span class="input-group-btn">
				<button class="btn btn-info">搜索</button>
			</span>
		</div>
	</form>
</div>

<div class="row" style="background-color:#FFFFFF;border-radius:7px;padding:10px;margin-top:20px;margin-left:10px;">
<p><h4 class="text-center">热门标签</h4></p>
	<?php  echo hottag() ?>
</div>

<div class="row" style="background-color:#FFFFFF;border-radius:7px;padding:10px;margin-top:20px;margin-left:10px;">
<p ><h4 class="text-center">最近的文章</h4></p>
	<?php  echo lastpost() ?>
</div>

<div class="row" style="background-color:#FFFFFF;border-radius:7px;padding:20px;margin-top:20px;margin-left:10px;">
	<?php echo ($site['footer']); ?>
</div>
	</div>
</div>

	</div>
</body>
<script type="text/javascript">
<?php echo ($site['javascript']); ?>

</script>