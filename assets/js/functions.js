/**
 * Created with JetBrains PhpStorm.
 * User: kemo
 * Date: 3.11.13
 * Time: 20:49
 * To change this template use File | Settings | File Templates.
 */


if(typeof Blog == 'undefined'){
    Blog = {};
}

$(document).ready(function(){

    Blog.addNewPosting = function(){

        var $postTitle = $("#post_title");
        var $postText = $("#post_text");
        var $postTags = $("#post_tags");
        $postTitle.val("");
        $postText.val("");
        $postTags.val("");

        $('#addNewPosting').modal('show');

        $("#savePost").click(function(){

            if($postTitle.val().length > 0 && $postText.val().length > 0){
                savePost($postTitle.val(),$postText.val(), $postTags.val());
            }else{
                alert("All fields must be inserted!");
            }

        })

        function savePost(title, text, tags){
            var userId = $("#user_id").data("value");
            var base_url = $("#base_url").data("value");

            $.ajax({
                url: base_url+"posts/add_post",
                type: "post",
                data: {"title":title, "text": text,"tags": tags}
            }).done(function(response){
                    if(response == true){
                        window.location = base_url+"posts";
                        $('#addNewPosting').modal('hide');
                    }else{
                        alert("Error occured!");
                    }
                })
        }
   }


    Blog.login = function(){

        var $form_login = $("#form_login");
        var $username = $("#username", $form_login);
        var $password = $("#password", $form_login);


        var $modal_form = $(".form-signin");
        var $modal_username = $("#username", $modal_form);
        var $modal_password = $("#password", $modal_form);



        var $error_block = $("#login_error", $modal_form);
        var $errortext = $("h2", $error_block);


        $("#signin", $form_login).click(function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            event.stopPropagation();
            if($username.val().length > 0 && $password.val().length > 0){
                login($username.val(),$password.val());
            }else{
                alert("All fields must be inserted!");
            }

            return false;
        })

        $('#signin', $form_login).click(function(e){
            e.preventDefault();
        })



        $("#signin", $modal_form).click(function(event){
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            if($modal_username.val().length > 0 && $modal_password.val().length > 0){
                $('#login_modal').modal('hide');
                login($modal_username.val(),$modal_password.val());
            }else{
                alert("All fields must be inserted!");
            }

            return false;
        })

        $('#signin', $modal_form).click(function(e){
            e.preventDefault();
        })

        function login(username, password){
            var base_url = $("#base_url").data("value");

            $.ajax({
                url: base_url+"login/index",
                type: "post",
                data: {"username":username, "password": password}
            }).done(function(response){
                    if(response == true){
                        window.location = base_url;
                        $('#login_modal').modal('hide');
                    }else{
                        $('#login_modal').modal('show');
                        $errortext.text(response);
                        $error_block.show();
                    }
                })

            return false;
        }
    }

    Blog.login();





})