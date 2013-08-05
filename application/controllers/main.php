<?php
class Main extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// ��������� ������, ������� � ����������
		$str = "������� ���������� ���������"; 
		$title = iconv("CP1251", "UTF-8//IGNORE", $str);
		$str = "�������"; 
		$heading = iconv("CP1251", "UTF-8//IGNORE", $str);
		$this->head = array('title'=>$title, 'heading'=>$heading); 
	}
	
	// �������� ������� (� �� ���������� ��������� �����������)
	function index()
	{
		// ���������, ����� �� ������������
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			$data['info'] = $this->get_user_info();
			$data['news_list'] = $this->get_data_model->get_news();
			// �������� �������������
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('mainview', $data);
			$this->load->view('footer');
		}
	}
	
	// ������� ������ ����� � ������������
	// � ������� ������� ������������
	function groups()
	{
		// ���������, ����� �� ������������
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// �������� ������ �� �����
			$data['g_acs'] = $this->get_data_model->get_access_groups($this->session->userdata('access_id'));
			// � �� ������� ������
			$data['g_member'] = $this->get_data_model->get_all_groups($this->session->userdata('id'));
			// �������� �������������
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('groupsview', $data);
			$this->load->view('footer');
		}
	}
	
	// ������� ���������� � ���������� ������
	function show_grp($wg_id)
	{
		// ���������, ����� �� ������������
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// ���������, ���� � ������������ ������ � ������ � ������������� id
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
			// ���������, ��������� ������ + ��������� ��� ��� �������������
			else
			{
				redirect('main');
			}
		}
	}
	
	// ������� ������ �������� � ������������
	// � ������� ������� ������������
	function projects()
	{
		// ���������, ����� �� ������������
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// �������� ������� �� �����
			$data['p_list'] = $this->get_data_model->get_rank_projects($this->session->userdata('rank_id'));
			// � �� ������� ������
			$data['my_p_list'] = $this->get_data_model->get_all_projects($this->session->userdata('id'));
			// �������� �������������
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('projectsview', $data);
			$this->load->view('footer');
		}
	}
	
	// ������� ���������� � ���������� �������
	function show_prj($p_id)
	{
		// ���������, ����� �� ������������
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			// ���������, ���� � ������������ ������ � ������� � ������������� id
			// ������� �������, ����� ������� ������ �������� ��� ���� ��������
			/* ���� ��� �������� �������� ����� 1 ������, ����� ������� ������ ������, � ���������
			����� ������ ������, ������� ��������� (!) */
			$result = $this->get_data_model->get_groups_projects($p_id);
			$row = $result->row();
			$wg_id = $row->gp_wg_id;
			if ($this->get_data_model->chk_rnk_acs($this->session->userdata('rank_id'), $p_id) | ($this->get_data_model->isInWg($this->session->userdata('id'), $wg_id)))
			{
				// ������� �������� ������ �� �����
				$result = $this->get_data_model->get_projects($p_id);
				$data['prj_info'] = $result->row();
				$data['prj_goals'] = $this->get_data_model->get_all_prj_goals($p_id);
				$this->load->view('header', $this->head);
				$this->load->view('mainmview', $this->get_user_info());
				$this->load->view('showprjview', $data);
				$this->load->view('footer');
			}
			// ���������, ��������� ������ + ��������� ��� ��� �������������
			else
			{
				redirect('main');
			}
		}
	}
	
	// ������ ��������
	function news()
	{
		// ���������, ����� �� ������������
		if ($this->session->userdata('logon') !== 'Yes') 
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
		else
		{
			$data['news_list'] = $this->get_data_model->get_news();
			// �������� �������������
			$this->load->view('header', $this->head);
			$this->load->view('mainmview', $this->get_user_info());
			$this->load->view('newsview', $data);
			$this->load->view('footer');
		}
	}
	
	// ���������� �������
	function show_news($id)
	{
		// ���������, ����� �� ������������
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