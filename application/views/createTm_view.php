<div id="wrap">
	<div id="title_login">创建小组</div>
	<div class="subTitle_login">组号<div class="subTitle_login">id</div></div>
	
	<div class="subTitle_login">组名</div>
    <label><input type="text" name="user_name" value="<?= set_value('user_name'); ?>"/></label>
	<div id="button">
		<input type="submit" class="button" value="创建" />
		<input type="reset" class="button" value="取消" />
	</div>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
</div>