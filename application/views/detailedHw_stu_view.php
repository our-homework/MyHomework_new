<div id="main">
	<div class="title"><?= $homework->title?></div>
	<div class="hw_info">
		<div class="hw_info">
            <div class="metroText">
                <div textType="title" >作业详细</div>
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
       
            <div class="metro colorb" onclick="window.open('#')">
        			<div class="metroText">
                        <div textType="title">访问应用</div>
                        <div textType="text">作者：谁谁谁</div> 
                    </div>          
            </div>
        
	        <a href="#">
	            <div class="metro colord">
        			<div class="metroText">
	                    <div textType="title">下载源码</div>
	                    <div textType="text">作者：谁谁谁</div> 
                    </div>          
	            </div>
	        </a>
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
		} ?>
		<a href="#">
            <div class="metroRec colorf">
            	<div class="metroButton" >评审
                </div>
            </div>
        </a>
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
		<a href="#">
            <div class="metroRec colorb">
            	<div class="metroButton" >更多应用
                </div>
            </div>
        </a>
        <?php }?>
	</div>
	<div class='clear'></div>
	
</div>