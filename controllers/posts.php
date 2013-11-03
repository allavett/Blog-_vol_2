<?php

class posts extends Controller{

	function index(){
        $this->posts = get_all("SELECT * FROM post NATURAL JOIN user ORDER BY post_created DESC");
		$_tags=get_all("SELECT * FROM post_tags NATURAL JOIN tag");
		$this->tags = array();
        foreach ($_tags as $tag){
			$this->tags[$tag['post_id']][]= array('tag_id'=>$tag['tag_id'], 'tag_name'=>$tag['tag_name']);
		}
	}
    function view(){
        $post_id = $this->params[0];
        $this->post = get_one("SELECT * FROM post NATURAL JOIN user WHERE post_id='$post_id'");
        $this->tags=get_all("SELECT * FROM post_tags NATURAL JOIN tag WHERE post_id='$post_id'");
        $this->comments = get_all("SELECT * FROM post_comments NATURAL JOIN comment WHERE post_id = '$post_id'");
		//Check if user has avatar
		$target_size=50; //Define avatar size
		if ($this->post['avatar']==NULL){
			$this->avatar="";
		}else{
			$this->avatar='<img src="'.UPLOAD_URL.$this->post['avatar'].'"'.image_resize("upload/".$this->post['avatar'],$target_size).'>';
		}
}
    function view_post(){
        $post_id = $this->params[0];
        $this->notification = "Leave a comment.";
        if (isset($_POST['comment_new'])) {
            $comment_text=$_POST['comment_new'];
            if($comment_text==NULL){
                $this->notification = '<span class="label" style="background-color:#ff5849">Your comment is empty!</span>';
            }else{
                $comment_author_id = $_SESSION['user_id'];

                if($comment_author_id == FALSE){
                    $this->notification = '<span class="label" style="background-color:#ff5849">How the hell did you inserted comment without logging in?!</span>';
                    return;
                }

                $comment_author = get_one("SELECT * FROM user WHERE user_id='$comment_author_id'");

                $sql_comment = insert('comment', array('comment_text' => $comment_text, 'comment_author' =>$comment_author['username']));

                if($sql_comment != false){
                    $sql_comment2 = insert('post_comments', array('post_id' => $post_id, 'comment_id' =>$sql_comment));
                    $inserted = empty($sql_comment2);
                    if($inserted){
                        $this->notification = '<span class="notification" style="background-color:#8BA870">Comment submitted successfully.</span>';

                    }
                }
            }
        }
    }

	function index_post(){

	}

    function add_post_ajax(){
        $title = $_POST["title"];
        $text = $_POST["text"];

        $tagString = $_POST["tags"];

        $id = insert("post", array("post_subject" => $title, "post_text" => $text, "user_id" => $_SESSION['user_id']));
        if($id == false){
            exit(false);
        }

        if(strlen($tagString) > 0){
            $tags = explode(";", $tagString);

            $existTags = get_all("SELECT tag_name, tag_id FROM tag");

            $inserted  = false;
            foreach($tags as $tag){
                $tag = trim($tag);
                $inserted = false;
                foreach($existTags as $existTag){
                    if($existTag["tag_name"] == $tag){
                        insert("post_tags", array("post_id" => $id, "tag_id" => $existTag["tag_id"]));
                        $inserted = true;
                    }
                }

                if(!$inserted){
                    $newTag = insert("tag", array("tag_name" => $tag));
                    insert("post_tags", array("post_id" => $id, "tag_id" => $newTag));
                }
            }
        }

        exit(true);

    }

}

