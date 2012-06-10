<div id="main">
	<div class="title"><?= $homework->title?></div>
	<div class="hw_info">
		<div class="hw_info">
            <div class="metroText">
                <div textType="title" >作业详细</div>
                <div>deadline：<?= $homework->deadline?></div>
                <div textType="text">
					<?= $homework->content ?>
                    <?php
                        $hand_in = ($homework->src == NULL) ? FALSE : TRUE;
                    ?>
                    <div>提交状态：<?= $hand_in ? '已提交' : '未提交'?></div>
    
                    
                    <div>成绩：<?= ($homework->grade == NULL) ?'无' : $homework->grade?></div>
				</div>
        	</div>
        </div>
	</div>
		<div class="metroWrapper">
            <div class="subTitle">小组成员作品</div>
       		<?php if (isset($member_hw)) {
       			foreach ($member_hw as $hw) {
       				?>
       				<div class="metro colorb" onclick="window.open('<?= base_url().$hw->src?>')">
        			<div class="metroText">
                        <div textType="title">访问应用</div>
                        <div textType="text">作者：<?= $hw->user_name?></div> 
                    </div>          
            </div>
        
	        <a href="<?= site_url('student/download_hw'.'/'.$hw->hid.'/'.$hw->src)?>">
	            <div class="metro colord">
        			<div class="metroText">
	                    <div textType="title">下载源码</div>
	                    <div textType="text">作者：<?= $hw->user_name?></div> 
                    </div>          
	            </div>
	        </a>
					<?php 
				   }
				}
				else {
					?>
						暂无
					<?php
				}?>
            
	    </div>
	<div class="metroWrapper">
		<div class="subTitle"> </div>
		<?php if(isset($reach_deadline) && !$reach_deadline) { ?>
    	<form action="<?= site_url('student/upload_hw'.'/'. $homework->hid.'/'.$this->session->userdata('uid'))?>" method="post" enctype="multipart/form-data">            
            <div class="metro colorg">
                 <input class="metro colorf" type="file" name="src" value="选择文件" /> 
                    <div class="metroButton" >选择文件</div>
            </div>
            <input class="metro colora metroButton" type="submit" value="上传" />
        </form>
        <?php 
			if ($is_leader) {
			?>
				<a href="<?= site_url('student/rank_member'.'/'.$homework->hid)?>">
	            <div class="metroRec colorf">
	            	<div class="metroButton" >组内排名
	                </div>
	            </div>
	        </a>
			<?php
			}
		}?>
        <?php if ($hand_in) {?> 
							<a href="<?= $homework->src?>">
                            	<div class="metroRec colord metroButton">访问我的应用</div>
                            </a>
					 <?php }
					 ?>
		<?php if ($hand_in) {?> 
							<a href="<?= site_url('student/download_hw'.'/'.$homework->hid.'/'.$homework->src)?>">
                            	<div class="metroRec colori metroButton">下载我的源码</div>
                            </a>
					 <?php }
					 ?> 
		<?php if(isset($reach_deadline) && $reach_deadline) { ?>
		<a href="<?= site_url('student/show_others_hw'.'/'.$homework->hid.'/'.$reach_deadline)?>">
            <div class="metroRec colorb">
            	<div class="metroButton" >查看更多作品
                </div>
            </div>
        </a>
        <?php }?>
	</div>
	<div class='clear'></div>
	
</div>