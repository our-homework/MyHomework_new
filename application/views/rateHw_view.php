<div id="main">
	<div class="title">Homework1</div>

	<div class="textWrapper">
    	<table> 
        <form>
        	<tr textType="title">
        		<th>组号</th>
            	<th>姓名</th>
                <th>学号</th>
                <th>访问应用</th>
                <th>下载源码</th>
                <th>组内排名</th>
                <th>分数</th>
                <th>输入分数</th>	
            </tr>
            <?php
            	if(isset($users)) {
            		foreach ($users as $user) {
            			$hand_in = ($user['src'] == NULL) ? FALSE : TRUE;
					?>
					<tr>
						<td><?= $user['gid']?></td>
		            	<td><?= $user['user_name']?></td>
		                <td><?= $user['uid']?></td>
		                <td><?php if ($hand_in) {?> 
							<a href="<?= $user['src']?>">访问应用</a>
							 <?php }
								   else {?>
								   	无
							 <?php 
								   };
							 ?> 
		                </td>
		                <td><?php if ($hand_in) {?> 
							<a href="<?= site_url('student/download_hw'.'/'.$user['hid'].'/'.$user['src'])?>">下载源码</a>
							 <?php }
								   else {?>
								   	下载源码
							 <?php 
								   };
							 ?>
						</td>
		                <td><?= $user['group_rank']?></td>
		                <td><?= $user['grade']?></td>
		                <td><input type="text" name="s"></td>
					</tr> 
					<?
					}
            	}
            ?>
            </form>       
        </table>
	</div>
	<div class="metroWrapper">
	<input type="submit" class="metroRec colorf metroButton" value="更新成绩" />

	</div>
	
</div>