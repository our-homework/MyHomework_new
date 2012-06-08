<div id="main">
	<div class="title">所有作业</div>

	<div class="metroSquWrapper">
		<?php
			$count = 97;
			foreach ($homeworks as $hw) {
		?>
				<a href="<?= site_url('homework/show_hw_Detail/').'/'.$hw['hid'] ?>">
	            	<div class="<?= "metroSqu color".(chr($count)) ?>"
	            	>
		                <div class="metroText">
		                    <div textType="title" ><?= $hw['title']?></div>	
		                    <div><?= $hw['deadline'] ?></div>
		                    <div><?= $hw['content'] ?></div>
		                </div>
	           		</div>
        		</a>
		<?php
			$count = $count + 1;
			if ($count > 105)
				$count = 97;
			}
		?>
	</div>
</div>