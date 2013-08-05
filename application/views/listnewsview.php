<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#news").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">
		<table border='1' id='news' class='tablesorter'>
		<thead>
			<tr><th>Название новости</th>
				<th>Автор</th>
				<th>Опубликовано</th>
				<td>Изменение</td>
				<td>Удаление</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($news_list->result_array() as $row): ?>
				<tr>
					<td><? echo $row['n_head'] ?></td>
					<td><? echo $row['u_name'] ?></td>
					<td><? echo $row['n_publ'] ?></td>
					<td><? echo anchor('admin/call_edt_news_view/' . $row['n_id'], 'Изменить');?></td>
					<td><? echo anchor('admin/drop_rec/' . $row['n_id'] . '/new', 'Удалить');?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
		</div>
	</div>
    </body>     
</html>