<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#projects").tablesorter({sortList: [[0,1]]});
			});
		</script>
	<div class="content">
		Сейчас Вы работаете с группой: <? echo tag($wg_name); ?>
		<table border='1' id='projects' class='tablesorter'>
			<thead>
			<tr>
				<th>Название проекта</th>
				<td>Действие</td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($added->result_array() as $row): ?>
				<tr>
					<? $tmp = $row['p_id']; $data["$tmp"] = $row['p_name']; ?>
					<td><? echo $row['p_name'];?></td>
					<td><? echo anchor('admin/change_wg/del/' . $wg_id . '/' . $row['p_id'] . '/' . $wg_name, 'Удалить');?></td>
				</tr>
			<?php endforeach; ?>
				<?php $shown = array();
					  foreach($toadd->result_array() as $row):
						$tmp = $row['p_id'];
						$tmp1 = $row['p_name'];
						if ((empty($data["$tmp"]) & (empty($shown["$tmp1"]))))
						{
							echo "<tr><td>" . $row['p_name'] . "</td><td>";
							echo anchor('admin/change_wg/add/' . $wg_id . '/' . $row['p_id'] . '/' . $wg_name, 'Добавить') . "</td></tr>";
						}
						$shown["$tmp1"] = true;
					  endforeach; ?>
			</tbody>
		</table>
		</div>
	</div>
    </body>     
</html>