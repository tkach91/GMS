<html>  
    <body>   
		<div class="content">
        <? echo form_open('admin/add_group'); ?>     
			<table>
			<tr><td>Название группы</td>
			<td><input type='text' name='gname' value='<? echo tag($info['name']); ?>'></td></tr>
			<tr><td>Лидер группы:</td>
			<td><select name='grp_leader'>
					<?php foreach($grps->result_array() as $row):
						$uid = $row['u_id'];
						$uname = $row['u_name'];
						if ($row['u_id'] == $info['bid']) 
							echo "<option selected='selected' value='$uid'>$uname</option>";
						else					
							echo "<option value='$uid'>$uname</option>";
					endforeach; ?>
			</select></td></tr>
			<tr><td>Описание группы:</td>
			<td><textarea name='descr' rows=4 cols=25><? echo tag($info['descr']); ?></textarea></td></tr>
			<tr><td>Достижения группы:</td>
			<td><textarea name='progress' rows=4 cols=25><? echo tag($info['progr']); ?></textarea></td></tr>
			<tr><td colspan='2' align='center'>
			<input type='submit' value='Добавить'</td></tr>
			</table>
			<input type='hidden' name='id' value='<? echo $info['id']; ?>'>
        <? echo form_close(); ?>    
		</div>
	</div>		
    </body>     
</html>