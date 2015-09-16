<?php
class Configuracion_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function get_conf()
	{
		$query = $this->db->get('biconfig');
    if($query->num_rows() > 0)
    {
		    return $query;
    }
    else
    {
        return false;
    }
	}
}
?>
