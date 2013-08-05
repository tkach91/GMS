<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#groups").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">		
		Сейчас Вы работаете с уровнем доступа: <? echo tag($acs_name); ?>
		<table border='1' id='groups' class='tablesorter'>
			<thead>
			<tr>
				<th>Название группы</th>
				<td>Действие</td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($added->result_array() as $row): ?>
				<tr>
					<? $tmp = $row['wg_id']; $data["$tmp"] = $row['wg_name']; ?>
					<td><? echo $row['wg_name'];?></td>
					<td><? echo anchor('admin/change_acs/del/' . $acs_id . '/' . $row['wg_id'] . '/' . $acs_name, 'Удалить');?></td>
				</tr>
			<?php endforeach; ?>
				<?php $shown = array();
					  foreach($toadd->result_array() as $row):
						$tmp = $row['wg_id'];
						$tmp1 = $row['wg_name'];
						if (($row['ag_acs_id'] != $acs_id) & (empty($data["$tmp"]) & (empty($shown["$tmp1"]))))
						{
							echo "<tr><td>" . $row['wg_name'] . "</td><td>";
							echo anchor('admin/change_acs/add/' . $acs_id . '/' . $row['wg_id'] . '/' . $acs_name, 'Добавить') . "</td></tr>";
						}
						$shown["$tmp1"] = true;
					  endforeach; ?>
			</tbody>
		</table>
		</div>
	</div>
    </body>     
</html>