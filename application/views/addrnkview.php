<html>  
    <body>   
	<div class="content">
        <? echo form_open('admin/add_rank');?>     
			<table>
			<tr><td>Название ранга:</td>
			<td><input type='text' name='rname' value='<? echo tag($name); ?>'></td></tr>
			<tr><td colspan='2' align='center'>
			<input type='submit' value='Добавить'</td></tr>
			</table>
			<input type='hidden' name='id' value='<? echo $id; ?>'>
        <? echo form_close(); ?>    
		</div>
	</div>		
    </body>     
</html>  