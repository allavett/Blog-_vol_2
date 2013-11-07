<div class="list-group" style="width:260px;">
	<?foreach($tags as $tag):?>
		<a href="<?=BASE_URL?>tags/view/<?=$tag['tag_id']?>" class="list-group-item"><?=$tag['tag_name']?> <span class="label" style="background-color:#5bc0de; float:right;"><?=$tag['count']?></span></a>
	<?endforeach?>
</div>