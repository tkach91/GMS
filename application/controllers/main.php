<?php
class Main extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// Загружаем модели, хелперы и библиотеки
		$str = "Система управления проектами"; 
		$title = iconv("CP1251", "UTF-8//IGNORE", $str);
		$str = "Главная"; 
		$heading = iconv("CP1251", "UTF-8//IGNORE", $str);
		$this->head = array('title'=>$title, 'heading'=>$heading); 
	}
	
	// Основная функция (с неё начинается вполнение контроллера)
	function index()
	{
		// Проверяем, вошёл ли пользователь
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			$data['info'] = $this->get_user_info();
			$data['news_list'] = $this->get_data_model->get_news();
			// Загрузка представлений
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('mainview', $data);
			$this->load->view('footer');
		}
	}
	
	// Выводим список групп в соответствие
	// с уровнем доступа пользователя
	function groups()
	{
		// Проверяем, вошёл ли пользователь
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// Получили данные по рангу
			$data['g_acs'] = $this->get_data_model->get_access_groups($this->session->userdata('access_id'));
			// И по рабочей группе
			$data['g_member'] = $this->get_data_model->get_all_groups($this->session->userdata('id'));
			// Загрузка представлений
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('groupsview', $data);
			$this->load->view('footer');
		}
	}
	
	// Выводим информацию о конкретной группе
	function show_grp($wg_id)
	{
		// Проверяем, вошёл ли пользователь
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// Проверяем, есть у пользователя доступ к группе с запрашиваемым id
			if ($this->get_data_model->chk_acs($this->session->userdata('access_id'), $wg_id) | ($this->get_data_model->isInWg($this->session->userdata('id'), $wg_id)))
			{
				$result = $this->get_data_model->get_groups($wg_id);
				$data['grp_info'] = $result->row();
				$data['grp_members'] = $this->get_data_model->get_all_grp_members($wg_id);
				$this->load->view('header', $this->head);
				$this->load->view('mainmview', $this->get_user_info());
				$this->load->view('showgrpview', $data);
				$this->load->view('footer');
			}
			// Исправить, критичный момент + индусский код для непосвящённых
			else
			{
				redirect('main');
			}
		}
	}
	
	// Выводим список проектов в соответствие
	// с уровнем доступа пользователя
	function projects()
	{
		// Проверяем, вошёл ли пользователь
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// Получаем проекты по рангу
			$data['p_list'] = $this->get_data_model->get_rank_projects($this->session->userdata('rank_id'));
			// И по рабочей группе
			$data['my_p_list'] = $this->get_data_model->get_all_projects($this->session->userdata('id'));
			// Загрузка представлений
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('projectsview', $data);
			$this->load->view('footer');
		}
	}
	
	// Выводим информацию о конкретном проекта
	function show_prj($p_id)
	{
		// Проверяем, вошёл ли пользователь
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// Проверяем, есть у пользователя доступ к проекту с запрашиваемым id
			// Сначала находим, какая рабочая группа работает над этим проектом
			/* Если над проектом работает более 1 группы, будет выбрана только первая, а остальным
			будет закрыт доступ, позднее исправить (!) */
			$result = $this->get_data_model->get_groups_projects($p_id);
			$row = $result->row();
			$wg_id = $row->gp_wg_id;
			if ($this->get_data_model->chk_rnk_acs($this->session->userdata('rank_id'), $p_id) | ($this->get_data_model->isInWg($this->session->userdata('id'), $wg_id)))
			{
				// Сначала получаем данные по рангу
				$result = $this->get_data_model->get_projects($p_id);
				$data['prj_info'] = $result->row();
				$data['prj_goals'] = $this->get_data_model->get_all_prj_goals($p_id);
				$this->load->view('header', $this->head);
				$this->load->view('mainmview', $this->get_user_info());
				$this->load->view('showprjview', $data);
				$this->load->view('footer');
			}
			// Исправить, критичный момент + индусский код для непосвящённых
			else
			{
				redirect('main');
			}
		}
	}
	
	// Список новостей
	function news()
	{
		// Проверяем, вошёл ли пользователь
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			$data['news_list'] = $this->get_data_model->get_news();
			// Загрузка представлений
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('newsview', $data);
			$this->load->view('footer');
		}
	}
	
	// Конкретная новость
	function show_news($id)
	{
		// Проверяем, вошёл ли пользователь
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			$data['news_list'] = $this->get_data_model->get_news($id);
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('shownewsview', $data);
			$this->load->view('footer');
		}
	}
}