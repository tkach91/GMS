<?php
class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('add_data_model');
		$str = "������� ���������� ���������"; 
		$title = iconv("CP1251", "UTF-8//IGNORE", $str);
		$str = "�����������������"; 
		$heading = iconv("CP1251", "UTF-8//IGNORE", $str);
		$this->head = array('title'=>$title, 'heading'=>$heading); 
	}
	
	// �������� ������� (� �� ���������� ��������� �����������)
	function index()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ��������������� ��� ������� ������
		if (($this->session->userdata('logon') === 'Yes') & (($this->session->userdata('usr_status') === 'admin') 
															| ($this->session->userdata('usr_status') === 'grp_leader'))) 
		{
			$data['info'] = $this->get_user_info();
			$data['news_list'] = $this->get_data_model->get_news();
			// �������� �������������
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('mainview', $data);
			$this->load->view('footer');
			
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	/******************************************************************������������*******************************************************************/
	// ��������� ������������
	function add_user()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($this->input->post('username') != '')
			{
				if ($this->input->post('id') != '')
					if ($this->input->post('pass') === '')
						$this->add_data_model->update_user($this->input->post('id'), $this->input->post('username'), $this->input->post('rank'),
										$this->input->post('access'), $this->input->post('perm'));
					else
						$this->add_data_model->update_user($this->input->post('id'), $this->input->post('username'), $this->input->post('rank'),
										$this->input->post('access'), $this->input->post('perm'), sha1($this->input->post('pass')));
				else
					$this->add_data_model->insert_user($this->input->post('username'), sha1($this->input->post('pass')), $this->input->post('rank'),
									$this->input->post('access'), $this->input->post('perm'));
				redirect('admin/list_users');				   
			}
			else
			{
				$result = $this->get_data_model->get_ranks();
				$data['ranks'] = $result;
				$result = $this->get_data_model->get_accesses();
				$data['accesses'] = $result;
				$data['info'] = array ('id'=>'', 'name'=>'');
				
				$this->load->view('header', $this->head);
				$this->load->view('admmview', $this->get_user_info());
				$this->load->view('addusrview', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	function call_edt_usr_view($id, $name, $rid, $aid, $adm)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$data['info'] = array('id'=>$id, 'name'=>$name, 'rid'=>$rid, 'aid'=>$aid, 'adm'=>$adm);
			$result = $this->get_data_model->get_ranks();
			$data['ranks'] = $result;
			$result = $this->get_data_model->get_accesses();
			$data['accesses'] = $result;
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addusrview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ���������� ������������ � ������� ������
	// �������� ������ ���������� ������������ � ��
	function call_add_usr_to_wg($id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$data['grp_id'] = $id;
			$data['grp_name'] = $name;
			$data['added'] = $this->get_data_model->get_user_groups($id);
			$data['toadd'] = $this->get_data_model->get_all_users_for_add();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addusrtowgview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	function change_uacs($act, $wg_id, $usr_id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($act === 'del')
				$this->add_data_model->delete_usr_wg($usr_id, $wg_id);
			elseif ($act === 'add')
				$this->add_data_model->insert_usr_wg($usr_id, $wg_id);
			redirect('admin/call_add_usr_to_wg/' . $wg_id . '/' . $name);
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ������� ���� �������������
	function list_users()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$result = $this->get_data_model->get_users();
			$data['u_list'] = $result;
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listusrview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	/**********************************************************************�����**********************************************************************/
	// ��������� ����
	function add_rank()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($this->input->post('rname') != '')
			{
				if ($this->input->post('id') != '')
					$this->add_data_model->update_rank($this->input->post('id'), $this->input->post('rname'));
				else
					$this->add_data_model->insert_rank($this->input->post('rname'));
				redirect('admin/list_ranks');				   
			}
			else
			{	
				$data = array('id'=>'', 'name'=>'');
				$this->load->view('header', $this->head);
				$this->load->view('admmview', $this->get_user_info());
				$this->load->view('addrnkview', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ������ �������� ��� ���������� ����� �������
	function list_prj_to_add($id)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$data['id'] = $id;
			$data['to_del'] = get_rank_projects($id);
			$data['all'] = get_projects();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('list_p_to_add_view', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������� ������ ��� ���������� �����
	function call_update_rank_view($rnk_id)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$result = $this->get_data_model->get_ranks($rnk_id);
			$row = $result->row();
			$data = array('id'=>$rnk_id, 'name'=>$row->r_name);
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addrnkview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ������� ��� �����
	function list_ranks()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ��������������� 
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$result = $this->get_data_model->get_ranks();
			$data['r_list'] = $result;
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listrnkview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������� ������ ���������� ����� � �������
	function call_add_rnk_to_prj($id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$data['rnk_id'] = $id;
			$data['rnk_name'] = $name;
			$data['added'] = $this->get_data_model->get_projects_ranks($id);
			$data['toadd'] = $this->get_data_model->get_all_projects();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addrnktoprjview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ����������/�������� ����� � �������
	function change_rnk($act, $rnk_id, $p_id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($act === 'del')
				$this->add_data_model->delete_rank_prj($rnk_id, $p_id);
			elseif ($act === 'add')
				$this->add_data_model->insert_rank_prj($rnk_id, $p_id);
			redirect('admin/call_add_rnk_to_prj/' . $rnk_id . '/' . $name);
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	/***************************************************************������ �������****************************************************************/
	// ��������� ������� �������
	function add_access()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($this->input->post('aname') != '')
			{
				if ($this->input->post('id') !== '')
					$this->add_data_model->update_access($this->input->post('id'), $this->input->post('aname'));
				else
					$this->add_data_model->insert_access($this->input->post('aname'));
				redirect('admin/list_access');				   
			}
			else
			{	$data = array('id'=>'', 'name'=>'');
				$this->load->view('header', $this->head);
				$this->load->view('admmview', $this->get_user_info());
				$this->load->view('addacsview', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������� ������ ��� ���������� ������ �������
	function call_update_access_view($acs_id)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$result = $this->get_data_model->get_accesses($acs_id);
			$row = $result->row();
			$data = array('id'=>$acs_id, 'name'=>$row->a_name);
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addacsview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ������� ��� ������ �������
	function list_access()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$result = $this->get_data_model->get_accesses();
			$data['a_list'] = $result;
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listacsview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������� ������ ���������� �� � ��
	function call_add_acs_to_wg($id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$data['acs_id'] = $id;
			$data['acs_name'] = $name;
			$data['added'] = $this->get_data_model->get_access_groups($id);
			$data['toadd'] = $this->get_data_model->get_all_groups();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addacstowgview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ����������/�������� ������ ������� � ������
	function change_acs($act, $acs_id, $wg_id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($act === 'del')
				$this->add_data_model->delete_access_wg($acs_id, $wg_id);
			elseif ($act === 'add')
				$this->add_data_model->insert_access_wg($acs_id, $wg_id);
			redirect('admin/call_add_acs_to_wg/' . $acs_id . '/' . $name);
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	/*******************************************************************�������*******************************************************************/
	// ��������� ������
	function add_project()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($this->input->post('pname') != '')
			{
				if ($this->input->post('id') != '')
				{
					if ($this->input->post('finished'))
						$finished = 1;
					else
						$finished = 0;
					$this->add_data_model->update_project($this->input->post('id'), $this->input->post('pname'), $this->input->post('descr'), $this->input->post('deadline'), $finished);
					redirect('admin/list_projects');				   
				}
				else
				{	
					if ($this->input->post('finished'))
						$finished = 1;
					else
						$finished = 0;
					$prj_id = $this->add_data_model->insert_project($this->input->post('pname'), $this->input->post('descr'), $this->input->post('deadline'), $finished);
					redirect('admin/call_add_goal_view/' . $prj_id);	
				}
			}
			else
			{	
				$data = array('id'=>'', 'name'=>'', 'descr'=>'', 'status'=>'', 'date'=>'', 'deadline'=>'');
				$this->load->view('header', $this->head);
				$this->load->view('admmview', $this->get_user_info());
				$this->load->view('addprjview', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ��������� ������
	function call_update_prjs_view($prj_id)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$result = $this->get_data_model->get_projects($prj_id);
			$row = $result->row();
			$data = array('id'=>$prj_id, 'name'=>$row->p_name, 'descr'=>$row->p_descr, 'status'=>$row->p_prj_status, 'deadline'=>$row->p_finished);
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addprjview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ������� ��� �������
	function list_projects()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ��������������� ��� ������� ������
		if (($this->session->userdata('logon') === 'Yes') & (($this->session->userdata('usr_status') === 'admin') | ($this->session->userdata('usr_status') === 'grp_leader'))) 
		{
			// ����� �������� ����� id ������ ������ � id ������������
			if ($this->session->userdata('usr_status') === 'grp_leader')
				$result = $this->get_data_model->get_all_projects($this->session->userdata('id'));
			else
				$result = $this->get_data_model->get_projects();
			$data['p_list'] = $result;
			$data['info'] = $this->get_user_info();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listprjview', $data);
			$this->load->view('footer');
		}
		elseif (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'grp_leader'))
		{
			$data['p_list'] = $result;
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listprjview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������� ������ ��� ���������� ����
	function call_add_goal_view($prj_id)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ��������������� ��� ������� ������
		if (($this->session->userdata('logon') === 'Yes') & (($this->session->userdata('usr_status') === 'admin') | ($this->session->userdata('usr_status') === 'grp_leader')))
		{
			$data = array('id'=>$prj_id, 'name'=>'', 'descr'=>'', 'status'=>'');
			$data['prj_id'] = $prj_id;
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addgoalview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ��������� ���� � �������
	function add_goal()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & (($this->session->userdata('usr_status') === 'admin') | ($this->session->userdata('usr_status') === 'grp_leader'))) 
		{
			if ($this->input->post('gname') != '')
			{
				if ($this->input->post('id') != '')
				{
					if ($this->input->post('finished'))
						$finished = 1;
					else
						$finished = 0;
					$this->add_data_model->update_goal($this->input->post('id'), $this->input->post('gname'), $this->input->post('gdescr'), $finished);
					redirect('admin/list_projects');				   
				}
				else
				{	
					if ($this->input->post('finished'))
						$finished = 1;
					else
						$finished = 0;
					$this->add_data_model->insert_goal($this->input->post('gname'), $this->input->post('gdescr'), 
													   $finished, $this->input->post('id'));
					redirect('admin/list_projects');	
				}
			}
			else
			{	
				$data = array('id'=>'', 'name'=>'', 'descr'=>'', 'status'=>'');
				$this->load->view('header', $this->head);
				$this->load->view('admmview', $this->get_user_info());
				$this->load->view('addprjview', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ���������� ���� ��� ��������������
	function show_goals($p_id)
	{
		if (($this->session->userdata('logon') === 'Yes') & (($this->session->userdata('usr_status') === 'admin') | ($this->session->userdata('usr_status') === 'grp_leader'))) 
		{
			$data['prj_goals'] = $this->get_data_model->get_all_prj_goals($p_id);
			$data['info'] = $this->get_user_info();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listgoalsview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������������� ����
	function call_update_goals_view($goal_id)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & (($this->session->userdata('usr_status') === 'admin') | ($this->session->userdata('usr_status') === 'grp_leader'))) 
		{
			$result = $this->get_data_model->get_goals($goal_id);
			$row = $result->row();
			$data = array('id'=>$goal_id, 'name'=>$row->g_name, 'descr'=>$row->g_descr, 'status'=>$row->g_status);
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addgoalview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}

	/*******************************************************************������********************************************************************/
	// ��������� ������
	function add_group()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($this->input->post('gname') != '')
			{
				if ($this->input->post('id') != '')
					$this->add_data_model->update_group($this->input->post('id'), $this->input->post('gname'), $this->input->post('grp_leader'), 
														$this->input->post('descr'), $this->input->post('progress'));
				else
					$this->add_data_model->insert_group($this->input->post('gname'), $this->input->post('grp_leader'), 
														$this->input->post('descr'), $this->input->post('progress'));
				redirect('admin/list_groups');				   
			}
			else
			{	
				$grp_l = $this->get_data_model->get_grp_leaders();
				$data['grps'] = $grp_l;
				$data['info'] = array('id'=>'', 'name'=>'', 'descr'=>'', 'progr'=>'');
				$this->load->view('header', $this->head);
				$this->load->view('admmview', $this->get_user_info());
				$this->load->view('addgrpview', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ���������� ������ ��� �������������� ������
	function call_edt_grp_view($id, $name, $bid, $descr, $progress)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$grp_l = $this->get_data_model->get_grp_leaders();
			$data['grps'] = $grp_l;
			$data['info'] = array('id'=>$id, 'name'=>$name, 'bid'=>$bid, 'descr'=>$descr, 'progr'=>$progress);
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addgrpview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ������� ��� ������
	function list_groups()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$result = $this->get_data_model->get_groups();
			$data['g_list'] = $result;
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listgrpview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������� ������ ���������� ������� ������ � �������
	function call_add_workgroup_to_prj($id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$data['wg_id'] = $id;
			$data['wg_name'] = $name;
			$data['added'] = $this->get_data_model->get_projects_groups($id);
			$data['toadd'] = $this->get_data_model->get_all_projects();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addgrptoprjview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ����������/�������� ������� ������ � �������
	function change_wg($act, $wg_id, $prj_id, $name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($act === 'del')
				$this->add_data_model->delete_group_prj($wg_id, $prj_id);
			elseif ($act === 'add')
				$this->add_data_model->insert_group_prj($wg_id, $prj_id);
			redirect('admin/call_add_workgroup_to_prj/' . $wg_id . '/' . $name);
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	/*************************************************************************************************************************************************/
	
	// ��������
	function drop_rec($id, $tb_name)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if ($tb_name === 'usr')
				$this->add_data_model->drop_user($id);
			elseif ($tb_name === 'rnk')
				$this->add_data_model->drop_rank($id);
			elseif ($tb_name === 'acs')
				$this->add_data_model->drop_access($id);
			elseif ($tb_name === 'prj')
				$this->add_data_model->drop_project($id);
			elseif ($tb_name === 'grp')
				$this->add_data_model->drop_workgroup($id);
			elseif ($tb_name === 'new')
				$this->add_data_model->drop_news($id);
			elseif ($tb_name === 'goal')
			{
				$this->add_data_model->drop_goal($id);
				redirect('admin/list_projects');
			}
				
			redirect('admin');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	/*********************************************************************�������*********************************************************************/
	
	// ���������� ������� 
	function add_news()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			if (($this->input->post('head') != '') && ($this->input->post('sdescr') != '') && ($this->input->post('descr') != ''))
			{
				if ($this->input->post('id') != '')
					$this->add_data_model->update_news($this->input->post('id'), $this->input->post('head'), $this->input->post('sdescr'), $this->input->post('descr'),
													   $this->input->post('author'));
				else
					$this->add_data_model->insert_news($this->input->post('head'), $this->input->post('sdescr'), $this->input->post('descr'),
													   $this->input->post('author'));
				redirect('admin/list_news');				   
			}
			else
			{	
				$tmp = $this->get_user_info();
				$data['info'] = array('n_id'=>'', 'n_head'=>'', 'n_sdescr'=>'', 'n_descr'=>'', 'n_author'=>$tmp['id']);
				$this->load->view('header', $this->head);
				$this->load->view('admmview', $this->get_user_info());
				$this->load->view('addnewsview', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// �������� ������ ��� �������������� �������
	function call_edt_news_view($id)
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			// �������� ���� � ������������� �������
			$tmp = $this->get_data_model->get_news($id);
			$data['info'] = $tmp->row_array();
			// �������� ���� � ������������
			$data['usr_info'] = $this->get_user_info();
			// � ������ ���������� ��, ��� ��� ����� �� ������
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('addnewsview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	// ������ ��������
	function list_news()
	{
		// ���������, ����� �� ������������ � �������� �� ��
		// ���������������
		if (($this->session->userdata('logon') === 'Yes') & ($this->session->userdata('usr_status') === 'admin')) 
		{
			$data['news_list'] = $this->get_data_model->get_news();
			$this->load->view('header', $this->head);
			$this->load->view('admmview', $this->get_user_info());
			$this->load->view('listnewsview', $data);
			$this->load->view('footer');
		}
		else
		{
			$data['logon'] = $this->session->userdata('logon');
			redirect('main/login');
		}
	}
	
	/*************************************************************************************************************************************************/
}