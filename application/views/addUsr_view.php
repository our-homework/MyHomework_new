<div id="wrap">
	<div id="title_login">添加用户</div>
	<?= form_open('teacher/add_user_check') ?>
	<div class="subTitle_login">学号</div>
	<label><input type="text" name="uid" value="<?= set_value('uid'); ?>"/></label>
	<div class="subTitle_login">姓名</div>
	<label><input type="text" name="user_name" value="<?= set_value('user_name'); ?>"/></label>
    <div class="subTitle_login">角色</div>
    <label><div class="check_radio">学生</div>
    <input type="radio" checked="checked" name="role" value="student" /></label>
 
    <?php 
    	if ($this->session->userdata('role') == 'teacher') {
		?>
	   		<label><div class="check_radio">TA</div>
    		<input type="radio" name="role" value="ta" /></label>
    <?php
    	}
    ?>
    
	<div id="button">
		<input type="submit" class="button" value="添加" />
		<input type="reset" class="button" value="取消" />
	</div>
	<?= form_close(); ?>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
</div>