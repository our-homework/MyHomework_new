<div id="main">
	<div class="title"><?= isset($group_name)?$group_name:'' ?></div>

	<div class="textWrapper">
    	
    	<table num=3> 
        <form>
        	<tr textType="title">
            	<th>姓名</th>
                <th>学号</th>
                <th>角色</th>	
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
			</tr>
			<?php
					}
				}
            ?>
        </form>       
        </table>
	</div>
	<div class="metroWrapper">
		<a href="#">
            <div class="metroRec colorg">
            	<div class="metroButton" >退出小组
                </div>
            </div>
        </a>
        <?php 
        	if (isset($leader_id) && $uid === $leader_id) {
        ?>
			<input type="submit" class="metroRec colorf metroButton" value="转移组长" />
		<?php
			}
			else {
			echo '';
			}
		?>
	</div>
	
</div>