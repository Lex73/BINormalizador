<?php
class Tablas_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
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
    if($query->num_rows() > 0)
    {
		    return $query->result();
    }
    else
    {
        return false;
    }
	}

}
?>
