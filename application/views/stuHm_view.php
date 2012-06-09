<div id="main">
	<div class="title">首页</div>

	<div class="metroWrapper_hw">
		<div class="subTitle">作业</div>
		<?php
			if (isset($homeworks)) {
				foreach ($homeworks as $hw) {
				?>
				<a href="<?= site_url('homework/show_hw_detail').'/'.$hw->hid?>">
            	<div class="metro colora">
        			<div class="metroText">
	        			<div textType="title" ><?= $hw->title?></div>
	            		<?= isset($hw->grade) ? $hw->grade : ''?>
        			</div>
            	</div>
       			 </a>
				<?php
				}
			}
		?>

	</div>
	<div class="metroWrapper">
            <div class="subTitle">小组</div>
        <?php 
        	if (isset($my_group_id)) {
        ?>
		<a href="<?= site_url('student/show_my_group') ?>">
            <div class="metroRec colorf">
                <div class="metroButton">我的小组
                </div>          
            </div>
        </a>
        <?php 
			}
		?>
        <?php
        	if (!$this->Group_model->is_lock()) {
        ?>
		<a href="<?= site_url('student/create_group') ?>">
            <div class="metroRec colork">
                <div class="metroButton">创建小组
                </div>          
            </div>
        </a>
        <?php 
			}
		?>
		<a href="<?= site_url('student/join_group') ?>">
            <div class="metroRec colorl">
                <div class="metroButton"><?= isset($text)?$text:'加入小组' ?>
                </div>          
            </div>
        </a>
	</div>
	
</div>