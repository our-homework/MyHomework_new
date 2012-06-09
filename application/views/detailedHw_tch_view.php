<div id="main">
	<div class="title">详细作业</div>
	<div textType="title" >Title: <?= $homework->title?> </div>
	<div>Deadline: <?= $homework->deadline?></div>
	<div>Content: <?= $homework->content?></div>
	<div>Author: <?= $homework->author?></div>

	<div class="textWrapper">
	</div>
	<div class="metroWrapper">
		<a href="<?= site_url('teacher/edit_hw'.'/'.$homework->hid)?>">
            <div class="metroRec colorg">
            	<div class="metroButton" >修改
                </div>
            </div>
        </a>
        <?php if (isset($reach_deadline)) {
        	if ($reach_deadline == TRUE) {
        	?>
        	<a href="<?= site_url('teacher/rate_hw'.'/'.$homework->hid)?>">
            <div class="metroRec colorf">
            	<div class="metroButton" >评审
                </div>
            </div>
        </a>
        	<?php
			}
        }?>
	</div>
	
</div>