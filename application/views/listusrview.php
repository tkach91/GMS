<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#users").tablesorter({sortList: [[0,1]], [[1,0]]});
			});
		</script>
		<div class="content">		
		<table border='1' id='users' class='tablesorter'>
			<thead>
			<tr><th>Имя пользователя</th>
				<th>Ранг</th>
				<th>Уровень доступа</th>
				<th>Последний выход из системы</th>
				<th>Статус пользователя</th>
				<td>Изменение</td><td>Удаление</td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($u_list->result_array() as $row): ?>
				<tr><td><? echo $row['u_name'] ?></td>
					<td><?if (empty($row['r_name']))
						echo "не известен";
					else 
						echo $row['r_name'] ?>
					</td>
					<td><?if (empty($row['a_name']))
						echo "не известен";
					else
						echo $row['a_name'] ?></td>
					<td><?if (empty($row['u_last_logout']))
						echo "не было";
					else
						echo $row['u_last_logout'] ?></td>
					<? 	if ($row['u_adm_status'] === 'admin')
							$status = 'администратор системы';
						elseif ($row['u_adm_status'] === 'grp_leader')
							$status = 'глава группы';
						elseif ($row['u_adm_status'] === 'logged user')
							$status = 'обычный пользователь';
						else
							$status = 'статус не определён'; 
					?>
					<td><? echo $status ?></td>
					<td><? echo anchor('admin/call_edt_usr_view/' . $row['u_id'] . '/' . $row['u_name'] . '/' . $row['u_rid'] . '/' .
									    $row['u_aid'] . '/' . $row['u_adm_status'], 'Редактировать') ?></td>
					<td><? echo anchor('admin/drop_rec/' . $row['u_id'] . '/usr', 'Удалить');?></td>
					
				</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
		</div>
	</div>
    </body>     
</html>  