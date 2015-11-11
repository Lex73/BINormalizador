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
		$this->db->from('biusuarios');
		$this->db->join('biperfil', 'biperfil.IDPerfil = biusuarios.PERFUsuario');

		$query = $this->db->get();
		return $query->result();
	}

	public function getall_cuentas()
	{
		$this->db->select('*');
		$this->db->from('bicuentas');
		$this->db->join('biclientes', 'biclientes.IDCliente = bicuentas.IDCliente');

		$query = $this->db->get();
		return $query->result();
	}

	public function gettodas_cuentas()
	{
		$query = $this->db->get('bicuentas');
		return $query->result();
	}

	public function get_cuenta($id)
	{
		$this->db->select('*');
		$this->db->from('bicuentas');
		$this->db->where('IDCuenta',$id);
		$query = $this->db->get();

		$res = $query->result();

		foreach ($res as $value)
		{
			return $value->DESCCuenta;
		}
	}

	public function get_cuenta_1($id)
	{
		$this->db->select('*');
		$this->db->from('bicuentas');
		$this->db->where('IDCuenta',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_usuario($id)
	{
		$this->db->select('*');
		$this->db->from('biusuarios');
		$this->db->join('biperfil', 'biperfil.IDPerfil = biusuarios.PERFUsuario');
		$this->db->where('IDUsuarios',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function verif_usuario($id)
	{
		$consulta = $this->db->get_where('biusuarios', array('IDUsuarios =' => $id));

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
		$this->db->insert('bicuentas',$data);
	}

	public function update_cuenta($data)
	{
		$this->db->update('bicuentas', $data, "IDCuenta ='".$data['IDCuenta']."'");
	}

	public function insert_usuario($data)
	{
		$data['CLAVUsuario'] = do_hash($data['CLAVUsuario'], 'md5');
		$this->db->insert('biusuarios',$data);
	}

	public function update_usuario($data)
	{
		$this->db->update('biusuarios', $data, "IDUsuarios ='".$data['IDUsuarios']."'");
	}

	public function very_user($data)
	{
		$query = $this->db->get_where('biusuarios',$data);

		return $query->result();
	}

	public function blanquea_clave($id)
	{
		$data = array('CLAVUsuario' => do_hash('654321','md5'),
								  'Cambia' =>1);

		$condicion = "IDUsuarios = '".$id."'";

		$str = $this->db->update_string('biusuarios', $data, $condicion);

		//echo $str;

		$this->db->query($str);
	}

	public function cambia_clave($data)
	{
		$sql = array('CLAVUsuario' => do_hash($data['CLAVUsuario'],'md5'),
								 'Cambia' => 0);

		$condicion = "IDUsuarios = '".$data['IDUsuarios']."'";

		$str = $this->db->update_string('biusuarios', $sql, $condicion);

		$this->db->query($str);
	}
}
?>
