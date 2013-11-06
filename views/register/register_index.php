<form class="form-horizontal" enctype="multipart/form-data" action='' method="POST">
	<fieldset>
		<div id="legend">
			<legend class=""><?=$loc->translate("register_label")?></legend>
		</div>
		<div class="control-group">
			<!-- Username -->
			<label class="control-label"  for="username"><?=$loc->translate("register_username")?></label>
			<div class="controls">
				<input type="text" id="username" name="username" placeholder="" class="input-xlarge">
				<p class="help-block"><?=$loc->translate("register_username_txt")?></p>
			</div>
		</div>
		<div class="control-group">
			<!-- E-mail -->
			<label class="control-label" for="email">E-mail</label>
			<div class="controls">
				<input type="text" id="email" name="email"  placeholder="" class="input-xlarge">
				<p class="help-block"><?=$loc->translate("register_email_txt")?></p>
			</div>
		</div>
		<div class="control-group">
			<!-- Password-->
			<label class="control-label" for="password"><?=$loc->translate("register_password")?></label>
			<div class="controls">
				<input type="password" id="password" name="password" placeholder="" class="input-xlarge">
				<p class="help-block"><?=$loc->translate("register_password_txt")?></p>
			</div>
		</div>
		<div class="control-group">
			<!-- Password confirm-->
			<label class="control-label"  for="password_confirm"><?=$loc->translate("register_password_confirm")?></label>
			<div class="controls">
				<input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
				<p class="help-block"><?=$loc->translate("register_password_confirm_txt")?></p>
			</div>
		</div>
		<div class="control-group">
<!--			Avatar-->
			<label class="control-label" for="avatar"><?=$loc->translate("avatar")?></label>
			<div class="controls">
				<input type="file" name="file" id="file"><br>
				<p class="help-block"><?=$loc->translate("avatar_dimensions")?></p>
			</div>
		</div>
		<br />
		<div class="control-group">
			<!-- Button -->
			<div class="controls">
				<button class="btn btn-success"><?=$loc->translate("register_btn")?></button>
			</div>
		</div>
		<br />
		<? if (isset($this->notification)) {
			echo $this->notification;}
		?>
	</fieldset>
</form>