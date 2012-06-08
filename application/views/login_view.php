<div id="wrap">
	<div id="title_login">登录账户</div>
	<?= form_open('user/loginCheck') ?>
	<div class="subTitle_login">用户名</div>
	<label><input type="text" name="uid" value="<?= set_value('uid'); ?>"/></label>
	<div class="subTitle_login">密码</div>
	<label><input type="password" name="password" value="<?= set_value('password'); ?>"/></label>
	<div id="button">
		<input type="submit" class="button" value="登录" />
		<input type="reset" class="button" value="取消" />
	</div>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
	<?= form_close(); ?>
</div>