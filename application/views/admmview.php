<html>
	<body>
	<div class="layout">	
		<div class="sidebar">
		<script type="text/javascript">
				$(document).ready(function(){
				$("ul").hide();
				$("ul li:odd").css("background-color", "#efefef");
				$("h3 span").click(function(){
					$(this).parent().next().slideToggle();
				});
			});
		</script>
				<?php 
					echo '<h2>Меню администратора</h2>';
					echo '<div class="box">';
						echo '<h3>Навигация<span class="expand">+</span></h3>';
						echo '<ul>';
							echo '<li>' . anchor('main', 'На главную') . '</li>';
							echo '<li>' . anchor('admin', 'Администрирование') . '</li>';
							echo '<li>' . anchor('main/logout', 'Выход') . '</li>';
						echo '</ul>';
					echo '</div>';
					if ($usr_status === 'admin')
					{
						echo '<div class="box">';
							echo '<h3>Управление пользователями<span class="expand">+</span></h3>';
							echo '<ul>';
								echo '<li>' . anchor('admin/add_user', 'Добавить пользователя') . '</li>';
								echo '<li>' . anchor('admin/list_users', 'Просмотреть пользователей') . '</li>';
							echo '</ul>';
						echo '</div>';
						
						echo '<div class="box">';
							echo '<h3>Управление рангами<span class="expand">+</span></h3>';
							echo '<ul>';	
								echo '<li>' . anchor('admin/add_rank', 'Добавить ранг') . '</li>';
								echo '<li>' . anchor('admin/list_ranks', 'Просмотреть ранги') . '</li>';
							echo '</ul>';
						echo '</div>';
						
						echo '<div class="box">';
							echo '<h3>Управление уровнями доступа<span class="expand">+</span></h3>';
							echo '<ul>';
								echo '<li>' . anchor('admin/add_access', 'Добавить уровень доступа') . '</li>';
								echo '<li>' . anchor('admin/list_access', 'Просмотреть уровни доступа') . '</li>';
							echo '</ul>';
						echo '</div>';							
							
						echo '<div class="box">';
							echo '<h3>Управление группами<span class="expand">+</span></h3>';
							echo '<ul>';
								echo '<li>' . anchor('admin/add_group', 'Добавить группу') . '</li>';
								echo '<li>' . anchor('admin/list_groups', 'Просмотреть рабочие группы') . '</li>';
							echo '</ul>';
						echo '</div>';	
						
						echo '<div class="box">';
							echo '<h3>Управление проектами<span class="expand">+</span></h3>';
							echo '<ul>';
								echo '<li>' . anchor('admin/add_project', 'Добавить проект') . '</li>';
								echo '<li>' . anchor('admin/list_projects', 'Просмотреть проекты') . '</li>';	
							echo '</ul>';
						echo '</div>';	
						
						echo '<div class="box">';
							echo '<h3>Управление новостями<span class="expand">+</span></h3>';
							echo '<ul>';
								echo '<li>' . anchor('admin/add_news', 'Добавить новость') . '</li>';
								echo '<li>' . anchor('admin/list_news', 'Просмотреть новости') . '</li>';	
							echo '</ul>';	
						echo '</div>';	
					}
					elseif (($usr_status === 'grp_leader'))
					{
						echo '<div class="box">';
							echo '<h3>Управление проектами<span class="expand">+</span></h3>';
							echo '<ul>';
								echo '<li>' . anchor('admin/list_projects', 'Просмотреть проекты') . '</li>';
							echo '</ul>';
						echo '</div>';
					}
				?>
		</div>
	</body>
</html>