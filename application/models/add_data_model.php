<?php
class Add_data_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// ��������� ������������
	function insert_user($login, $pass, $rank, $access, $usr_status)
	{
		$arr = array('u_name'=>$login, 'u_pass'=>$pass, 'u_rid'=>$rank, 'u_aid'=>$access, 'u_adm_status'=>$usr_status);
		$this->db->insert('msys_users', $arr);
	}
	
	// ��������� ������������
	function update_user($id, $login, $rank, $access, $usr_status, $pass = '')
	{
		if ($pass === '')
			$arr = array('u_name'=>$login, 'u_rid'=>$rank, 'u_aid'=>$access, 'u_adm_status'=>$usr_status);
		else
			$arr = array('u_name'=>$login, 'u_pass'=>$pass, 'u_rid'=>$rank, 'u_aid'=>$access, 'u_adm_status'=>$usr_status);
		$this->db->where('u_id', $id);
		$this->db->update('msys_users', $arr);
	}
	
	// ��������� ������������ � ������� ������
	function insert_usr_wg($usr_id, $grp_id)
	{
		$arr = array('gu_usr_id'=>$usr_id, 'gu_grp_id'=>$grp_id);
		$this->db->insert('msys_groups_users', $arr);
	}
	
	// ������� ������������ �� ������� ������
	function delete_usr_wg($usr_id, $wg_id)
	{
		$this->db->delete('msys_groups_users', array('gu_usr_id'=>$usr_id, 'gu_grp_id'=>$wg_id));
	}
	
	// ������� ������������
	function drop_user($id)
	{
		// ������� ��� ������ � �������� ������������ � �������
		$this->db->delete('msys_groups_users', array('gu_usr_id'=>$id));
		// ������� ������ ������������
		$this->db->delete('msys_users', array('u_id'=>$id));
	}
	
	// ��������� ����
	function insert_rank($rname)
	{
		$arr = array('r_name'=>$rname);
		$this->db->insert('msys_ranks', $arr);
	}
	
	// ��������� ����
	function update_rank($id, $rname)
	{
		$arr = array('r_name'=>$rname);
		$this->db->where('r_id', $id);
		$this->db->update('msys_ranks', $arr);
	}
	
	// �������� ������� ������� � ������
	function insert_rank_prj($rnk_id, $p_id)
	{
		$arr = array('pr_rnk_id'=>$rnk_id, 'pr_prj_id'=>$p_id);
		$this->db->insert('msys_projects_ranks', $arr);
	}
	
	// ������� ������ � ������� ������
	function delete_rank_prj($rnk_id, $p_id)
	{
		$this->db->delete('msys_projects_ranks', array('pr_rnk_id'=>$rnk_id, 'pr_prj_id'=>$p_id));
	}
	
	// ������� ����
	function drop_rank($id)
	{
		// ������� ��� ����� ����-������
		$this->db->delete('msys_projects_ranks', array('pr_rnk_id'=>$id));
		// ���������� ���� ������������� � ������ ������ NULL � ���� �����
		$this->db->where('u_rid', $id);
		$this->db->update('msys_users', array('u_rid'=>NULL));
		// ������ ������� ����
		$this->db->delete('msys_ranks', array('r_id'=>$id));
	}
	
	// ��������� ������� �������
	function insert_access($aname)
	{
		$arr = array('a_name'=>$aname);
		$this->db->insert('msys_accesses', $arr);
	}
	
	// ��������� ������� �������
	function update_access($id, $aname)
	{
		$arr = array('a_name'=>$aname);
		$this->db->where('a_id', $id);
		$this->db->update('msys_accesses', $arr);
	}
	
	// �������� ������� ������� � ������
	function insert_access_wg($acs_id, $wg_id)
	{
		$arr = array('ag_acs_id'=>$acs_id, 'ag_wg_id'=>$wg_id);
		$this->db->insert('msys_accesses_groups', $arr);
	}
	
	// ������� ������ � ������� ������
	function delete_access_wg($acs_id, $wg_id)
	{
		$this->db->delete('msys_accesses_groups', array('ag_acs_id'=>$acs_id, 'ag_wg_id'=>$wg_id));
	}
	
	// ������� ������� �������
	function drop_access($id)
	{
		// ������� ��� ����� ������-������
		$this->db->delete('msys_accesses_groups', array('ag_acs_id'=>$id));
		// ���������� ���� ������������� � ������ ������ ������� NULL � ���� ������ �������
		$this->db->where('u_aid', $id);
		$this->db->update('msys_users', array('u_aid'=>NULL));
		// ������ ������� ������� �������
		$this->db->delete('msys_accesses', array('a_id'=>$id));
	}
	
	// �������� ������ � �������
	function insert_group_prj($wg_id, $p_id)
	{
		$arr = array('gp_wg_id'=>$wg_id, 'gp_prj_id'=>$p_id);
		$this->db->insert('msys_groups_projects', $arr);
	}
	
	// ��������� ������� ������ �� �������
	function delete_group_prj($wg_id, $p_id)
	{
		$this->db->delete('msys_groups_projects', array('gp_wg_id'=>$wg_id, 'gp_prj_id'=>$p_id));
	}
	
	// ��������� ������
	function insert_project($pname, $pdescr, $pstatus, $pdate)
	{
		$arr = array('p_name'=>$pname, 'p_descr'=>$pdescr, 'p_prj_status'=>$pstatus, 'p_changed'=>date('Y-m-d H:i:s'), 'p_finished'=>$pdate);
		$this->db->insert('msys_projects', $arr);
		return mysql_insert_id();
	}
	
	// ��������� ������
	function update_project($pid, $pname, $pdescr, $pdate, $pstatus)
	{
		$arr = array('p_name'=>$pname, 'p_descr'=>$pdescr, 'p_prj_status'=>$pstatus, 'p_changed'=>date('Y-m-d H:i:s'), 'p_finished'=>$pdate);
		$this->db->where('p_id', $pid);
		$this->db->update('msys_projects', $arr);
	}
	
	// ������� ������
	function drop_project($id)
	{
		// ������� ����� ������� ������-������
		$this->db->delete('msys_groups_projects', array('gp_prj_id'=>$id));
		// ������� ��� ����� ����-������
		$this->db->delete('msys_projects_ranks', array('pr_prj_id'=>$id));
		// ������� ��� ���� �������
		$this->db->delete('msys_goals', array('g_prj_id'=>$id));
		// ������� ��� ������
		$this->db->delete('msys_projects', array('p_id'=>$id));
	}
	
	// ��������� ���� � �������
	function insert_goal($gname, $gdescr, $gstatus, $g_prj_id)
	{
		$arr = array('g_name'=>$gname, 'g_descr'=>$gdescr, 'g_status'=>$gstatus, 'g_prj_id'=>$g_prj_id);
		$this->db->insert('msys_goals', $arr);
	}
	
	// ��������� ����
	function update_goal($gid, $gname, $gdescr, $gstatus)
	{
		$arr = array('g_name'=>$gname, 'g_descr'=>$gdescr, 'g_status'=>$gstatus);
		$this->db->where('g_id', $gid);
		$this->db->update('msys_goals', $arr);
	}
	
	// ������� ����
	function drop_goal($id)
	{
		$this->db->delete('msys_goals', array('g_id'=>$id));
	}

	// ��������� ������	
	function insert_group($gname, $g_lead_id, $descr, $progress)
	{
		$arr = array('wg_name'=>$gname, 'wg_boss_id'=>$g_lead_id, 'wg_grp_descr'=>$descr, 'wg_progress'=>$progress);
		$this->db->insert('msys_groups', $arr);
	}
	
	// ��������� ������	
	function update_group($id, $gname, $g_lead_id, $descr, $progress)
	{
		$arr = array('wg_name'=>$gname, 'wg_boss_id'=>$g_lead_id, 'wg_grp_descr'=>$descr, 'wg_progress'=>$progress);
		$this->db->where('wg_id', $id);
		$this->db->update('msys_groups', $arr);
	}
	
	// ������� ������
	function drop_workgroup($id)
	{
		// ������� ����� ������� ������-������
		$this->db->delete('msys_groups_projects', array('gp_wg_id'=>$id));
		// ������� ����� ������� ������-������� �������
		$this->db->delete('msys_accesses_groups', array('ag_wg_id'=>$id));
		// ������� ���� ������
		$this->db->delete('msys_groups', array('wg_id'=>$id));
	}
	
	// ��������� �������
	function insert_news($head, $sdescr, $descr, $author)
	{
		$arr = array('n_head'=>$head, 'n_sdescr'=>$sdescr, 'n_descr'=>$descr, 'n_author'=>$author, 
					 'n_changed_by'=>$author, 'n_publ'=>date('Y-m-d H:i:s'), 'n_changed'=>date('Y-m-d H:i:s'));
		$this->db->insert('msys_news', $arr);
	}
	
	// ��������� �������
	function update_news($id, $head, $sdescr, $descr, $author)
	{
		$arr = array('n_head'=>$head, 'n_sdescr'=>$sdescr, 'n_descr'=>$descr, 
					 'n_changed_by'=>$author, 'n_changed'=>date('Y-m-d H:i:s'));
		$this->db->where('n_id', $id);
		$this->db->update('msys_news', $arr);
	}
	
	// ������� �������
	function drop_news($id)
	{
		$this->db->delete('msys_news', array('n_id'=>$id));
	}
}