<div id="main">
	<div class="title"><?= $title?></div>

    <div id="metroWrapper_grpInfoFixed" >
    	<a href="<?= site_url('teacher/triggle_group_lock')?>">
            <div class="metroRec colorb">
                <div class="metroButton"><?= ($this->session->userdata('group_lock') == TRUE) ? '解除锁定' : '锁定分组'?>
                </div>          
            </div>
        </a>
        <div class="metroSqu_grpInfo colord">
            <div class="metroText">
                <div textType="title" >title1</div>
                safsdfadfasdf <br />各种小组统计信息<br />
            </div>        
    	</div>
    </div>
	<div class="metroWrapper_grpInfo">
		<?php 
			//foreach ($teamlist as $team) {
		?>
		<a href="#">
            <div class="metroSqu colorg">
                <div class="metroText">
                    <div textType="title" >Team Name: </div>
                    <div textType="title" >Members: </div>
                    <div></div>
                </div>        
            </div>
        </a>
		<?php
			//}
		?>
	</div>
</div>