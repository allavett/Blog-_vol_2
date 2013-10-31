<div class="span8">
    <h1><?=$post['post_subject']?></h1>
    <p><?=str_replace("\n",'<br/>',$post['post_text']);?></p>
    <div>
        <span class="badge badge-success">Posted on <?=$post['post_created']?> by <?=$post['username']?>.</span>
        <?foreach ($tags as $tag):?>
            <a href="<?=BASE_URL?>tags/view/<?=$tag['tag_id']?>"><span class="label label-info" style="background-color:#5bc0de"><?=$tag['tag_name']?></span></a>
        <?endforeach?>
    </div>

    <!-- Comment submit form -->
    <? if($this->auth->logged_in):?>
    <hr>
    <form method="post">
        <div class="controls">
            <textarea id="message" name="comment_new" class="span6" style="width: 500px" placeholder="Your comment.." rows="5"></textarea>
        </div>
        <div class="controls">
            <button type="submit" class="btn btn-primary input-medium">Submit</button>
        </div>
        <!-- If submitting fails for some reason, notification will be shown -->
        <? if (isset($errors) && isset($this->notification)) {
            echo $this->notification; //Comment error
        }elseif(isset($this->notification)){
            echo $this->notification; //Comment submitted successfully
        }?>
    </form>
    <? endif ?>
</div>
<hr>
<div>
    <?foreach ($comments as $comment):?>
        <br />
        <span class="comment" style="background-color:#afe4ff">
                                <?=$comment['comment_text']?>
            <p>Comment posted on <?=$comment['comment_created']?> by <?=$comment['comment_author']?></p>
                        </span>
    <?endforeach?>
</div>
</div>