<div id="main">
	<div class="title">更多应用</div>
	<div class="metroWrapper">
		<div class="subTitle">优秀作品</div>
		<?php if(isset($excellent_hws) && $excellent_hws == NULL) {
        	?>
        	暂无
        <?php }
        else {
        	foreach ($excellent_hws as $hw) {
        	?>
	        <div class="metro colorb" onclick="window.open('<?= base_url().$hw['src']?>')">
                <div class="metroText">
                <div textType="title">访问应用</div>
                <div textType="text">作者：<?= $hw['user_name']?></div> 
                </div>          
	        </div>
	        <a href="<?= site_url('student/download_hw'.'/'.$hid.'/'.$hw['src'])?>">
	            <div class="metro colord">
        			<div class="metroText">
                    <div textType="title">下载源码</div>
                    <div textType="text">作者：<?= $hw['user_name']?></div> 
                    </div>          
	            </div>
	        
	        </a>
	        <?php 
			}
		} ?>
        </div>
	<div class="metroWrapper_hw">
       <div class="subTitle">其它作品</div>
       <?php
        	if ($reach_deadline && isset($others_hws)) {
        		foreach ($others_hws as $hw) {
        	?>
	        	<div class="metro colorb" onclick="window.open('<?= base_url().$hw['src']?>')">
	                    <div class="metroButton"><?= $hw['user_name']?></div>          
	        	</div>
        	<?php
				}
			}
        ?>
	</div>
</div>