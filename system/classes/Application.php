<?php
/**
 * Main controller
 *
 * @version 1.5
 * @author Henno Täht <henno.taht@khk.ee>, Kemo Oolep <kemo.oolep@khk.ee>
 */
class Application {

	public $auth = null;
	public $params = null;
	public $action = 'index';
	public $controller = DEFAULT_CONTROLLER;
	public $loc = null;
	/**
	 * Construct function
	 * - Load correct view controller by request or starts DEFAULT_CONTROLLER
	 * - Translates GUI
	 */
	function __construct() {
		ob_start();
		session_start();


		$this->load_common_functions();
		$this->load_config();
		$this->process_uri();
		$this->handle_routing();

		$this->auth = new Auth;
		$this->init_db();

		// Instantiate controller
		require "controllers/$this->controller.php";
		$controller = new $this->controller;

		// Make request and auth properties available to controller
		$controller->controller = $this->controller;
		$controller->action = $this->action;
		$controller->params = $this->params;
		$controller->auth = $this->auth;


		$this->loc = new Localization();
		$controller->loc = $this->loc;

		if ($_POST && array_key_exists("language", $_POST)) {
			setcookie("locale", $_POST["language"]);

			$this->loc->locale = $_POST["language"];
		} elseif (isset($_COOKIE["locale"])) {
			$this->loc->locale = $_COOKIE["locale"];
		}

		$this->loc->getTranslations();





		// Authenticate user, if controller requires it
		if (isset($_POST['signin']) || $controller->requires_auth && !$controller->auth->logged_in) {
			$controller->auth->require_auth();
		} elseif (isset($_POST['register'])) {
			$this->auth->redirect("register");
		}


		// Run the action
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$action_name = $controller->action . '_ajax';
			$controller->$action_name();
			exit();
		} else {
			// Check for and process POST ( executes $action_post() )
			if (isset($_POST) && !empty($_POST) && !array_key_exists("language", $_POST)) {
				$action_name = $controller->action . '_post';
				$controller->$action_name();
			}

			// Proceed with regular action processing ( executes $action() )
			$controller->{$controller->action}();
			$controller->render($controller->template);
		}
	}

	/**
	 * Defines global variables
	 * - BASE_URL
	 * - ASSETS_URL
	 * - UPLOAD_URL
	 *
	 * Loads config.php from environment root
	 */
	private function load_config() {
		// System paths
		define('BASE_URL', dirname($_SERVER['SCRIPT_NAME']) . '/');
		// If server IS LOCAL
		define('ASSETS_URL', BASE_URL . 'assets/');
		// If the server is NOT LOCAL
		//define('BASE_URL', dirname($_SERVER['SCRIPT_NAME']) == '//' ? '/' : dirname($_SERVER['SCRIPT_NAME']));

		define('UPLOAD_URL', BASE_URL . 'upload/');

		// Load config file or bail out
		if (file_exists('config.php')) {
			require 'config.php';
		} else {
			error_out('No config.php. Please make a copy of config.sample.php and name it config.php and configure it.');
		}
	}

	/**
	 * Includes system/functions.php for common functions usage
	 */
	private function load_common_functions() {
		require 'system/functions.php';
	}

	/**
	 *
	 */
	private function process_uri() {
		if (isset($_SERVER['PATH_INFO'])) {
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) {
				array_shift($path_info);
				$this->controller = isset($path_info[0]) ? array_shift($path_info) : DEFAULT_CONTROLLER;
				$this->action = isset($path_info[0]) && !empty($path_info[0]) ? array_shift($path_info) : 'index';
				$this->params = isset($path_info[0]) ? $path_info : NULL;
			}
		}
	}

	/**
	 * Includes system/database.php which must autorun databsae connection
	 */
	private function init_db() {
		require 'system/database.php';
	}

	private function handle_routing() {
		//TODO: write here your own code if you want to manipulate controller, action
	}

}