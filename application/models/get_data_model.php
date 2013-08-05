<?php
class Get_data_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// Выбрать первые 5 проектов, над которыми работает пользователь
	// претерпевшие изменение с момента последнего выхода из
	// системы
	function get_last_changes($id)
	{
	}
	
	// Выбрать всех пользователей, состоящих в группе
	function get_user_groups($id)
	{
		$this->db->join('msys_groups_users', 'msys_groups_users.gu_usr_id=msys_users.u_id', 'left');
		$this->db->join('msys_groups', 'msys_groups.wg_id=msys_groups_users.gu_grp_id', 'left');
		$this->db->where('msys_groups_users.gu_grp_id', $id);
		return $this->db->get('msys_users');
	}
	
	// Выбрать все остальные группы
	function get_all_users_for_add()
	{
		$this->db->join('msys_users', 'msys_users.u_id=msys_groups_users.gu_usr_id', 'right');
		return $this->db->get('msys_groups_users');
	}
	
	// Выбрать все проекты, к которым есть доступ у ранга
	function get_projects_ranks($id)
	{
		$this->db->join('msys_projects_ranks', 'msys_projects_ranks.pr_prj_id=msys_projects.p_id', 'left');
		$this->db->join('msys_ranks', 'msys_ranks.r_id=msys_projects_ranks.pr_rnk_id', 'left');
		$this->db->where('msys_projects_ranks.pr_rnk_id', $id);
		return $this->db->get('msys_projects');
	}
	
	// Выбрать все проекты, с которыми работает группа
	function get_projects_groups($id)
	{
		$this->db->join('msys_groups_projects', 'msys_groups_projects.gp_wg_id=msys_groups.wg_id', 'left');
		$this->db->join('msys_projects', 'msys_groups_projects.gp_prj_id=msys_projects.p_id', 'left');
		$this->db->where('msys_groups_projects.gp_wg_id', $id);
		return $this->db->get('msys_groups');
	}
	
	// Найти, какая группа работает над проектом
	function get_groups_projects($id)
	{
		$this->db->where('gp_prj_id', $id);
		return $this->db->get('msys_groups_projects');
	}
	
	// Проверить, если ли в таблице 
	// соответствующие записи и вернуть
	// true или false
	function chk_acs($acs_id, $wg_id)
	{
		$this->db->where('ag_acs_id', $acs_id);
		$this->db->where('ag_wg_id', $wg_id);
		$result = $this->db->get('msys_accesses_groups');
		if ($result->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	// Проверить, если ли в таблице 
	// соответствующие записи и вернуть
	// true или false
	function chk_rnk_acs($rnk_id, $p_id)
	{
		$this->db->where('pr_rnk_id', $rnk_id);
		$this->db->where('pr_prj_id', $p_id);
		$result = $this->db->get('msys_projects_ranks');
		if ($result->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	// Проверить, принадлежит ли пользователь к рабочей группе
	function isInWg($u_id, $wg_id)
	{
		$this->db->where('gu_usr_id', $u_id);
		$this->db->where('gu_grp_id', $wg_id);
		$result = $this->db->get('msys_groups_users');
		if ($result->num_rows() > 0)
			return true;
		else
			return false;
	}	
	
	// Выбрать все группы, к которым есть доступ у данного уровня
	function get_access_groups($id)
	{
		$this->db->join('msys_accesses_groups', 'msys_accesses_groups.ag_wg_id=msys_groups.wg_id', 'left');
		$this->db->join('msys_accesses', 'msys_accesses_groups.ag_acs_id=msys_accesses.a_id', 'left');
		$this->db->where('msys_accesses_groups.ag_acs_id', $id);
		return $this->db->get('msys_groups');
	}
	
	// Выбрать все остальные группы
	function get_all_groups($id = 0)
	{
		if ($id == 0)
		{
			$this->db->join('msys_groups', 'msys_groups.wg_id=msys_accesses_groups.ag_wg_id', 'right');
			return $this->db->get('msys_accesses_groups');
		}
		else
		{
			$this->db->join('msys_groups_users', 'msys_groups_users.gu_grp_id=msys_groups.wg_id', 'left');
			$this->db->where('msys_groups_users.gu_usr_id', $id);
			return $this->db->get('msys_groups');
		}
	}
	
	// Получаем проект
	function get_projects($id = 0)
	{
		if ($id == 0)
		{
			return $this->db->get('msys_projects');
		}
		else
		{
			$this->db->where('p_id', $id);
			return $this->db->get('msys_projects');
		}
		
	}
	
	// Получаем цель
	function get_goals($id)
	{	
		$this->db->where('g_id', $id);
		return $this->db->get('msys_goals');
	}
	
	// Выбрать все цели проекта
	function get_all_prj_goals($p_id)
	{
		//$this->db->select('g_name, g_descr, g_status');
		$this->db->where('g_prj_id', $p_id);
		return $this->db->get('msys_goals');
	}
	
	// Выбрать всех членов группы
	function get_all_grp_members($wg_id)
	{
		$this->db->select('u_name, r_name, a_name');
		$this->db->join('msys_groups_users', 'msys_users.u_id=msys_groups_users.gu_usr_id', 'left');
		$this->db->join('msys_ranks', 'msys_users.u_rid=msys_ranks.r_id', 'left');
		$this->db->join('msys_accesses', 'msys_users.u_aid=msys_accesses.a_id', 'left');
		$this->db->where('gu_grp_id', $wg_id);
		return $this->db->get('msys_users');
	}
	
	// Выбрать все проекты, к которым есть доступ
	function get_rank_projects($id)
	{
		$this->db->join('msys_projects_ranks', 'msys_projects_ranks.pr_prj_id=msys_projects.p_id', 'left');
		$this->db->join('msys_ranks', 'msys_ranks.r_id=msys_projects_ranks.pr_rnk_id', 'left');
		$this->db->where('msys_projects_ranks.pr_rnk_id', $id);
		return $this->db->get('msys_projects');
	}
	
	// Выбрать все остальные проекты
	function get_all_projects($usr_id = 0)
	{
		if ($usr_id == 0)
		{
			$this->db->join('msys_projects', 'msys_projects.p_id=msys_projects_ranks.pr_prj_id', 'right');
			return $this->db->get('msys_projects_ranks');
		}
		else
		{
			$this->db->join('msys_groups_users', 'msys_groups_users.gu_grp_id=msys_groups.wg_id', 'left');
			$this->db->join('msys_groups_projects', 'msys_groups_projects.gp_wg_id=msys_groups_users.gu_grp_id', 'left');
			$this->db->join('msys_projects', 'msys_groups_projects.gp_prj_id=msys_projects.p_id', 'left');
			$this->db->where('msys_groups_users.gu_usr_id', $usr_id);
			return $this->db->get('msys_groups');
		}
	}

	// Получаем всех пользователей 
	// лидеров групп и админов
	function get_grp_leaders()
	{
		$this->db->select('u_id, u_name');
		$this->db->where('u_adm_status', 'grp_leader');
		$this->db->or_where('u_adm_status', 'admin');
		return $this->db->get('msys_users');
	}
	
	// Выбираем пользователей
	function get_users($id = 0)
	{
		$this->db->join('msys_ranks', 'msys_ranks.r_id=msys_users.u_rid', 'left');
		$this->db->join('msys_accesses', 'msys_accesses.a_id=msys_users.u_aid', 'left');
		if ($id == 0)
		{
			return $this->db->get('msys_users');
		}
		else
		{
			return $this->db->get_where('msys_users', array('u_id'=>$id));
		}
	}
	
	// Получаем все ранги
	function get_ranks($id = 0)
	{
		if ($id == 0)
		{
			return $this->db->get('msys_ranks');
		}
		else
		{
			return $this->db->get_where('msys_ranks', array('r_id'=>$id));
		}
	}
	
	// Получаем все уровни доступа
	function get_accesses($id = 0)
	{
		if ($id == 0)
		{
			return $this->db->get('msys_accesses');
		}
		else
		{
			return $this->db->get_where('msys_accesses', array('a_id'=>$id));
		}
	}
	
	// Получаем группу или группы)
	function get_groups($id = 0)
	{
		if ($id == 0)
		{
			$this->db->join('msys_users', 'msys_users.u_id=msys_groups.wg_boss_id', 'left');
			return $this->db->get('msys_groups');
		}
		else
		{
			$this->db->join('msys_users', 'msys_users.u_id=msys_groups.wg_boss_id', 'left');
			$this->db->where('wg_id', $id);
			return $this->db->get('msys_groups');
		}
	}
	
	// Не долго думая вытягиваем все новости / новость с заданным id
	// не забыв добавить к id ещё и имена
	function get_news($id = 0)
	{
		if ($id == 0)
		{
			$this->db->join('msys_users', 'msys_users.u_id=msys_news.n_author', 'left');
			$this->db->order_by('n_changed', 'desc'); 
			return $this->db->get('msys_news');
		}
		else
		{
			$this->db->join('msys_users', 'msys_users.u_id=msys_news.n_author', 'left');
			$this->db->where('n_id', $id);
			return $this->db->get('msys_news');
		}
	}
}