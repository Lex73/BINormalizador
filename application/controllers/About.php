<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->very_sesion();
	}

	public function index()
	{
		$data['titulo'] = 'About';
		$mensaje['usuario'] = $this->session->userdata('usuario');
    $mensaje['nombre'] = $this->session->userdata('nombre');
    $mensaje['perfil'] = $this->session->userdata('perfil');
    $mensaje['cuenta'] = $this->session->userdata('cuenta');
		$this->load->view('Plantillas/Header',$mensaje);
		$this->load->view('About/Index');
		$this->load->view('Plantillas/Footer');
	}

	function very_sesion()
	{
		if(!$this->session->userdata('usuario'))
		{
			redirect(base_url().'login/');
		}
	}
}
?>
