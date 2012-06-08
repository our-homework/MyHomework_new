<div id="main">
	<div class="title"><?= $title?></div>

    <div class="metroSqu_grpInfo colord">
        <div class="metroText">
            <div textType="title" >title1</div>
            safsdfadfasdf <br />各种小组统计信息<br />
        </div>        
    </div>
	<div class="metroWrapper_grpInfo">
		<?php 
			$count = 97;
			foreach ($groups as $group) {
		?>
		<a href="#">
            <div class="<?= "metroSqu color".(chr($count))?>" >
                <div class="metroText">
                    <div textType="title" >Team Name: <?= $group['group_name'] ?></div>
                    <div textType="title" >Creater: <?= $group['leader_id'] ?></div>
                    <div></div>
                </div>        
            </div>
        </a>
		<?php
			$count++;
			if ($count > 105)
				$count = 97;
			}
		?>
	</div>
</div>