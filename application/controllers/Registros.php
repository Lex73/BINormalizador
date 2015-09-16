<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registros extends CI_Controller
{
	public $BIconfiguracion;
  private $mensaje;

  public function __construct()
  {
    parent:: __construct();
    $this->very_sesion();
    $this->BIconfiguracion = $this->biconfig->getConfig();
    $this->load->model('Registros_model');
    $this->load->model('Permisos_model');
		$this->mensaje = '';
  }

  public function index()
	{
    //$data['query'] = $this->Registros_model->getall_registros();
		$data['query'] = $this->Registros_model->getall_registros_por_cuenta($this->session->userdata('IDcuenta'));
		$data['mensaje'] = $this->mensaje;
		$data['titulo'] = 'Registros';
		$mensaje['usuario'] = $this->session->userdata('usuario');
		$mensaje['nombre'] = $this->session->userdata('nombre');
		$mensaje['perfil'] = $this->session->userdata('perfil');
		$mensaje['cuenta'] = $this->session->userdata('cuenta');

    $data['accion'] = 'VER';

		$permiso = $this->Permisos_model->get_permiso($data);

		if($permiso == true)
    {
        $data['accion'] = 'ADD';
        $data['agregar'] = $this->Permisos_model->get_permiso($data);
        $data['accion'] = 'MOD';
        $data['modificar'] =$this->Permisos_model->get_permiso($data);
        $mensaje['titulo'] = 'Registros';
    		$this->load->view('Plantillas/Header',$mensaje);
    		$this->load->view('Registros/Index',$data);
    		$this->load->view('Plantillas/Footer');
    }
    else
		{
			$this->load->view('Plantillas/Header',$mensaje);
			$this->load->view('errors/errores');
			$this->load->view('Plantillas/Footer');
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
