<html>  
    <body> 
		<div class="content">
			<script type="text/javascript">
				$(document).ready(function() {
				$("#acsgroups").tablesorter({sortList: [[0,1]]});
				$("#usrgroups").tablesorter({sortList: [[0,1]]});
				});
			</script>	
			<b>Группы, к которым у Вас есть доступ:<b>
			<table border='1' id='acsgroups' class='tablesorter'>
				<thead>
				<tr><th>Название группы</th>
					<td>Действие</td>
				</tr>
				</thead>
				<tbody>
				<?php foreach($g_acs->result_array() as $row): ?>
					<tr>
						<td><? echo $row['wg_name'] ?></td>
						<td><? echo anchor('main/show_grp/' . $row['wg_id'], 'Просмотр группы');?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<br></br>
			<b>Группы, членом которых Вы являетесь:<b>
			<table border='1' id='usrgroups' class='tablesorter'>
				<thead>
				<tr><th>Название группы</th>
					<td>Действие</td>
				</tr>
				</thead>
				<tbody>
				<?php foreach($g_member->result_array() as $row): ?>
					<tr>
						<td><? echo $row['wg_name'] ?></td>
						<td><? echo anchor('main/show_grp/' . $row['wg_id'], 'Просмотр группы');?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
    </body>     
</html>