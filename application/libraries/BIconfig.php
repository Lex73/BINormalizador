<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Biconfig
{
  protected $ci;

  function __construct()
  {
      $this->ci =& get_instance();
  }
  function getConfig()
	{
      $this->ci->load->model('configuracion_model');
			$query = $this->ci->configuracion_model->get_conf();

			if($query != false)
			{
					foreach ($query->result() as $row)
					{
							if($row->IDClave == 'ALLTY')
							{
								$this->ci->config->set_item('ALLTY',$row->VALOR);
							}
							elseif($row->IDClave == 'FOLPR')
							{
								$this->ci->config->set_item('FOLPR',$row->VALOR);
							}
							elseif($row->IDClave == 'FOLUP')
							{
								$this->ci->config->set_item('FOLUP',$row->VALOR);
							}
							elseif($row->IDClave == 'NARCH')
							{
								$this->ci->config->set_item('NARCH',$row->VALOR);
							}
							elseif($row->IDClave == 'FOLDO')
							{
								$this->ci->config->set_item('FOLDO',$row->VALOR);
							}
              elseif($row->IDClave == 'FOLLG')
							{
								$this->ci->config->set_item('FOLLG',$row->VALOR);
							}
							else
							{

							}
					}
					return true;
			}
			else
			{
					return false;
			}
	}
}
?>
