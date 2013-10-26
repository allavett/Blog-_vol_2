<ul>
	<li>1. Rename welcome controller enda põhikontrolleri nimeliseks (ära unusta classi nime muuta).</li>
	<li>3. Kohanda views/templates/master_template.php failis pealkiri ja projekti nimi.</li>
	<li>4. Loo enda põhikontrolleri jaoks vaatefail (näiteks views/products_index_view.php).</li>
</ul>

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