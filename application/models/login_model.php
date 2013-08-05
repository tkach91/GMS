<?php
class Login_model extends CI_Model {

	function getLoginInfo($login)
	{
		$this->db->join('msys_ranks', 'msys_ranks.r_id=msys_users.u_rid', 'left');
		$this->db->join('msys_accesses', 'msys_accesses.a_id=msys_users.u_aid', 'left');
		return $this->db->get_where('msys_users', array('u_name'=>$login));
	}
	
	function setLogoutTime()
	{
		$this->db->where('u_id', $this->session->userdata('id'));
		$this->db->set('u_last_logout', date('Y-m-d H:i:s')); 
		$this->db->update('msys_users');
	}
}