<?php
if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class MY_Controller extends CI_Controller {

	private $head; 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('dec');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('get_data_model');
		$str = "Система управления проектами"; 
		$title = iconv("CP1251", "UTF-8//IGNORE", $str);
		$str = "Вход"; 
		$heading = iconv("CP1251", "UTF-8//IGNORE", $str);
		$this->head = array('title'=>$title, 'heading'=>$heading); 
	}
	
	// Вход
	function login()
    {
		// Пользователь уже вошёл
		if ($this->session->userdata('logon') === 'Yes')
		{
			redirect('main');
		}
		else
		{
			// Проверяем наличие пароля
			if ($this->input->post('password') != '')
			{	
				$data = $this->login_model->getLoginInfo($_POST['login']);
				$row = $data->row_array();
				// Проверяем корректность пароля и логина           
				if (sha1($this->input->post('password')) === $row['u_pass'])
					if ($this->input->post('login') === $row['u_name'])
					{
						// Записываем в сессию признак логона
						$session_data = array('logon'=>'Yes', 'id'=>$row['u_id'], 'login'=>$row['u_name'], 'rank_id'=>$row['u_rid'], 
											  'rank'=>$row['r_name'], 'access_id'=>$row['u_aid'], 'access'=>$row['a_name'], 
											  'last_logout'=>$row['u_last_logout'], 'usr_status'=>$row['u_adm_status']); 
						$this->session->set_userdata($session_data);
						redirect(''); // редирект на главную страницу
					}
			}
			$this->load->view('header', $this->head);
			$this->load->view('login');
			$this->load->view('footer');
		}
    }
	
	// Выход
	function logout()
    { 
		$this->login_model->setLogoutTime();
		$this->session->sess_destroy();  // обнуляем сессию
        redirect(''); // редирект на главную страницу
    }
	
	// Формируем общую информацию для пользователя
	function get_user_info()
	{
		$str = "не определён"; 
		$res = iconv("CP1251", "UTF-8//IGNORE", $str);
		$str = "отсутствует";
		$ll = iconv("CP1251", "UTF-8//IGNORE", $str);
		// id
		$info['id'] = $this->session->userdata('id');
		// Логин
		$info['login'] = $this->session->userdata('login');
		// Ранг
		$info['rank'] = $this->session->userdata('rank');
		!empty($info['rank']) ? $info['rank'] : $info['rank'] = $res;
		//Доступ	
		$info['access'] = $this->session->userdata('access');
		!empty($info['access']) ? $info['access'] : $info['access'] = $res;
		// Последний logout	
		$info['last_logout'] = $this->session->userdata('last_logout');
		!empty($info['last_logout']) ? $info['last_logout'] : $info['last_logout'] = $ll;
		// Статус: пользователь/админ
		$info['usr_status'] = $this->session->userdata('usr_status');
		
		return $info;
	}
}