<html>  
    <body> 
		<div class="content">
		<table>
			<?php foreach($news_list->result_array() as $row): ?>
				<tr><td><? echo $row['n_head']?></td><td><? echo $row['u_name']?></td><td><? echo $row['n_publ']?></td></tr>
				<tr><td><? echo $row['n_sdescr']?></td></tr>
				<tr><td>Последнее изменение: <? echo $row['n_changed']?></td></tr>
				<tr><td><? echo  anchor('main/show_news/' . $row['n_id'], 'Подробнее'); ?></td></tr>
				<tr><td>--------------------------------------------------------------------------</td><tr>
			<?php endforeach; ?>
		</table>
		</div>
	</div>
    </body>     
</html>