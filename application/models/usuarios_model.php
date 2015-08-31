<?php
class Usuarios_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('security');
	}

	public function getall_usuarios()
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->join('perfiles', 'perfiles.IDPerfiles = usuarios.IDProfile');

		$query = $this->db->get();
		return $query->result();
	}

	public function getall_cuentas()
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->join('perfiles', 'perfiles.IDPerfiles = usuarios.IDProfile');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_cuenta($id)
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->join('perfiles', 'perfiles.IDPerfiles = usuarios.IDProfile');
		$this->db->where('IDUsuario',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_usuario($id)
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->join('perfiles', 'perfiles.IDPerfiles = usuarios.IDProfile');
		$this->db->where('IDUsuario',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function verif_usuario($id)
	{
		$consulta = $this->db->get_where('usuarios', array('IDUsuario =' => $id));

		if($consulta->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function insert_cuenta($data)
	{
		$data['ClaveUsuario'] = do_hash($data['ClaveUsuario'], 'md5');
		$this->db->insert('usuarios',$data);
	}

	public function update_cuenta($data)
	{
		$this->db->update('usuarios', $data, "IDUsuario ='".$data['IDUsuario']."'");
	}
	
	public function insert_usuario($data)
	{
		$data['ClaveUsuario'] = do_hash($data['ClaveUsuario'], 'md5');
		$this->db->insert('usuarios',$data);
	}

	public function update_usuario($data)
	{
		$this->db->update('usuarios', $data, "IDUsuario ='".$data['IDUsuario']."'");
	}

	public function very_user($data)
	{
		$query = $this->db->get_where('usuarios',$data);

		return $query->result();
	}

	public function blanquea_clave($id)
	{
		$data = array('ClaveUsuario' => do_hash('654321','md5'));

		$condicion = "IDUsuario = '".$id."'";

		$str = $this->db->update_string('usuarios', $data, $condicion);

		$this->db->query($str);
	}

	public function cambia_clave($data)
	{
		$sql = array('ClaveUsuario' => do_hash($data['ClaveUsuario'],'md5'));

		$condicion = "IDUsuario = '".$data['IDUsuario']."'";

		$str = $this->db->update_string('usuarios', $sql, $condicion);

		$this->db->query($str);
	}
}
?>
