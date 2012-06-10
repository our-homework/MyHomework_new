<div id="wrap">
	<div id="title_login">组内排名</div>
	<?php 
		if (isset($member_hws) && count($member_hws) > 0) {
			echo form_open('student/rank_member_check'.'/'. $member_hws[0]->hid);	
			?>
		    <div textType="text">
                <table class="rank">
        			<tr>
                    	<th>姓名</th>
                        <th> 排名</th>
                        <th>更新排名</th>
                    </tr>
        		<?php
        			foreach ($member_hws as $hw) {
					?>
						<tr>
	                    	<td><?= $hw->user_name?></td>
	                        <td><?= (isset($hw->group_rank) && ($hw->group_rank != 0)) ? $hw->group_rank : ''?></td>
	                        <td>
	                   		<select class="rank" name="<?= $hw->uid?>">
	                        	<option></option>
	                        	<?php
	                        		for ($i = 1; $i <= count($member_hws); $i++) {
	                        		?>
	                        			<option value="<?=$i?>"><?=$i?></option>
	                        		<?php
									}
	                        	?>
	                        </select>
	                        </td>
            			</tr>
					<?php
					}
        		?>
        		</table>
			</div>
			<div id="button">
				<input type="submit" class="button" value="保存" />
				<input type="reset" class="button" value="取消" />
			</div>
		<?php }
		else {
			?>
				‘暂无’
			<?php
			form_close();
		} ?>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
</div>