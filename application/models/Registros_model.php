<?php
class Registros_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function getall_registros()
	{
		$query = $this->db->get('biprocesos');
		return $query->result();
	}

  public function getall_registros_por_cuenta($id)
	{
		$query = $this->db->get_where('biprocesos',array('IDCuenta =' => $id));
		return $query->result();
	}

		public function get_registro($id)
	{
		$query = $this->db->get_where('biprocesos', array('IDPro =' => $id));
		return $query->result();
	}
}
?>
