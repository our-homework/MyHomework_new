<div id="main">
	
	<div class="title"><?= $homework->title ?></div>
	<div class="textWrapper">
		<div class="hw_info">
            <div class="metroText">
                <div textType="title" >作业详细</div>
                <?= $homework->content ?>
				<div>提交状态：</div>
				<div>访问应用:</div>
				<div>源码下载：</div>
				<div>成绩：</div>
				<form action="<?= site_url('student/upload_hw'.'/'. $homework->hid.'/'.$this->session->userdata('uid'))?>" method="post" enctype="multipart/form-data">
				<input type="file" name="src" value="上传" /> 
				<input type="submit" value="upload" />
				</form>
        	</div>
        </div>
		<div class="others" >
                <div textType="title" >小组成员作品</div>
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <div textType="title" >优秀作品</div>
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <div textType="title" >其他作品</div>
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
                <a href="#">王笑笑</a><br />
        </div>
	</div>
	<!--<?= form_open_multipart('student/upload_hw')?> .'/'. $homework->hid.'/'.$this->session->userdata('uid')-->
	
	<div class="metroWrapper">
        <div class="metroRec colorg">
			 <class="metroRec colorf">
			 <input type="file" name="src" value="上传" /> 
            	<div class="metroButton" >上传</div>
        </div>
		<a href="#">
            <div class="metro colorf">
            	<div class="metroButton" >评审
                </div>
            </div>
        </a>
	</div>
	<div class='clear'></div>
	
</div>