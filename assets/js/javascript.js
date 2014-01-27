var fields = false;
var nimi = false;
var meil = false;
var par = false;
var par_kontr = false;
var pilt = false;

function fieldsCheck(){
	if (nimi && meil && par && par_kontr && pilt){
		fields = true;
	}else{
		fields = false;
	}
}

$(document).ready(function(){

	var jVal = {

		'userName' : function() {

			$('body').append('<div id="nameInfo" class="info"></div>');

			var nameInfo = $('#nameInfo');
			var ele = $('#usernames');
			var pos = ele.offset();

			nameInfo.css({
				top: pos.top-3,
				left: pos.left+ele.width()+15
			});

			if(ele.val().length < 4) {
				nimi = false;
				fieldsCheck();
				jVal.errors = true;
				nameInfo.removeClass('correct').addClass('error').html('&larr; Must be at least 4 characters').show();
				ele.removeClass('normal').addClass('wrong');
			} else {
				checkUser(ele.val());
				nimi = true;
				fieldsCheck();
				jVal.errors = false;
				nameInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
			}
			function checkUser(user){
				var base_url = $("#base_url").data("value");
				$.ajax({
					url: base_url+"register/check_user",
					type: "post",
					data: {"user":user}
				}).done(function(response){
					if(response == true){
						nimi = false;
						fieldsCheck();
						jVal.errors = true;
						nameInfo.removeClass('correct').addClass('error').html('&larr; This username allready taken!').show();
						ele.removeClass('normal').addClass('wrong');
					}
				});
			}
		},

		'email' : function() {

			$('body').append('<div id="emailInfo" class="info"></div>');

			var emailInfo = $('#emailInfo');
			var ele = $('#emails');
			var pos = ele.offset();

			emailInfo.css({
				top: pos.top-3,
				left: pos.left+ele.width()+15
			});

			var patt = /^.+@.+[.].{2,}$/i;

			if(!patt.test(ele.val())) {
				meil = false;
				jVal.errors = true;
				emailInfo.removeClass('correct').addClass('error').html('&larr; Not a valid e-mail address!').show();
				ele.removeClass('normal').addClass('wrong');
			} else {
				meil = true;
				jVal.errors = false;
				emailInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
			}
			fieldsCheck();
		},

		'passWord' : function() {

			$('body').append('<div id="passInfo" class="info"></div>');

			var passInfo = $('#passInfo');
			var passConfirmInfo = $('#passConfirmInfo');
			var ele = $('#passwords');
			var pos = ele.offset();

			passInfo.css({
				top: pos.top-3,
				left: pos.left+ele.width()+15
			});

			if(ele.val().length < 6) {
				par = false;
				jVal.errors = true;
				passInfo.removeClass('correct').addClass('error').html('&larr; Too short!').show();
				ele.removeClass('normal').addClass('wrong');
				passConfirmInfo.removeClass('correct').addClass('error').html('&larr; Does not match!').show();
			} else {
				par = false;
				jVal.errors = false;
				passInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
				passConfirmInfo.removeClass('correct').addClass('error').html('&larr; Does not match!').show();
			}
			fieldsCheck();
		},

		'passWordConfirm' : function() {

			$('body').append('<div id="passConfirmInfo" class="info"></div>');

			var passConfirmInfo = $('#passConfirmInfo');
			var ele = $('#passwordsconfirm');
			var pos = ele.offset();

			passConfirmInfo.css({
				top: pos.top-3,
				left: pos.left+ele.width()+15
			});

			if(ele.val() != $('#passwords').val() || ele.val().length <= 5) {
				par_kontr = false;
				jVal.errors = true;
				passConfirmInfo.removeClass('correct').addClass('error').html('&larr; Does not match!').show();
				ele.removeClass('normal').addClass('wrong');
			} else {
				par_kontr = true;
				par = true;
				jVal.errors = false;
				passConfirmInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
			}
			fieldsCheck();
		},

		'file' : function() {

			$('body').append('<div id="avatarInfo" class="info"></div>');

			var size = document.getElementById("file").files[0].size;
			var type = document.getElementById("file").files[0].type;
			var pic =  document.getElementById("file").files[0];


			var avatarInfo = $('#avatarInfo');
			var ele = $('#file');
			var pos = ele.offset();

			avatarInfo.css({
				top: pos.top-3,
				left: pos.left+ele.width()+15
			});

			if(type.substring(0,5) != "image") {
				pilt = false;
				jVal.errors = true;
				avatarInfo.removeClass('correct').addClass('error').html('&larr; This is not an image file!').show();
				ele.removeClass('normal').addClass('wrong');
			} else if (size > 300000) {
				pilt = false;
				jVal.errors = true;
				avatarInfo.removeClass('correct').addClass('error').html('&larr; This image weighs too much!').show();
				ele.removeClass('normal').addClass('wrong');
			} else {
				pilt = true;
				jVal.errors = false;
				avatarInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
			}
			fieldsCheck();
		}
	};

	$("#send").click(function()	{
		if(!fields) {
			alert('All fields must be filled with correct data!');
			return false;
		}else{
			var $user = $('#usernames').val();
			var $email = $('#emails').val();
			var $pass = $('#passwords').val();
			var $avatar = $user + document.getElementById("file").files[0].name;
			saveUser($user, $email, $pass, $avatar);
			function saveUser (user, email, pass, avatar){
			var base_url = $("#base_url").data("value");
			$.ajax({
				url: base_url+"register/insert_user",
				type: "post",
				data: {"user":user, "email":email, "pass":pass, "avatar":avatar}
				});
			}
			alert('User creation successful!');
		}
	});

	$('#usernames').change(jVal.userName);
	$('#emails').change(jVal.email);
	$('#passwords').change(jVal.passWord);
	$('#passwordsconfirm').change(jVal.passWordConfirm);
	$('#file').change(jVal.file);

});