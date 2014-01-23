<?php
/**
 * Controls tags view
 *
 * @version 1.5.1
 * @author Ave Räni <ave.rani@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>, Veikko Venig <veikko.venig@khk.ee>
 */
class tags extends Controller {
	/**
	 * Tags index function
	 * - Sets tags variable by all tags selected from database tag table.
	 * - Sets tag count.
	 *
	 * @author Veikko Venig <veikko.venig@khk.ee>
	 */
	function index() {
		$this->tags = get_all("SELECT tag_id, tag_name, COUNT(post_id) AS count FROM post_tags NATURAL JOIN tag GROUP BY tag_id");
	}
	/**
	 * Tags view controller
	 * @param integer $tag_id for searching related tags
	 *
	 * - Sets posts variable by all posts selected from database  post table ordered by post_created DESC.
	 * - Sets tags variable by all tags selected from database table tags.
	 *
	 * @author Ave Räni <ave.rani@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>
	 */
	function view() {
		$tag_id = $this->params[0];
		$posts = get_all("SELECT * FROM post_tags NATURAL JOIN post WHERE tag_id='$tag_id' ORDER BY post_created DESC");
		$this->posts = array();
		foreach ($posts as $post) {
			$user_id = $post["user_id"];
			$username = get_one("SELECT username FROM user WHERE user_id = '$user_id'");
			$post["username"] = $username["username"];
			array_push($this->posts, $post);
		}
		$_tags = get_all("SELECT * FROM post_tags NATURAL JOIN tag");
		foreach ($_tags as $tag) {
			$this->tags[$tag['post_id']][] = array('tag_id' => $tag['tag_id'], 'tag_name' => $tag['tag_name']);
		}
	}

}
