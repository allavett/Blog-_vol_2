
<link href="<?=ASSETS_URL?>css/register.css" rel="stylesheet" />

<div id="content">
	<form enctype="multipart/form-data" id="jform" method="POST">
		<fieldset>

			<!-- Username -->
				<label class="control-label" for="username"><?=$loc->translate("register_username")?></label>
			<p></p>
				<input type="text" name="username" id="usernames" class="input-xlarge"/>
			<p class="help-block"><?=$loc->translate("register_username_txt")?></p>
			<!-- E-mail -->
				<label class="control-label" for="email">E-mail</label>
			<p></p>
				<input type="text" name="email" id="emails" class="input-xlarge"/>
			<p class="help-block"><?=$loc->translate("register_email_txt")?></p>
			<!-- Password -->
				<label class="control-label" for="password"><?=$loc->translate("register_password")?></label>
			<p></p>
				<input type="password" name="password" id="passwords" class="input-xlarge"/>
			<p class="help-block"><?=$loc->translate("register_password_txt")?></p>
			<!-- Password confirm -->
				<label class="control-label"  for="passwordconfirm"><?=$loc->translate("register_password_confirm")?></label>
			<p></p>
				<input type="password" name="passwordconfirm" id="passwordsconfirm" class="input-xlarge"/>
			<p class="help-block"><?=$loc->translate("register_password_confirm_txt")?></p>
			<!-- Avatar -->
				<label class="control-label" for="file"><?=$loc->translate("avatar")?></label>
			<p></p>
				<input type="file" name="file" id="file" class="input-xlarge"/>
			<p class="help-block"><?=$loc->translate("avatar_dimensions")?></p>

		</fieldset>
		<br />
		<div class="controls">
			<button type="submit" class="btn btn-success" id="send"><?=$loc->translate("register_btn")?></button>
		</div>
	</form>
</div><!-- content -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" charset="utf-8"></script>
<script src="<?=ASSETS_URL?>js/javascript.js"></script>

