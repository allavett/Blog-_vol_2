<?php
/**
 * Controls login view
 *
 * @version 1.5
 * @author Kemo Oolep <kemo.oolep@khk.ee>
 */
class login extends Controller {
	/**
	 * Login index AJAX function
	 *
	 * - Will authenticate user login by POST data.
	 * - Gives notification if user login fails.
	 */
	function index_ajax(){
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user = get_first("SELECT user_id, username FROM user WHERE username = '$username' AND password = '$password'");
			if (! empty($user)) {
				$this->auth->logged_in = TRUE;
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['username'] = $user['username'];
				exit(true);
			} else {
				exit($this->loc->translate("login_fail"));
			}
		}

	}
}