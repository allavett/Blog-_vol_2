<?php
/**
 * Controls user logout
 *
 * @version 1.0
 * @author Henno Täht <henno.taht@khk.ee>
 */
class logout extends Controller {
	/**
	 * Logout index function
	 *
	 * - Will destroy session and redirect to main page.
	 */
	function index() {
		session_destroy();
		header('Location: ' . BASE_URL);
	}
}