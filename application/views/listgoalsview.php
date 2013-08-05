<html>
	<body>
		<div class="content">
			<table border='1' id='goals' class='tablesorter'>
				<thead>
					<tr><th>Название</th>
					<th>Описание</th>
					<th>Статус цели</th>
					<td>Изменение</td>
					<td>Удаление</td></tr>
				</thead>
				<tbody>
					<?php foreach($prj_goals->result_array() as $row): ?>
						<tr><td><? echo $row['g_name'] ?></td>
							<td><? echo $row['g_descr'] ?></td>
							<td> <? 
									if ($row['g_status'] == 1)
										echo "завершёно";
									else
										echo "в разработке";
									?>
							<? if ($info['usr_status'] == 'grp_leader')
							{
								echo '<td>' . anchor('admin/call_update_goals_view/' . $row['g_id'], 'Изменить') .  '</td>'; 
								echo '<td>Удалить</td>'; 
							}
							else
							{
								echo '<td>' . anchor('admin/call_update_goals_view/' . $row['g_id'], 'Изменить') .  '</td>'; 
								echo '<td>' . anchor('admin/drop_rec/' . $row['g_id'] . '/' . 'goal', 'Удалить') .  '</td>'; 
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