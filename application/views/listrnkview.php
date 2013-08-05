<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#ranks").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">
		<table border='1' id='ranks' class='tablesorter'>
			<thead>
			<tr><th>Название ранга</td>
				<td>Изменение</td>
				<td>Доступ к проектам</td>
				<td>Удаление</td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($r_list->result_array() as $row): ?>
				<tr>
					<td><? echo $row['r_name'];?></td>
					<td><? echo anchor('admin/call_update_rank_view/' . $row['r_id'], 'Редактировать');?></td>
					<td><? echo anchor('admin/call_add_rnk_to_prj/' . $row['r_id'] . '/' . $row['r_name'], 'Добавить ранг к проекту');?></td>
					<td><? echo anchor('admin/drop_rec/' . $row['r_id'] . '/rnk', 'Удалить');?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	</div>
    </body>     
</html>