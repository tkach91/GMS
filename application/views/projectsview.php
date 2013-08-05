<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#rnkprojects").tablesorter({sortList: [[0,1]]});
			$("#usrprojects").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">
			<b>Проекты, к которым Вам предоставлен доступ в соответствие с рангом:<b>
			<table border='1' id='rnkprojects' class='tablesorter'>
				<thead>
				<tr><th>Название проекта</th>
					<td>Действие</td>
				</tr>
				</thead>
				<tbody>
				<?php foreach($p_list->result_array() as $row): ?>
					<tr>
						<td><? echo $row['p_name'] ?></td>
						<td><? echo anchor('main/show_prj/' . $row['p_id'], 'Просмотр проекта');?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<br></br>
			<b>Проекты над которыми работает Ваша рабочая группа:<b>
			<table border='1' id='usrprojects' class='tablesorter'>
				<thead>
				<tr><th>Название проекта</th>
					<td>Действие</td>
				</tr>
				</thead>
				<tbody>
				<?php foreach($my_p_list->result_array() as $row): ?>
					<tr>
						<? if (($row['p_id'] == '') or ($row['p_name'] == '')) 
							continue; ?>
						<td><? echo $row['p_name'] ?></td>
						<td><? echo anchor('main/show_prj/' . $row['p_id'], 'Просмотр проекта');?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
    </body>     
</html>