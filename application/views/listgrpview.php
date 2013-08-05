<html>  
    <body>  
		<div class="content">
			<script type="text/javascript">
				$(document).ready(function() {
				$("#groups").tablesorter({sortList: [[0,1]]});
				});
			</script>	
			<table border='1' id='groups' class='tablesorter'>
			<thead>
				<tr><th>Название группы</th>
					<th>Лидер группы</th>
					<th>Описание группы</th>
					<th>Достижения группы</th>
					<td>Изменение</td>
					<td>Другие действия</td>
					<td>Другие действия</td>
					<td>Удаление</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($g_list->result_array() as $row): ?>
					<tr>
						<td><? echo $row['wg_name'] ?></td>
						<td><? echo $row['u_name'] ?></td>
						<td><? echo $row['wg_grp_descr'] ?></td>
						<td><? echo $row['wg_progress'] ?></td>
						<td><? echo anchor('admin/call_edt_grp_view/' . $row['wg_id'] . '/' . $row['wg_name'] . '/' . $row['wg_boss_id'] . '/' . 
																		$row['wg_grp_descr'] . '/' . $row['wg_progress'], 'Редактировать');?></td>
						<td><? echo anchor('admin/call_add_usr_to_wg/' . $row['wg_id'] . '/' . $row['wg_name'], 'Добавить пользователя к группе');?></td>
						<td><? echo anchor('admin/call_add_workgroup_to_prj/' . $row['wg_id'] . '/' . $row['wg_name'], 'Добавить группу к проекту');?></td>
						<td><? echo anchor('admin/drop_rec/' . $row['wg_id'] . '/grp', 'Удалить');?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
		</div>
	</div>
    </body>     
</html>