<div id="main">
	<div class="title">首页</div>

	<div class="metroWrapper_hw">
		<div class="subTitle">作业</div>
		<?php
			if (isset($homeworks)) {
				foreach ($homeworks as $hw) {
				?>
				<a href="<?= site_url('homework/show_hw_detail').'/'.$hw['hid']?>">
            	<div class="metro colora">
        			<div class="metroText">
	        			<div textType="title" ><?= $hw['title']?></div>
	            		<?= $hw['grade']?>
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
		<a href="<?= site_url('student/show_my_team') ?>">
            <div class="metroRec colorf">
                <div class="metroButton">我的小组
                </div>          
            </div>
        </a>
		<a href="<?= site_url('student/create_team') ?>">
            <div class="metroRec colork">
                <div class="metroButton">创建小组
                </div>          
            </div>
        </a>
		<a href="<?= site_url('student/join_team') ?>">
            <div class="metroRec colorl">
                <div class="metroButton">加入小组
                </div>          
            </div>
        </a>
	</div>
	
</div>