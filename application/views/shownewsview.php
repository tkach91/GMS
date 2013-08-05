<html>  
    <body> 
		<div class="content">
		<table>
			<? $row = $news_list->row_array(); ?>
			<tr><td><? echo $row['n_head']?></td><td><? echo $row['u_name']?></td><td><? echo $row['n_publ']?></td></tr>
			<tr><td><? echo $row['n_descr']?></td></tr>
			<tr><td>Последнее изменение: <? echo $row['n_changed']?></td></tr>
		</table>
		</div>
	</div>
    </body>     
</html>