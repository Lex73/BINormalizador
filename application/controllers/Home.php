<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public $BIconfiguracion;

	public function __construct()
	{
		parent:: __construct();
    $this->very_sesion();
		$this->BIconfiguracion = $this->biconfig->getConfig();
		$this->load->model('tablas_model');
		$this->load->model('log_model');
	}

	public function index()
	{
		if($this->BIconfiguracion == true)
		{
			$mensaje['titulo']= 'Principal';
			$mensaje['usuario'] = $this->session->userdata('usuario');
			$mensaje['nombre'] = $this->session->userdata('nombre');
			$mensaje['perfil'] = $this->session->userdata('perfil');
			$mensaje['cuenta'] = $this->session->userdata('cuenta');
			$this->load->view('Plantillas/Header',$mensaje);
			$this->load->view('Home/Index');
			$this->load->view('Plantillas/Footer');
	  }
		else
		{
			echo 'Error al cargar la configuración';
		}
	}
  function very_sesion()
  {
    if(!$this->session->userdata('usuario'))
    {
      redirect(base_url().'Login/');
    }
  }
}
?>
