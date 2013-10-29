<div class="list-group">
	<?foreach($tags as $tag):?>
		<a href="<?=BASE_URL?>tags/view/<?=$tag['tag_id']?>" class="list-group-item"><?=$tag['tag_name']?> <span class="label" style="background-color:#0000ff"><?=$tag['count']?></span></a>
	<?endforeach?>
</div>