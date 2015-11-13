<?php
class Tablas_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function gettodas_usuarios()
	{
		$this->db->select('*');
		$this->db->from('bitablas');
		$this->db->join('bicuentas', 'bicuentas.IDCuenta = bitablas.IDCuenta');

		$query = $this->db->get();
		return $query->result();
	}

	public function getall_tablas()
	{
		$this->db->select('*');
		$this->db->from('biusuarios');
		$this->db->join('biperfil', 'biperfil.IDPerfil = biusuarios.PERFUsuario');

		$query = $this->db->get();
		return $query->result();
	}

  public function get_tabla($tabla,$cuenta)
	{
    $this->db->where('NOMTabla', $tabla);
    $this->db->where('IDCuenta', $cuenta);
		$query = $this->db->get('bitablas');
    if($query->num_rows() > 0)
    {
		    return $query->result();
    }
    else
    {
        return false;
    }
	}

	public function obtener_tabla($tabla)
	{
		$this->db->select('*');
		$this->db->from('bitablas');
		$this->db->where('IDTabla', $tabla);
		$this->db->join('bicuentas', 'bicuentas.IDCuenta = bitablas.IDCuenta');

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
				return $query->result();
		}
		else
		{
				return false;
		}
	}

  public function get_tablas($cuenta)
	{
    $this->db->where('IDCuenta', $cuenta);
		$query = $this->db->get('bitablas');
    if($query->num_rows() > 0)
    {
		    return $query->result();
    }
    else
    {
        return false;
    }
	}

  public function get_campos($tabla)
	{
    $this->db->where('IDTabla', $tabla);
    $this->db->order_by('ORDER', 'ASC');
		$query = $this->db->get('bicampos');

		return $query->result();

	}

	public function insert_tabla($data)
	{
		$this->db->insert('bitablas',$data);
	}

	public function update_tabla($data)
	{
		$this->db->update('bitablas', $data, "IDTabla ='".$data['IDTabla']."'");
	}

	public function verif_tabla($data)
	{
		$query = $this->db->get_where('bitablas',array('NOMTabla' => $data));

		return $query->result();
	}
}
?>
