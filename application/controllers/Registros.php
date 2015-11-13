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
        $data['accion'] = 'VIS';
        $data['visualizar'] =$this->Permisos_model->get_permiso($data);
        $mensaje['titulo'] = 'Registros';
    		$this->load->view('Plantillas/Header',$mensaje);
    		$this->load->view('Registros/Index',$data);
    		$this->load->view('Plantillas/Footer');
    }
    else
		{
			show_error('No tiene permisos para ver esta página.', 1, $heading = 'Permisos');
		}
	}

	public function ver($id)
	{
		$data['titulo'] = 'VER Registro';
		$val['registro'] = $this->Registros_model->get_registro($id);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');

		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Registros/VERRegistro',$val);
		$this->load->view('Plantillas/Footer');
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
