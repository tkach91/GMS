<?php
if (!defined('BASEPATH')) exit('��� ������� � �������'); 

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
		$str = "������� ���������� ���������"; 
		$title = iconv("CP1251", "UTF-8//IGNORE", $str);
		$str = "����"; 
		$heading = iconv("CP1251", "UTF-8//IGNORE", $str);
		$this->head = array('title'=>$title, 'heading'=>$heading); 
	}
	
	// ����
	function login()
    {
		// ������������ ��� �����
		if ($this->session->userdata('logon') === 'Yes')
		{
			redirect('main');
		}
		else
		{
			// ��������� ������� ������
			if ($this->input->post('password') != '')
			{	
				$data = $this->login_model->getLoginInfo($_POST['login']);
				$row = $data->row_array();
				// ��������� ������������ ������ � ������           
				if (sha1($this->input->post('password')) === $row['u_pass'])
					if ($this->input->post('login') === $row['u_name'])
					{
						// ���������� � ������ ������� ������
						$session_data = array('logon'=>'Yes', 'id'=>$row['u_id'], 'login'=>$row['u_name'], 'rank_id'=>$row['u_rid'], 
											  'rank'=>$row['r_name'], 'access_id'=>$row['u_aid'], 'access'=>$row['a_name'], 
											  'last_logout'=>$row['u_last_logout'], 'usr_status'=>$row['u_adm_status']); 
						$this->session->set_userdata($session_data);
						redirect(''); // �������� �� ������� ��������
					}
			}
			$this->load->view('header', $this->head);
			$this->load->view('login');
			$this->load->view('footer');
		}
    }
	
	// �����
	function logout()
    { 
		$this->login_model->setLogoutTime();
		$this->session->sess_destroy();  // �������� ������
        redirect(''); // �������� �� ������� ��������
    }
	
	// ��������� ����� ���������� ��� ������������
	function get_user_info()
	{
		$str = "�� ��������"; 
		$res = iconv("CP1251", "UTF-8//IGNORE", $str);
		$str = "�����������";
		$ll = iconv("CP1251", "UTF-8//IGNORE", $str);
		// id
		$info['id'] = $this->session->userdata('id');
		// �����
		$info['login'] = $this->session->userdata('login');
		// ����
		$info['rank'] = $this->session->userdata('rank');
		!empty($info['rank']) ? $info['rank'] : $info['rank'] = $res;
		//������	
		$info['access'] = $this->session->userdata('access');
		!empty($info['access']) ? $info['access'] : $info['access'] = $res;
		// ��������� logout	
		$info['last_logout'] = $this->session->userdata('last_logout');
		!empty($info['last_logout']) ? $info['last_logout'] : $info['last_logout'] = $ll;
		// ������: ������������/�����
		$info['usr_status'] = $this->session->userdata('usr_status');
		
		return $info;
	}
}