<?php
class Clientes_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function getall_clientes()
	{
		$query = $this->db->get('biclientes');
		return $query->result();
	}

		public function get_cliente($id)
	{
		$query = $this->db->get_where('biclientes', array('IDCliente =' => $id));
		return $query->result();
	}

	public function insert_cliente($data)
	{
		$this->db->insert('biclientes',$data);
	}

	public function update_cliente($data)
	{
		$this->db->update('biclientes', $data, "IDCliente =".$data['IDCliente']."");
	}

}
?>
