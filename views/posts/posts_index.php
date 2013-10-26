<div class="span8">
	<?foreach($posts as $post):?>
	<h1><?=$post['post_subject']?></h1>
	<p><?=$post['post_text']?></p>
	<div>
		<span class="badge badge-success">Posted on <?=$post['post_created']?> by <?=$post['username']?></span><div class="pull-right">
			<span class="label"><?=$tag['tag_name']?></span> </div>
	</div>
	<?endforeach?>
</div>