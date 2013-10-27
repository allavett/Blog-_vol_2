<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Allar
 * Date: 27.10.13
 * Time: 12:30
 * To change this template use File | Settings | File Templates.
 */
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"> <!-- Lisab nunnud ikoonid-->
<div class="row">
	<div class="span8">
		<div class="row">
			<div class="span8">
				<h4><strong><?=$post['post_subject']?></strong></h4>
			</div>
		</div>
		<div class="row">
<!--
**See pildi osa tahab veidi läbimõtlemist**
			<div class="span2">
				<a href="#" class="thumbnail">
					<img src="http://placehold.it/260x180" alt="">
				</a>
			</div>
			-->
			<div class="span6">
				<p>
					<?=str_replace("\n",'<br/>',$post['post_text']);?> <!-- "str_replace("\n",'<br/>',..)" muudab postituse reavahed HTMLile arusaadavaks-->
				</p>
			</div>
		</div>
		<div class="row">
			<div class="span8">
				<p></p>
				<p>
					<i class="icon-user"> </i> By <?=$post['username']?>
					| <i class="icon-calendar"></i> <?=$post['post_created']?>
					| <i class="icon-comment"></i> <a href="#">3 Comments</a>
					| <i class="icon-share"></i> <a href="#">39 Shares</a>
					| <i class="icon-tags"></i> <a href="#"><span class="label label-info">Tags</span></a>
				</p>
			</div>
		</div>
	</div>
</div>
<hr>