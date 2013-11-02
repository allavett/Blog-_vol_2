<?php
/**
 * Created by JetBrains PhpStorm.
 * User: L512
 * Date: 27.10.13
 * Time: 17:42
 * To change this template use File | Settings | File Templates.
 */

class register extends Controller {
	function index (){
	}

	function index_post(){
		$usernames=get_all("SELECT username FROM user");
		foreach ($usernames as $username){
			$this->usernames[$username['username']][]= array('username'=>$username['username']);
		}
		if (!empty($_POST['username'])&&!empty($_POST['email'])&&!empty($_POST['password'])&&!empty($_POST['password_confirm'])){
			if ($_POST['username']!= $username['username']){
				if (preg_match("/@/", $_POST['email'])) {
					if ($_POST['password']==$_POST['password_confirm']){
						$sql_user = insert('user', array('username' => $_POST['username'], 'password' =>$_POST['password'], 'email' =>$_POST['email']));
						if($sql_user){
							$this->auth->redirect(DEFAULT_CONTROLLER);
						}
					}else{
						$this->notification = '<span class="label" style="background-color:#ff5849">Password does not match!</span>';
					}
				}else{
					$this->notification = '<span class="label" style="background-color:#ff5849">Not a valid email address!</span>';
				}
			}else{
				$this->notification = '<span class="label" style="background-color:#ff5849">Username already taken!</span>';
			}
		}else{
			$this->notification = '<span class="label" style="background-color:#ff5849">All fields must be filled!</span>';
		}
	}
}