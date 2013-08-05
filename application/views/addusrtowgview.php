<html>  
    <body>  
		<script type="text/javascript">
			$(document).ready(function() {
			$("#groups").tablesorter({sortList: [[0,1]]});
			});
		</script>	
		<div class="content">
		Сейчас Вы работаете с группой: <? echo tag($grp_name); ?>
		<table border='1' id='groups' class='tablesorter'>
			<thead>
			<tr>
				<th>Имя пользователя</th>
				<td>Действие</td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($added->result_array() as $row): ?>
				<tr>
					<? $tmp = $row['u_id']; $data["$tmp"] = $row['u_name']; ?>
					<td><? echo $row['u_name'];?></td>
					<td><? echo anchor('admin/change_uacs/del/' . $grp_id . '/' . $row['u_id'] . '/' . $grp_name, 'Удалить');?></td>
				</tr>
			<?php endforeach; ?>
				<?php foreach($toadd->result_array() as $row):
						$tmp = $row['u_id'];
						if (($row['gu_grp_id'] != $grp_id) & (empty($data["$tmp"])))
						{
							echo "<tr><td>" . $row['u_name'] . "</td><td>";
							echo anchor('admin/change_uacs/add/' . $grp_id . '/' . $row['u_id'] . '/' . $grp_name, 'Добавить') . "</td></tr>";
						}
					  endforeach; ?>
			<tbody>
		</table>
		</div>
	</div>
    </body>     
</html>