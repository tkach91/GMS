<html>  
    <body>   
		<div class="content">
        <? echo form_open('admin/add_user');?>     
			<table>
				<tr><td>Имя пользователя:</td>
				<td><input type='text' name='username' value='<? echo tag($info['name']) ?>'></td></tr>
				<tr><td>Пароль:
				<td><input type='text' name='pass'></td></tr>
				<tr><td>Ранг:</td>
				<td><select name='rank'>
				<?php foreach($ranks->result_array() as $row): 
						$rid = $row['r_id'];
						$rname = $row['r_name'];
						if ($row['r_id'] == $info['rid']) 
							echo "<option selected='selected' value='$rid'>$rname</option>";
						else					
							echo "<option value='$rid'>$rname</option>";
					endforeach; ?>
				</select></td></tr>
				<tr><td>Доступ:</td>
				<td><select name='access'>
				<?php foreach($accesses->result_array() as $row): 
					$aid = $row['a_id'];
					$aname = $row['a_name'];
					if ($row['a_id'] == $info['aid']) 
						echo "<option selected='selected' value='$aid'>$aname</option>";
					else					
						echo "<option value='$aid'>$aname</option>";
				endforeach; ?>
				</select></td></tr>
				<tr><td></td>
				<tr><td>Статус:</td>
				<td><select name='perm'>
					<?php if ($info['adm'] === 'admin') 
							echo "<option selected='selected' value='admin'>администратор</option>";
						  else 
							echo "<option value='admin'>администратор</option>";
						  if ($info['adm'] === 'grp_leader') 
							echo "<option selected='selected' value='grp_leader'>глава группы</option>";
						  else
							echo "<option value='grp_leader'>глава группы</option>";
						  if ($info['adm'] === 'logged%20user')
							echo "<option selected='selected' value='logged user'>обычный пользователь</option>";
						  else
							echo "<option value='logged user'>обычный пользователь</option>"; ?>
				<tr><td colspan='2' align='center'>
				<input type='submit' value='Далее'</td></tr>
			</table>
			<input type='hidden' name='id' value='<? echo $info['id']; ?>'>
        <? echo form_close(); ?>  
		</div>
	</div>		
    </body>     
</html>   