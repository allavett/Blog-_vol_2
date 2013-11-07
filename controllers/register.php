<?php
/**
 * Created by JetBrains PhpStorm.
 * User: L512
 * Date: 27.10.13
 * Time: 17:42
 * To change this template use File | Settings | File Templates.
 */
/** This controller checks all the data submitted by user on the register form.
 * If there are any incoherence in data, user will get a notification about what went wrong.*/

class register extends Controller {
	function index (){
	}

	function index_post(){
		if (!empty($_POST['username'])&&!empty($_POST['email'])&&!empty($_POST['password'])&&!empty($_POST['password_confirm'])){
			$usernames=get_all("SELECT username FROM user");
			foreach ($usernames as $username){
				$this->usernames[$username['username']][]= array('username'=>$username['username']);
				if (strtolower($_POST['username'])== strtolower($username['username'])){
					$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_user_taken").'</span>';
					return;
				}elseif(preg_match('/[\s-_!@£$€})({"#¤%&=?]+/', $_POST['username'])){
					$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_invalid_signs").'</span>';
					return;
				}
			}
			if (preg_match("/@/", $_POST['email'])&&!preg_match("/ /", $_POST['email'])) {
				if ($_POST['password']>=4){
					if ($_POST['password']==$_POST['password_confirm']){
						$allowedExts = array("gif", "jpeg", "jpg", "png");
						$temp = explode(".", $_FILES["file"]["name"]);
						$extension = end($temp);
						if (($_FILES["file"]["size"] < 100000)&& in_array($extension, $allowedExts)){
							$tmp_file=$_FILES["file"]["tmp_name"];
							$img_dimensions = getimagesize($tmp_file);
							$width = $img_dimensions[0];
							$height = $img_dimensions[1];
							if ($width > 200||$height > 100) {
								$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_avatar_toobig").'</span>';
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
							$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_avatar_file").'</span>';
						}
					}else{
						$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_pass_nomatch").'</span>';
					}
				}else{
					$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_pass_tooshort").'</span>';
				}
			}else{
				$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_mail_invalid").'</span>';
			}
		}else{
			$this->notification = '<span class="label" style="background-color:#ff5849">'.$this->loc->translate("register_all_fields").'</span>';
		}
	}
}