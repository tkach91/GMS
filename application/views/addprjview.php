<html>  
    <body>   
		<div class="content">
        <? echo form_open('admin/add_project');?>     
			<table>
			<tr><td>Название проекта</td>
			<td><input type='text' name='pname' value='<? echo tag($name) ?>'></td></tr>
			<tr><td>Описание проекта:</td>
			<td><textarea name='descr' rows=4 cols=25><? echo tag($descr) ?></textarea></td></tr>
			<tr><td>Deadline</td>
			<td><input type='text' name='deadline' class='datepicker' value='<? echo tag($deadline) ?>'></td></tr>
			<? if ($status == 1)
					echo "<tr><td><input type=checkbox name='finished' value='no' checked='yes'>Проект завершён<br></td></tr>";
			   else
					echo "<tr><td><input type=checkbox name='finished' value='no'>Проект завершён<br></td></tr>"; ?>
			<tr><td colspan='2' align='center'>
			<input type='submit' value='Добавить'</td></tr>
			</table>
			<input type='hidden' name='id' value='<? echo $id ?>'>
        <? echo form_close(); ?> 
		</div>
	</div>		
    </body>     
</html>  