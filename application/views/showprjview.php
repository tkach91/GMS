<html>  
    <body> 
		<script type="text/javascript">
			$(document).ready(function() {
			$("#goals").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">
			<table>
				<tr><td><b>Название проекта:</b></td>
				<td> <? echo $prj_info->p_name; ?></td></tr>
				<tr><td><b>Описание проекта:</b></td>
				<td> <? echo $prj_info->p_descr; ?></td></tr>
				<tr><td><b>Статус проекта:</b></td>
				<td> <? 
						if ($prj_info->p_prj_status == 1)
							echo "завершён";
						else
							echo "в разработке";
					 ?>
				</td></tr>
				<tr><td><b>Последнее изменение проекта:</b></td>
				<td> <? echo $prj_info->p_changed; ?></td></tr>
				<tr><td><b>Deadline:</b></td>
				<td> <? echo $prj_info->p_finished; ?></td></tr>
			</table>
			<br></br>
			<table>
				<tr><td><b>Цели проекта</b></td></tr>
			</table>
			<table border='1' id='goals' class='tablesorter'>
				<thead><tr><th>Название</th><th>Описание</th><th>Статус цели</th></tr></thead>
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
				</td></tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
    </body>     
</html>  