<?php
/**
 * Created by JetBrains PhpStorm.
 * User: L512
 * Date: 27.10.13
 * Time: 17:42
 * To change this template use File | Settings | File Templates.
 */

class register extends Controller {
	function index ()
	{

	}

	function index_post(){
		$id = insert("user", $_POST["data"]);

		if($id){
			$this->auth->redirect(DEFAULT_CONTROLLER);
		}
	}

}
