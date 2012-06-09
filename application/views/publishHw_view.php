<div id="wrap">
	<div id="title_login"><?= $title?></div>
	<?= form_open('teacher/publishHw_check'.'/'.(isset($homework) ? $homework->hid : '0')) ?>
  	<div class="subTitle_login"  style="display:inline-block">作业名  </div>
	<label><input type="text" class="publish" name="name" value="<?= isset($homework) ? $homework->title : ''?>"/></label>
    <div class="subTitle_login"  style="display:inline-block">截止日期  </div>
	<label><input type="text" class="publish" name="deadline" value="<?= isset($homework) ? $homework->deadline : '' ?>"/></label>
	<div class="subTitle_login">要求</div>
	<label><textarea name="request" rows="8" cols="40"><?= isset($homework) ? $homework->content : ''?></textarea></label>

	<div id="button">
		<input type="submit" class="button" value="发布" />
		<input type="reset" class="button" value="取消" />
	</div>
	<?= form_close() ?>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
</div>