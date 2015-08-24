<?php
class Log_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function insert_log($data)
	{
		$this->db->insert('biprocesos',$data);
	}
}
?>
