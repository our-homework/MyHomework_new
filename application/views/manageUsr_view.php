<div id="main">
	<div class="title">用户管理</div>

	<?= form_open('teacher/delete_user')?>
	<div class="textWrapper">
    	<table num=3> 
        	<tr textType="title">
            	<th>姓名</th>
                <th>学号</th>
                <th>角色</th>
                <th>组别</th>
                <th>选择</th>	
            </tr>
            <?php 
            if(isset($users)) {
            	foreach ($users as $user) {
            	?>
        		<tr>
        		<td><?= $user['user_name']?></td>
            	<td><?= $user['uid']?></td>
            	<td><?= $user['role']?></td>
            	<td><?= isset($user['group_name']) ? $user['group_name'] : '无'?></td>
            	<td>
            		<input type="checkbox" name="delete_uid[]" value="<?= $user['uid']?>" />
            	</td>
				</tr>
            <?php 
				} 
			}
			?>
        </table>
        <div id="errMsg"><?= isset($errorMsg) ? $errorMsg : ''?></div>
	</div>
	<div class="metroWrapper">
		<a href="<?= site_url('teacher/add_user')?>">
            <div class="metroRec colorg">
            	<div class="metroButton" >添加用户
                </div>
            </div>
        </a>
		<a href="<?= site_url('teacher/delete_user')?>">
		<input type="submit" class="metroRec colorf metroButton" value="删除" />
		</a>
	</div>
	<?= form_close();?>
</div>