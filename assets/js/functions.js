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






})