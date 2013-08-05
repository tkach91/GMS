<html>  
    <body>  
		<div class="content">
			<script type="text/javascript">
				$(document).ready(function() {
				$("#accesses").tablesorter({sortList: [[0,1]]});
				});
			</script>	
			<table border='1' id='accesses' class='tablesorter'>
				<thead><tr><th>Название уровня доступа</th>
					<td>Изменение</td>
					<td>Другие действия</td>
					<td>Удаление</td>
				</tr></thead>
				<tbody>
				<?php foreach($a_list->result_array() as $row): ?>
					<tr>
						<td><? echo $row['a_name'];?></td>
						<td><? echo anchor('admin/call_update_access_view/' . $row['a_id'], 'Редактировать');?></td>
						<td><? echo anchor('admin/call_add_acs_to_wg/' . $row['a_id'] . '/' . $row['a_name'], 'Добавить уровень доступа к группе');?></td>
						<td><? echo anchor('admin/drop_rec/' . $row['a_id'] . '/acs', 'Удалить');?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
    </body>     
</html>