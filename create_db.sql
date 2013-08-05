/* ������ ������� */
CREATE TABLE IF NOT EXISTS msys_accesses
(
  a_id int(11) NOT NULL AUTO_INCREMENT,
  a_name char(15) NOT NULL UNIQUE,
  PRIMARY KEY (a_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

/* ����� ������ �������-������ */
CREATE TABLE IF NOT EXISTS msys_accesses_groups
(
  ag_acs_id int(11) NOT NULL,
  ag_wg_id int(11) NOT NULL,
  KEY ag_acs_id (ag_acs_id),
  KEY ag_wg_id (ag_wg_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* ���� ������� */
CREATE TABLE IF NOT EXISTS msys_goals 
(
  g_id int(11) NOT NULL AUTO_INCREMENT,
  g_name varchar(255) NOT NULL UNIQUE,
  g_descr TEXT,
  g_status int(11) NOT NULL,
  g_prj_id int(11) NOT NULL,
  /* ���� ���������� ���� */
  g_finished datetime NOT NULL,
  g_priority int(11) NULL,
  PRIMARY KEY (g_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO msys_goals (g_id, g_name, g_descr, g_status, g_prj_id) VALUES
(1,  '������ ����', '����������� ��������� ������� ���� ������ ������� ������', 0, 1),
(2,  '���������� �������� ��� ������', '����������� ���������/������� ����, ������<br>������� ��� ����� ������ + �������������� �������', 0, 1),
(3,  '���������� �������', '���������� ������� �� ��������� ��� ��������� ������', 1, 1),
(4,  '���������� �����', '����������� ������ �������������� ���������� ��� ������ ����', 0, 1),
(5,  '���� ����������', '����������� ���������� ����������� ���� ���������� �������', 1, 1),
(6,  '����������� �����������', '����������� ���������� �� ����������� �����������', 1, 1),
(7,  '�������������� ����', '����������� �������� ������ ����', 1, 1),
(8,  '��������� ���������', '����������� ��������� ��������� � ������� ������� ������������<br>�� ������� �������� �������', 0, 1),
(9,  '�������� �������� ������', '���������� ����� ����������� ��������� �������� �������� ������', 0, 1),
(10, '������', '���������� ����� ���������������� ������ ������� �������', 0, 1),
(11, 'AJAX', '���������� AJAX ��������� � ����� ��������� ������ � �������� ��� ������������', 0, 1),
(12, '��������', '���������� WYSIWYG ���������, � ����� ��������� ���� ����������', 0, 1),
(13, '�������', '���������� ������� ��������', 1, 1),
(14, '������', '���������� ������� ������', 1, 1);

/* ������ */
CREATE TABLE IF NOT EXISTS msys_groups 
(
  wg_id int(11) NOT NULL AUTO_INCREMENT,
  wg_name char(30) NOT NULL UNIQUE,
  wg_boss_id int(11) NOT NULL,
  wg_grp_descr varchar(255) DEFAULT NULL,
  wg_progress TEXT,
  PRIMARY KEY (wg_id),
  KEY wg_boss_name (wg_boss_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

/* ����� ������-������� */
CREATE TABLE IF NOT EXISTS msys_groups_projects
(
  gp_wg_id int(11) NOT NULL,
  gp_prj_id int(11) NOT NULL,
  KEY gp_wg_id (gp_wg_id),
  KEY gp_prj_id (gp_prj_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* ����� ������-������������ */
CREATE TABLE IF NOT EXISTS msys_groups_users 
(
  gu_usr_id int(11) NOT NULL,
  gu_grp_id int(11) NOT NULL,
  KEY gu_usr_id (gu_usr_id),
  KEY gu_grp_id (gu_grp_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* ������� */
CREATE TABLE IF NOT EXISTS msys_news
(
  n_id int(11) NOT NULL AUTO_INCREMENT,
  n_head varchar(105) NOT NULL UNIQUE,
  n_sdescr char(255) NOT NULL,
  n_descr TEXT NOT NULL,
  n_publ DATETIME NOT NULL,
  n_author INT(11) NOT NULL,
  n_changed DATETIME NOT NULL,
  n_changed_by INT(11) NOT NULL,
  PRIMARY KEY (n_id),
  KEY n_author (n_author),
  KEY n_changed_by (n_changed_by)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

/* ������� */
CREATE TABLE IF NOT EXISTS msys_projects
(
  p_id int(11) NOT NULL AUTO_INCREMENT,
  p_name varchar(255) NOT NULL UNIQUE,
  p_descr mediumtext,
  p_prj_status int(11) NOT NULL,
  p_changed datetime NOT NULL,
  /* ���� ���������� ������� */
  p_finished datetime NOT NULL,
  PRIMARY KEY (p_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO msys_projects (p_id, p_name, p_descr, p_prj_status, p_changed) VALUES
(1, '���', '������� ���������� �����������', 0, '2011-08-23 09:44:34');

/* ����� �������-����� */
CREATE TABLE IF NOT EXISTS msys_projects_ranks
(
  pr_prj_id int(11) NOT NULL,
  pr_rnk_id int(11) NOT NULL,
  KEY pr_prj_id (pr_prj_id),
  KEY pr_rnk_id (pr_rnk_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* ����� */
CREATE TABLE IF NOT EXISTS msys_ranks
(
  r_id int(11) NOT NULL AUTO_INCREMENT,
  r_name char(15) NOT NULL UNIQUE,
  PRIMARY KEY (r_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO msys_ranks (r_id, r_name) VALUES
(1, '�����'),
(2, '������'),
(3, '������');

/* ������������ */
CREATE TABLE IF NOT EXISTS msys_users
(
  u_id int(11) NOT NULL AUTO_INCREMENT,
  u_name varchar(35) NOT NULL UNIQUE,
  u_pass char(255) NOT NULL,
  u_rid int(11) DEFAULT NULL,
  u_aid int(11) DEFAULT NULL,
  u_gid int(11) DEFAULT NULL,
  u_last_logout datetime DEFAULT NULL,
  u_adm_status char(35) NOT NULL,
  PRIMARY KEY (u_id),
  KEY u_rid (u_rid),
  KEY u_aid (u_aid),
  KEY u_gid (u_gid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO msys_users (u_id, u_name, u_pass, u_rid, u_aid, u_gid, u_last_logout, u_adm_status) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, 1, NULL, NULL, 'admin');