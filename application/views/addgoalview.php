<html>  
    <body>   
		<div class="content">
        <? echo form_open('admin/add_goal');?>     
			<table>
			<tr><td>Название цели</td>
			<td><input type='text' name='gname' value='<? echo tag($name) ?>'></td></tr>
			<tr><td>Описание цели:</td>
			<td><textarea name='gdescr' rows=4 cols=25><? echo tag($descr) ?></textarea></td></tr>
			<? if ($status == 1)
					echo "<tr><td><input type=checkbox name='finished' value='no' checked='yes'>Выполнено<br></td></tr>";
			   else
					echo "<tr><td><input type=checkbox name='finished' value='no'>Выполнено<br></td></tr>"; ?>
			<tr><td colspan='2' align='center'>
			<input type='submit' value='Добавить'</td></tr>
			</table>
			<input type='hidden' name='id' value='<? echo $id; ?>'>
        <? echo form_close(); ?>     
		</div>
	</div>
    </body>     
</html>  