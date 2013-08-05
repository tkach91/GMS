<html>
	<body>
	<div class="layout">	
		<div class="sidebar">
			<?php 
				echo '<div class="box">';
					echo '<h3>Главное меню</h3>';
					echo '<ul>';
						echo '<li>' . anchor('main', 'На главную') . '</li>';
						if (($usr_status === 'admin') | ($usr_status === 'grp_leader'))
							echo  '<li>' . anchor('admin', 'Администрирование') . '</li>';
						echo  '<li>' . anchor('main/groups', 'Просмотр групп') . '</li>';
						echo  '<li>' . anchor('main/projects', 'Просмотр проектов') . '</li>';
						echo  '<li>' . anchor('main/news', 'Все новости') . '</li>';
						echo  '<li>' . anchor('main/logout', 'Выход') . '</li>';
					echo '</ul>';
				echo '</div>';
			?>
		</div>
	</body>
</html>