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
	<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="/index.php/User/index" class="navbar-brand">用户</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="/index.php/User/lpost">管理文章</a></li>
				<li><a href="/index.php/User/repost">评论管理</a></li>
			

			</ul>
		</div>
	</div>
</nav>
</div>
<div class="col-md-3">
	<div class="row">
		<div class="row" style="padding:20px;background-color:#FFFFFF;border-radius:5px;margin:20px;">
			<p></p>
			<p><?php echo (uidname($user)); ?></p>
			<p><button  class="btn btn-warning" data-toggle="modal" data-target="#change">修改密码</button></p>
		</div>
		<div class="row" style="padding:20px;background-color:#FFFFFF;border-radius:5px;margin:20px;">
			<form method="post" action="/index.php/User/site">
				<p>名称:</p>
					<input type="text" name="name" class="form-control" value="<?php echo ($site['name']); ?>">
				<br>
				<p>logo:</p>
					<input type="text" name="logo" class="form-control" value="<?php echo ($site['logo']); ?>">
				<br>
				<p>背景图片:</p>
					<input type="text" name="image" class="form-control" value="<?php echo ($site['image']); ?>">
				<br>
				<p>背景滚动:</p>
				<div class="btn-group" data-toggle="buttons" style="margin-bottom:10px;">
  					<label class="btn btn-info btn-sm <?php echo (active("scroll",$site['background-attachment'])); ?>">
    					<input type="radio" name="background-attachment" value="scroll" <?php echo (radio("scroll",$site['background-attachment'])); ?>>是
  					</label>
  					<label class="btn btn-info btn-sm <?php echo (active("fixed",$site['background-attachment'])); ?>">
    					<input type="radio" name="background-attachment" value="fixed" <?php echo (radio("fixed",$site['background-attachment'])); ?>>否
  					</label>
  				</div>
  				<br>

  				<p>背景重复:</p>
				<div class="btn-group" data-toggle="buttons" style="margin-bottom:10px;">
  					<label class="btn btn-info btn-sm <?php echo (active("repeat",$site['background-repeat'])); ?>">
    					<input type="radio" name="background-repeat" value="repeat" <?php echo (radio("repeat",$site['background-repeat'])); ?>>XY轴
  					</label>
  					<label class="btn btn-info btn-sm <?php echo (active("repeat-x",$site['background-repeat'])); ?>">
    					<input type="radio" name="background-repeat" value="repeat-x" <?php echo (radio("repeat-x",$site['background-repeat'])); ?>>X轴
  					</label>
  					<label class="btn btn-info btn-sm <?php echo (active("repeat-y",$site['background-repeat'])); ?>">
    					<input type="radio" name="background-repeat" value="repeat-y" <?php echo (radio("repeat-y",$site['background-repeat'])); ?>>Y轴
  					</label>
  					<label class="btn btn-info btn-sm <?php echo (active("no-repeat",$site['background-repeat'])); ?>">
    					<input type="radio" name="background-repeat" value="no-repeat" <?php echo (radio("no-repeat",$site['background-repeat'])); ?>>不重复
  					</label>
  				</div>
  				<br>
				<p>每页显示文章:</p>
					<input type="text" name="page" class="form-control" value="<?php echo ($site['page']); ?>">
				<br>
				<p>匿名评论:</p>
				<div class="btn-group" data-toggle="buttons">
  					<label class="btn btn-info btn-sm <?php echo (active(1,$site['niming'])); ?>">
    					<input type="radio" name="niming" value="1" <?php echo (radio(1,$site['niming'])); ?>> 是
  					</label>
  					<label class="btn btn-info btn-sm <?php echo (active(0,$site['niming'])); ?>">
    					<input type="radio" name="niming" value="0" <?php echo (radio(0,$site['niming'])); ?>>否
  					</label>
  				</div>
  				<p style="margin:10px" class="text-right">
  					<button class="btn btn-primary">提交</button>
  				</p>
			</form>
		</div>
		<div class="row" style="padding:20px;background-color:#FFFFFF;border-radius:5px;margin:20px;">
			<p class="text-right"><a href="/index.php/User/logout" class="btn btn-danger">离开</a></p>
		</div>
	</div>

</div>
<div class="col-md-9">
	<form action="/index.php/User/footer_javascript" method="post">
  <div class="row">
    <h4><b>关键词</b></h4>
      <textarea class="form-control" style="height:50px" name="keywords">
        <?php echo ($site['keywords']); ?>
      </textarea>
  </div>
  <div class="row">
    <h4><b>描述</b></h4>
      <textarea class="form-control"  name="description">
        <?php echo ($site['description']); ?>
      </textarea>
  </div>
	<div class="row">
		<h4>Footer</h4>
			<textarea class="form-control" style="height:200px" name="footer">
				<?php echo ($site['footer']); ?>
			</textarea>
	</div>
	<div class="row">
		<h4>Javascript</h4>
			<textarea class="form-control" style="height:200px" name="javascript">
				<?php echo ($site['javascript']); ?>
			</textarea>
			<div class="text-right" style="padding:10px">
				<button class="btn btn-info">修改</button>		
			</div>
	</div>
	</form>

</div>




<div class="modal fade bs-example-modal-sm" id="change">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
    		<h4 class="modal-title">修改密码</h4>
    	</div>
    	<div class="modal-body">
    		<form action="/index.php/User/change" method="post">
    			新密码:
    			<input type="password" name="old" class="form-control">
    			请重复：
    			<input type="password" name="new" class="form-control">
    	</div>
    	<div class="modal-footer">
    			<button class="btn btn-danger">修改</button>
    		</form>
    	</div>
    </div>
  </div>
</div>

	</div>
</body>
<script type="text/javascript">
<?php echo ($site['javascript']); ?>

</script>