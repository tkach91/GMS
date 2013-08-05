<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#projects").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">
		<table border='1' id='projects' class='tablesorter'>
		<thead>
			<tr><th>Название проекта</th>
				<th>Описание проекта</th>
				<th>Статус</th>
				<th>Последняя правка</th>
				<th>Deadline</th>
				<td>Изменение</td>
				<td>Содержимое</td>
				<td>Другие действия</td>
				<td>Удаление</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($p_list->result_array() as $row): ?>
				<tr>
					<td><? echo $row['p_name'] ?></td>
					<td><? echo $row['p_descr'] ?></td>
					<td><? 
							if ($row['p_prj_status'] == 1)
								echo  "завершён";
							else
								echo "в работе";
						?></td>					 
					<td><? echo $row['p_changed'] ?></td>
					<td><? echo $row['p_finished'] ?></td>
					<? if ($info['usr_status'] == 'grp_leader')
					{
						echo '<td>Редактировать</td>';
						echo '<td>' . anchor('admin/show_goals/' . $row['p_id'], 'Изменить цели') . '</td>';
						echo '<td>' . anchor('admin/call_add_goal_view/' . $row['p_id'], 'Добавить цель к проекту') . '</td>';
						echo '<td>Удалить</td>';
					}
					else
					{
						echo '<td>' . anchor('admin/call_update_prjs_view/' . $row['p_id'], 'Редактировать') . '</td>';
						echo '<td>' . anchor('admin/show_goals/' . $row['p_id'], 'Изменить цели') . '</td>';
						echo '<td>' . anchor('admin/call_add_goal_view/' . $row['p_id'], 'Добавить цель к проекту') . '</td>';
						echo '<td>' . anchor('admin/drop_rec/' . $row['p_id'] . '/prj', 'Удалить') . '</td>';
					}
					?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
		</div>
	</div>
    </body>     
</html>