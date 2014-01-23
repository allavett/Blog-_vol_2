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
	 * Registration function.
	 *
	 * First half deals with written form fields and
	 * if there are any incoherence in data
	 * - registration will be canceled
	 * - user will get a notification about what went wrong.
	 *
	 * The second part deals with the avatar user selected
	 * if it does not meet the requirements set
	 * - it will not be submitted to the database
	 * - user will get a notification about what went wrong.
	 *
	 * @author Allar Vendla <allar.vendla@khk.ee>
	 */
	function index_post(){
		if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_confirm'])){
			$this->notification = '<span class="label" style="background-color:#ff5849">All fields must be filled!</span>';
			return;
		}else{
			$usernames=get_all("SELECT username FROM user");
			foreach ($usernames as $username){
				$this->usernames[$username['username']][] = array('username' => $username['username']);
				if (strtolower($_POST['username'])== strtolower($username['username'])){
					$this->notification = '<span class="label" style="background-color:#ff5849">Username already taken!</span>';
					return;
				}elseif(preg_match('/[\s-_!@£$€})({"#¤%&=?]+/', $_POST['username'])){
					$this->notification = '<span class="label" style="background-color:#ff5849">Username can contain only letters and numbers!</span>';
					return;
				}elseif (!preg_match("/@/", $_POST['email']) || preg_match("/ /", $_POST['email'])){
					$this->notification = '<span class="label" style="background-color:#ff5849">Not a valid email address!</span>';
					return;
				}elseif (strlen($_POST['password']) <=4) {
					$this->notification = '<span class="label" style="background-color:#ff5849">Password is too short!</span>';
					return;
				}elseif ($_POST['password'] != $_POST['password_confirm']){
					$this->notification = '<span class="label" style="background-color:#ff5849">Password does not match!</span>';
					return;
				}
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["file"]["name"]);
				$extension = end($temp);
				if (($_FILES["file"]["size"] < 100000)&& in_array($extension, $allowedExts)){
					$tmp_file=$_FILES["file"]["tmp_name"];
					$img_dimensions = getimagesize($tmp_file);
					$width = $img_dimensions[0];
					$height = $img_dimensions[1];
					if ($width > 200||$height > 100) {
						$this->notification = '<span class="label" style="background-color:#ff5849">Image dimensions too big!</span>';
					}else{
						if (!is_dir('upload/')) {
							mkdir('upload/', 0777, true);
						}
						$avatar=$_POST['username'].$_FILES["file"]["name"];
						move_uploaded_file($tmp_file,"upload/".$avatar);
						$sql_user = insert('user', array('username' => $_POST['username'], 'password' =>$_POST['password'], 'email' =>$_POST['email'],'avatar'=>$avatar));
						if($sql_user){
							$this->auth->redirect(DEFAULT_CONTROLLER);
						}
					}
				}else{
					$this->notification = '<span class="label" style="background-color:#ff5849">Check your image file!</span>';
				}
			}
		}
	}
}