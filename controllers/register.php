<?php
/**
 * Controls register form
 *
 * @version 1.5.1
 * @author Allar Vendla <allar.vendla@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>
 */
class register extends Controller {
	/**
	 * Register index function
	 *
	 * - Will show register index view without notifications.
	 *
	 * @author Kemo Oolep <kemo.oolep@khk.ee>
	 */
	function index (){
	}
	/**
	 * Check username function.
	 *
	 * - Will compare inserted username with usernames in database.
	 *
	 * @author Allar Vendla <allar.vendla@khk.ee>
	 */
	function check_user_ajax (){
		$user = $_POST["user"];
		$usernames=get_all("SELECT username FROM user");
		foreach ($usernames as $username){
			$this->usernames[$username['username']][] = array('username' => $username['username']);
			if (strtolower($user)== strtolower($username['username'])){
				exit(true);
			}
		}
		exit(false);
	}
	/**
	 * Insert user to DB function.
	 *
	 * Forms filled by new user will be inserted to the database.
	 *
	 * @author Allar Vendla <allar.vendla@khk.ee>
	 */
	function insert_user_ajax (){
		$user = $_POST["user"];
		$email = $_POST["email"];
		$pass = $_POST["pass"];
		$pic = $_POST["avatar"];
		$sql_user = insert("user", array("username" => $user, "email" => $email, "password" => $pass, "avatar" => $pic));
		if($sql_user != false){
			exit(true);
		}else{
			exit(false);
		}
	}
	/**
	 * Upload picture function.
	 *
	 * picture, chosen by user will be uploaded to server.
	 *
	 * @author Allar Vendla <allar.vendla@khk.ee>
	 */
	function index_post(){
		if (!is_dir('upload/')) {
			mkdir('upload/', 0777, true);
		}
		$tmp_file=$_FILES["file"]["tmp_name"];
		$avatar=$_POST['username'].$_FILES["file"]["name"];
		move_uploaded_file($tmp_file,"upload/".$avatar);
		$this->auth->redirect(DEFAULT_CONTROLLER);
	}
}
