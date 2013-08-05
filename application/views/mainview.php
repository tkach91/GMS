<html>
	<body>	
		<div class="content">
			<h2>Ваши данные:</h2>	
			<div class="uinfo">
				<b>- Вы вошли как:</b> <?php echo $info['login'];?><br/>
				<b>- Ваш статус:</b> <?php echo $info['usr_status'];?><br/>	
				<b>- Ваш ранг:</b> <?php echo $info['rank'];?><br/>
				<b>- Ваш уровень доступа:</b> <?php echo $info['access'];?><br/>	
				<b>- Окончание последнего сеанса:</b> <?php echo $info['last_logout'];?><br/><br/><br/>
			</div>
			<table>
			<tr><td><h2>Последние новости:</h2></td></tr>
			<?php $i = 0; foreach($news_list->result_array() as $row): 
				if ($i == 3)
					break;
				else
					$i++;
				?>
				<tr><td><? echo $row['n_head']?></td><td><? echo $row['u_name']?></td><td><? echo $row['n_publ']?></td></tr>
				<tr><td><? echo $row['n_sdescr']?></td></tr>
				<tr><td>Последнее изменение: <? echo $row['n_changed']?></td></tr>
				<tr><td><? echo  anchor('main/show_news/' . $row['n_id'], 'Подробнее'); ?></td></tr>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
	</body>
</html>