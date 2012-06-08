<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.?>w3.org/1999/xhtml">
    <head>
    	<base href="<?= base_url() ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>My Homework</title>
        <link href="css/theme.css" rel="stylesheet" type="text/css" />
        <link href="css/<?= isset($css) ? $css : "index" ?>.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
    	<?php 
    	if(current_url() != base_url().'index.php') {
    		if($this->session->userdata('is_login') == TRUE) {
    		?>
    		<div class="userInfo">
	    		<div class="userName_info" ><?= $this->session->userdata('user_name')?></div>
	        	<a href="<?= site_url('user/logout')?>"><img class="userImage_info" src="img/<?= $this->session->userdata('role')?>.jpg"></img></a>
	    	</div>
            	<a id="backButton" href="<?= site_url(($this->session->userdata('role') == 'student') ? 'student' : 'teacher')?>"><img src="img/home.png" alt="返回主页"/></a>
            <?php
				}
			}
    		?>
    	<div class="clear"></div>