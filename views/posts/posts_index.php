<div class="span8">
	<?foreach($posts as $post):?>
	<h1><a href="<?=BASE_URL?>posts/view/<?=$post['post_id']?>"><?=$post['post_subject']?></a></h1>
	<p><?=str_replace("\n",'<br/>',substr($post['post_text'],0,150)); // "str_replace("\n",'<br/>',..)" muudab postituse reavahed HTMLile arusaadavaks ja "substr(..)" määrab kuvatava teksti pikkuse

// TODO: @Kemo, Ilmselt saab seda (pikkuse kontrolli) osa kontrolleris teha ;)
		$post_length=strlen($post['post_text']); // mõõdab postituse pikkuse ja kuvab 2 punkti, kui postitus on pigem, kui lubatud.
		if ($post_length>150){
			echo "..";
		}?></p>
		<div>
			<span class="badge badge-success">Posted on <?=$post['post_created']?> by <?=$post['username']?>.</span>
			<?foreach ($tags[$post['post_id']] as $tag):?>
				<a href="<?=BASE_URL?>tags/view/<?=$tag['tag_id']?>"><span class="label" style="background-color:#5bc0de"><?=$tag['tag_name']?></span></a>
			<?endforeach?>
		</div>
	<?endforeach?>
</div>

