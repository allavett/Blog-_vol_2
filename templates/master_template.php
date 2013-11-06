
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?=ASSETS_URL?>ico/favicon.png">

	<title><?=PROJECT_NAME?></title>

	<!-- Bootstrap core CSS -->
	<link href="<?=ASSETS_URL?>css/bootstrap-3.0.0.min.css" rel="stylesheet">

    <!-- Lisab nunnud ikoonid-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<style>
		body {
			min-height: 2000px !important;
			padding-top: 70px;
			background: url(<?= ASSETS_URL ?>'img/bg.jpg');
		}
	</style>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?=ASSETS_URL?>js/html5shiv.js"></script>
	<script src="<?=ASSETS_URL?>js/respond.min.js"></script>
	<![endif]-->

</head>

<body>

<div id="base_url" style="display:none;" data-value="<?=BASE_URL?>"></div>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=BASE_URL?>"><?=$loc->translate("welcome_blurb")?></a></li>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">

                    <? if ($auth->logged_in): ?>
						<li  <?= $controller == "posts" ? 'class="active"' : ''?>><a href="<?=BASE_URL?>posts" ><?=$loc->translate("posts_link")?></a>

                        </li>

                        <li class="dropdown" >
                            <a style="padding-left: 0; padding-right: 0;" href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a onclick="Blog.addNewPosting()"><?=$loc->translate("posts_add")?></a></li>
                            </ul>
                        </li>


                    <? else: ?>
                        <li <?= $controller == "posts" ? 'class="active"' : ''?>><a href="<?=BASE_URL?>"><?=$loc->translate("posts_link")?></a></li>
                    <? endif ?>



				<li <?= $controller == "tags" ? 'class="active"' : ''?>><a href="<?=BASE_URL?>tags"><?=$loc->translate("tags_link")?></a></li>
			<!--
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			-->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<? if ($auth->logged_in): ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
											data-toggle="dropdown"><?= $_SESSION['username'] ?><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?= BASE_URL ?>logout"><?=$loc->translate("logout_link")?></a></li>
						</ul>
					</li>

                    <div id="user_id" style="display:none;" data-value="<?=$_SESSION['user_id']?>"></div>
				<? else: ?>
					<form class="navbar-form navbar-right"  method="post" action="<?= BASE_URL ?>">
						<div class="form-group">
							<input style="width:100px" type="text" name="username" placeholder="<?=$loc->translate("user_plh")?>" class="form-control">
						</div>
						<div class="form-group">
							<input style="width:100px" type="password" name="password" placeholder="<?=$loc->translate("password_plh")?>" class="form-control">
						</div>
						<button type="submit" name="signin" class="btn btn-success"><?=$loc->translate("signin_btn")?></a></button>
						<button type="submit" name="register" class="btn btn-danger"><?=$loc->translate("register_btn")?></a></button>
					</form>

				<? endif ?>

                <li class="dropdown"><a href="#" class="dropdown-toggle"
                                        data-toggle="dropdown"><?=$loc->translate("lang_link")?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <form method="post" action="<?=BASE_URL?>">
                            <li><button type="submit" class="btn btn-success" name="language" style="width:100%;" value="2">Eesti</button></li>
                            <li><button type="submit" class="btn btn-success" name="language" style="width:100%;"value="1">English</button></li>
                        </form>
                    </ul>
                </li>

			</ul>




		</div><!--/.nav-collapse -->
	</div>
</div>

<div class="container">

	<?php require "views/$this->controller/{$this->controller}_$this->action.php";?>

</div> <!-- /container -->


<!-- Modal for adding new post-->
<div class="modal fade" id="addNewPosting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add new post</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Post title</label>
                            <div class="controls">
                                <input type="text" id="post_title" placeholder="Post title" class="form-control">
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Post text</label>
                            <div class="controls">
                                <textarea style="resize: none;" type="text" id="post_text" placeholder="Post text" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Tags</label>
                            <div class="controls">
                                <input type="text" id="post_tags" placeholder="Example: weather; news; beer" class="form-control">
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="savePost" class="btn btn-primary">Save post</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=ASSETS_URL?>js/jquery-1.10.2.min.js"></script>
<script src="<?=ASSETS_URL?>js/bootstrap-3.0.0.min.js"></script>
<script src="<?=ASSETS_URL?>js/functions.js"></script>
</body>
</html>
