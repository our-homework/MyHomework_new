<div id="wrap">
	<div id="title_login">创建小组</div>
	<div class="subTitle_login">组号<div class="subTitle_login">id</div></div>
	
	<?= form_open("student/create_team_check") ?>
	<div class="subTitle_login">组名</div>
    <label><input type="text" name='group_name' value=""/></label>
	<div id="button">
		<input type="submit" class="button" value="创建" />
		<input type="reset" class="button" value="取消" />
	</div>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
	<?= form_close(); ?>
</div>

<!-- <?= set_value('group_name'); ?> -->