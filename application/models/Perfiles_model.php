<?php
class Perfiles_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function getall_perfiles()
	{
		$query = $this->db->get('biperfil');
		return $query->result();
	}

		public function get_perfil($id)
	{
		$query = $this->db->get_where('biperfil', array('IDPerfil =' => $id));
		return $query->result();
	}

	public function insert_perfiles($data)
	{
		$this->db->insert('biperfil',$data);
	}

	public function update_perfiles($data)
	{
		$this->db->update('biperfil', $data, "IDPerfil ='".$data['IDPerfil']."'");
	}

		public function verif_perfil($id)
	{
		$consulta = $this->db->get_where('biperfil', array('IDPerfil =' => $id));

		if($consulta->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}

	}
}
?>
