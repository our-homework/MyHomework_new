<div id="main">
	<div class="title"><?= $title?></div>

	 <div id="metroWrapper_grpInfoFixed" >
	 	<?php
	 	if ($this->session->userdata('role') != 'student') {
	 	?>
		<a href="<?= site_url('teacher/triggle_group_lock')?>">
	        <div class="metroRec colorb">
	            <div class="metroButton"><?= ($this->session->userdata('group_lock') == TRUE) ? '解除锁定' : '锁定分组'?>
	            </div>          
	        </div>
	    </a>
	    <?php 
		}
	    ?>
	    <div class="metroSqu_grpInfo colord">
	        <div class="metroText">
            <div textType="title" >小组统计信息</div>
            	已创建小组数：<?= $group_number ?> <br/>
            	课程人数：<?= $stu_number ?> <br/>
            	未组队人数：<?= $stu_number - $grouped_stu_number ?>
	        </div>        
	    </div>
	</div>
	<div class="metroWrapper_grpInfo">
		<?php 
			$count = 97;
			$index = 1;
			$i = 0;
			foreach ($groups as $group) {
		?>
		<a href="<?= site_url('student/select_group').'/'.$group['gid'] ?>">
            <div class="<?= "metroSqu color".(chr($count))?>" >
                <div class="metroText">
                    <div textType="title" >Team Name: <?= $group['group_name'] ?></div>
                    <div textType="title" >Creater: <?= $uid2user_name[$group['leader_id']] ?></div>
                    <div textType='title' >Members:</div>
                    <?php
                    	//print_r($members);
                    	$member = $members[$index][$group['gid']];
						//print_r($member);
                    	for ($i = 0; $i < count($member); $i++) {
					?>
					
						<div><?= $uid2user_name[$member[$i]] ?></div>
						<?php	
						}
						?>
                </div>        
            </div>
        </a>
			<?php
				$count++;
				$index++;
				if ($count > 105)
					$count = 97;
			}
			?>
	</div>
</div>