<div id="main">
	<div class="title">首页</div>


	<div class="metroWrapper">
        <div class="subTitle">管理</div>
		<a href="<?= site_url('teacher/user_admin') ?>">
        	<div class="metroRec colore">
            	<div class="metroButton">用户管理</div>          
        	</div>
        </a>
		<a href="<?= site_url('teacher/group_admin')?>">
            <div class="metroRec colorh">
                <div class="metroButton">小组管理
                </div>          
            </div>
        </a>
        		<a href="<?= site_url('teacher/publishHw') ?>">
            <div class="metro colorj">
        		<div class="metroButton">发布作业</div>
            </div>
        </a>
		<a href="#">
            <div class="metro colorb">        		
        		<div class="metroButton">批改作业</div>

            </div>
        </a>
	</div>
		<div class="metroWrapper">
		<div class="subTitle">作业</div>
		<?php
			if (isset($homeworks)) {
				foreach ($homeworks as $hw) {
				?>
				<a href="<?= site_url('teacher/show_hw_detail').'/'.$hw['hid']?>">
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
</div>