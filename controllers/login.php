<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kemo
 * Date: 7.11.13
 * Time: 20:26
 * To change this template use File | Settings | File Templates.
 */

class login extends Controller {
    function index_ajax(){

        // Authenticate by POST data
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
                exit("Vale kasutajanimi või parool");
            }
        }

    }
}