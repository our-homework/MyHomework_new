<div id="main">
	<div class="title"><?= $title?></div>

    <div class="metroSqu_grpInfo colord">
        <div class="metroText">
            <div textType="title" >小组统计信息</div>
            	已创建小组数：<?= $group_number ?> <br/>
            	课程人数：<?= $stu_number ?> <br/>
            	未组队人数：<?= $stu_number - $grouped_stu_number ?>
        </div>        
    </div>
	<div class="metroWrapper_grpInfo">
		<?php 
			$count = 97;
			$index = 1;
			$i = 0;
			foreach ($groups as $group) {
		?>
		<a href="<?= site_url('student/join_team_check') ?>">
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