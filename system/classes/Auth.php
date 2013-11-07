<?php
/**
 * Class auth authenticates user and permits to check if the user has been logged in
 * Automatically loaded when the controller has $requires_auth property.
 */
class Auth
{

	public $logged_in = FALSE;

	function __construct()
	{
		if (isset($_SESSION['user_id'])) {
			$this->logged_in = TRUE;
		}
	}

	/**
	 * Verifies if the user is logged in and authenticates if not and POST contains username, else displays the login form
	 * @return bool Returns true when the user has been logged in
	 */
        function require_auth()
	{
		global $errors;

		// If user has already logged in...
		if ($this->logged_in) {
			return TRUE;
		}

		// Authenticate by POST data
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user = get_first("SELECT user_id, username FROM user WHERE username = '$username' AND password = '$password'");
			if (! empty($user)) {
				$this->logged_in = TRUE;
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['username'] = $user['username'];
				return true;
			} else {
				$errors[] = "Vale kasutajanimi või parool";
			}
		}

		// Display the login form
		require 'templates/auth_template.php';

		// Prevent loading the requested controller (not authenticated)
		exit();
	}

	function redirect($page){
		header("location: ". BASE_URL . $page);
		exit();
	}
}
