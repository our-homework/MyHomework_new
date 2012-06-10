<div id="main">
	<div class="title"><?= isset($group_name)?$group_name:'' ?></div>

    <?= form_open('student/transfer_group_leader') ?>
	<div class="textWrapper">
    	<table> 
        <form>
        	<tr textType="title">
            	<th>姓名</th>
                <th>学号</th>
                <th>角色</th>	
                <?php 
                if (!$this->Group_model->is_lock())
		        	if (isset($leader_id) && $uid === $leader_id && count($members) > 1) { 
                ?>
                <th>选择组长</th>
                <?php 
					} 
				?>
            </tr>
            <?php
            	if (isset($members)) { 
            		$keys = array_keys($members);
            		foreach ($keys as $key) {		
            ?>
			<tr>
				<td><?= $members[$key] ?></td>
				<td><?= $key ?></td>
				<td><?= ($key === $leader_id) ? "组长":"组员" ?></td>
				<?php 
				if (!$this->Group_model->is_lock())
		        	if (isset($leader_id) && $uid === $leader_id && count($members) > 1) { 
                ?>
                <td><input type='radio' name='leader' value=<?= $key?>></td>
                <?php 
					} 
				?>
			</tr>
			<?php
					}
				}
            ?>
        </form>       
        </table>
	</div>
	<div class="metroWrapper">
		<?php 
		if (!$this->Group_model->is_lock() && (isset($leader_id) && $uid != $leader_id || count($members) == 1))
			if ($this->session->userdata('role') == 'student') {
		?>
		<a href="
				<?php
					if (array_key_exists($uid, $members))
						echo site_url('student/quit_group_check').'/'.$gid;
					else {
						echo site_url('student/join_group_check').'/'.$gid;	 
					}
				?>
				">
            <div class="metroRec colorg">
            	<div class="metroButton" ><?= array_key_exists($uid, $members)?'退出小组':'加入小组' ?>
                </div>
                <div><?= isset($join_group_errorMsg)?$join_group_errorMsg:'' ?></div>
            </div>
        </a>
        <?php
		} 
        if (!$this->Group_model->is_lock())
        	if (isset($leader_id) && $uid === $leader_id && count($members) > 1) {
        ?>
		<input type="submit" class="metroRec colorf metroButton" value="转移组长" />
		<div><?= isset($transfer_leader_errorMsg)?$transfer_leader_errorMsg:'' ?></div>	
		<?php
			}
		?>
	<?= form_close() ?>
	</div>
	
</div>