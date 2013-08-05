<html>  
    <body>
		<div class="content">
        <? echo form_open('admin/add_news');?>     
			<table>
				<tr><td>Заголовок статьи:</td>
				<td><input type='input' name='head' value='<? echo tag($info['n_head']) ?>'></td></tr>
				<tr><td>Краткое описание:</td>
				<td><textarea name='sdescr' rows=5 cols=51><? echo tag($info['n_sdescr']); ?></textarea></td></tr>
				<tr><td>Полный текст новости:</td>
				<td><textarea name='descr' rows=5 cols=51><? echo tag($info['n_descr']); ?></textarea></td></tr>
				<tr><td colspan='2' align='center'>
				<input type='submit' value='Далее'</td></tr>
			</table>
			<input type='hidden' name='id' value='<? echo $info['n_id']; ?>'>
			<input type='hidden' name='author' value='<? echo $info['n_author']; ?>'>
        <? echo form_close(); ?>   
		</div>
	</div>		
    </body>     
</html>   