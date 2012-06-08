<div id="wrap">
	<div id="title_login">发布作业</div>
	<?= form_open("teacher/publishHw_check") ?>
  	<div class="subTitle_login"  style="display:inline-block">作业名  </div>
	<label><input type="text" class="publish" name="name" value="<?= set_value('user_name'); ?>"/></label>
    <div class="subTitle_login"  style="display:inline-block">截止日期  </div>
	<label><input type="text" class="publish" name="deadline" value="<?= set_value('password'); ?>"/></label>
	<div class="subTitle_login">要求</div>
	<label><textarea></textarea></label>

	<div id="button">
		<input type="submit" class="button" value="发布" />
		<input type="reset" class="button" value="取消" />
	</div>
	<?= form_close() ?>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
</div>