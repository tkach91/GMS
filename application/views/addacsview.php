<html>  
    <body>   
		<div class="content">
        <? echo form_open('admin/add_access');?>     
			<table>
			<tr><td>Название уровня доступа:</td>
			<td><input type='text' name='aname' value='<? echo tag($name); ?>'</td></tr>
			<tr><td colspan='2' align='center'>
			<input type='submit' value='Добавить'</td></tr>
			</table>
			<input type='hidden' name='id' value='<? echo $id; ?>'>
        <? echo form_close(); ?> 
		</div>
	</div>		
    </body>     
</html>  