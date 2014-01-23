<?php
/**
 * Controls posts view
 *
 * @version 1.5.1
 * @author Allar Vendla <allar.vendla@khk.ee>, Ave Räni <ave.rani@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>, Veikko Venig <veikko.venig@khk.ee>
 */
class posts extends Controller{
	/**
	 * Posts index function.
	 * - Sets posts variable from post table from database ordered by post_created.
	 * - Sets tags variable from tag table from database.
	 *
	 * @author Ave Räni <ave.rani@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>
	 */
	function index(){
		$this->posts = get_all("SELECT * FROM post NATURAL JOIN user ORDER BY post_created DESC");
		$_tags=get_all("SELECT * FROM post_tags NATURAL JOIN tag");
		$this->tags = array();
		foreach ($_tags as $tag){
			$this->tags[$tag['post_id']][]= array('tag_id'=>$tag['tag_id'], 'tag_name'=>$tag['tag_name']);
		}
	}
	/**
	 * Post view function.
	 * @param integer $post_id for searching related posts
	 *
	 * - Sets post variable for one post selected from database table post by post_id param.
	 * - Sets tags variable for all tags selected from database table tag by post_id param.
	 * - Sets comments variable for all comments selected from database table comment by post_id param.
	 * - Sets users variable for all users selected from database table user.
	 *
	 * @author Allar Vendla <allar.vendla@khk.ee>, Ave Räni <ave.rani@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>
	 */
	function view(){
		$post_id = $this->params[0];
		$this->post = get_one("SELECT * FROM post NATURAL JOIN user WHERE post_id='$post_id'");
		$this->tags=get_all("SELECT * FROM post_tags NATURAL JOIN tag WHERE post_id='$post_id'");
		$comments = get_all("SELECT * FROM post_comments NATURAL JOIN comment WHERE post_id = '$post_id'");
		$this->comments = array();

		foreach($comments as $comment){
			$author_id = $comment["author_id"];
			$comment["user"] = get_one("SELECT user_id, username, avatar FROM user WHERE user_id = '$author_id'");
			array_push($this->comments, $comment);
		}
		$this->users = get_all("SELECT user_id, username, avatar FROM user");	// Check if user has avatar
		$target_size=50;	// Define avatar size that is shown in posts view
		if ($this->post['avatar']==NULL){
			$this->avatar="";
		}else{
			$this->avatar='<img src="'.UPLOAD_URL.$this->post['avatar'].'"'.image_resize("upload/".$this->post['avatar'],$target_size).'>';
		}
	}
	/**
	 * Post view commenting function.
	 * @param integer $post_id for inserting comment to specified post
	 *
	 * Sets notification variable for comment form.
	 * @author Allar Vendla <allar.vendla@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>
	 */
	function view_post(){
		$post_id = $this->params[0];
		$this->notification = "Leave a comment.";
		if (isset($_POST['comment_new'])) {
			$comment_text=$_POST['comment_new'];
			if($comment_text==NULL){
				$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("comment_no_text").'</span>';
			}else{
				$comment_author_id = $_SESSION['user_id'];
				if($comment_author_id == FALSE){
					$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("comment_no_auth").'</span>';
					return;
				}
				$comment_author = get_one("SELECT * FROM user WHERE user_id='$comment_author_id'");
				$sql_comment = insert('comment', array('comment_text' => $comment_text, 'comment_author' =>$comment_author['username'], 'author_id' => $comment_author_id));
				if($sql_comment != false){
					$sql_comment2 = insert('post_comments', array('post_id' => $post_id, 'comment_id' =>$sql_comment));
					$inserted = empty($sql_comment2);
					if($inserted){
						$this->notification = '<span class="notification" style="background-color:#8BA870">'.$this->loc->translate("comment_ok").'</span>';

					}
				}
			}
		}
	}
	/**
	 * New post index function
	 *
	 * - Will show new post index view without notifications.
	 */
	function index_post(){
	}
	/**
	 * Function for adding new post by AJAX.
	 * @param title by POST request
	 * @param text by POST request
	 * @param tags by POST request
	 *
	 * @author Kemo Oolep <kemo.oolep@khk.ee>
	 */
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

