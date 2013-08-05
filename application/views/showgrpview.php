<html>  
    <body>   
		<script type="text/javascript">
			$(document).ready(function() {
			$("#groups").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">
			<table>
				<tr><td><b>Название группы:</b></td>
				<td> <? echo $grp_info->wg_name; ?></td></tr>
				<tr><td><b>Глава группы:</b></td>
				<td> <? echo $grp_info->u_name; ?></td></tr>
				<tr><td><b>Описание группы:</b></td>
				<td> <? echo $grp_info->wg_grp_descr; ?></td></tr>
				<tr><td><b>Достижения группы:</b></td>
				<td> <? echo $grp_info->wg_progress; ?></td></tr>
			</table>
			<br></br>
			<table>
				<tr><td><b>Состав группы</b></td></tr>
			</table>
			<table border='1' id='groups' class='tablesorter'>
				<thead><tr><th>Имя</th><th>Ранг</th><th>Уровень доступа</th></tr></thead>
				<tbody>
				<?php foreach($grp_members->result_array() as $row): ?>
					<tr><td><? echo $row['u_name'] ?></td>
					<td><? if (!empty($row['r_name']))
						        echo $row['r_name'];
						   else
							    echo "отсутствует";
					?></td>
					<td><? if (!empty($row['r_name']))
						        echo $row['a_name'];
						   else
							    echo "отсутствует";
					?></td></tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
    </body>     
</html>  