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
		log_message('info', 'getall_clientes()');
		return $query->result();
	}

		public function get_cliente($id)
	{
		$query = $this->db->get_where('biclientes', array('IDCliente =' => $id));
		log_message('info', 'get_cliente()');
		return $query->result();
	}

	public function insert_cliente($data)
	{
		$this->db->insert('biclientes',$data);
		log_message('info', 'insert_cliente()');
	}

	public function update_cliente($data)
	{
		$this->db->update('biclientes', $data, "IDCliente =".$data['IDCliente']."");
		log_message('info', 'update_cliente()');
	}

}
?>
