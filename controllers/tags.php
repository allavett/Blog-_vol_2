<?php
/**
 * Created by JetBrains PhpStorm.
 * User: L512
 * Date: 27.10.13
 * Time: 17:42
 * To change this template use File | Settings | File Templates.
 */

class tags extends Controller {
	function index ()
	{
		$this->tags = get_all("SELECT tag_id, tag_name, COUNT(post_id) AS count FROM post_tags NATURAL JOIN tag GROUP BY tag_id");
	}

	function view(){
		$tag_id = $this->params[0];
		$this->posts=get_all("SELECT * FROM post_tags NATURAL JOIN post, user WHERE tag_id='$tag_id' ORDER BY post_created DESC");

		$_tags=get_all("SELECT * FROM post_tags NATURAL JOIN tag");
		foreach($_tags as $tag){
			$this->tags[$tag['post_id']][] = array('tag_id'=>$tag['tag_id'], 'tag_name'=>$tag['tag_name']);
		}
	}
}
