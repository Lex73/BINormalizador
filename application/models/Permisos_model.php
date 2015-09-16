<?php
class Permisos_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function getall_permisos()
	{
		$query = $this->db->get('bipermisos');
		return $query->result();
	}

	public function get_permiso($permiso)
	{
		$query = $this->db->get_where('bipermisos', array('pantalla =' => $permiso['titulo'],
														'accion =' => $permiso['accion'],
														'allow =' => $this->session->userdata('usuario')
														));

		/*echo '-'.$permiso['titulo'];
		echo '-'.$permiso['accion'];
		echo '-'.$this->session->userdata('usuario');
		echo '-'.$this->session->userdata('perfil');*/


		if($query->num_rows() > 0)
		{
			//echo '-'.'usu true';
			return true;
		}
		else
		{
			$query = $this->db->get_where('bipermisos', array('pantalla =' => $permiso['titulo'],
														    'accion =' => $permiso['accion'],
														    'allow =' => $this->session->userdata('perfil')
														    ));
			if($query->num_rows() > 0)
			{
				//echo '-'.'perfil true';
				return true;
			}
			else
			{
				//echo '-'.'false';
				return false;
			}

		}
	}

	public function insert_permiso($data)
	{
		$this->db->insert('bipermisos',$data);
	}

	public function update_permiso($data)
	{
		//$this->db->update('permisos', $data, "IDCliente =".$data['IDCliente']."");
	}

}
?>
