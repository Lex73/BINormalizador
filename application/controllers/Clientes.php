<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	private $mensaje;

	public function __construct()
	{
		parent:: __construct();
		$this->very_sesion();
		$this->load->model('Clientes_model');
		$this->load->model('Permisos_model');
		$this->mensaje = '';
	}

	public function index()
	{
		$data['query'] = $this->Clientes_model->getall_clientes();
		$data['mensaje'] = $this->mensaje;
		$data['titulo'] = 'Clientes';
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
			$mensaje['titulo'] = 'Clientes';
			$this->load->view('Plantillas/Header',$mensaje);
			$this->load->view('Clientes/Index',$data);
			$this->load->view('Plantillas/Footer');
		}
		else
		{
			$this->load->view('Plantillas/Header',$data);
			$this->load->view('errors/errores');
			$this->load->view('Plantillas/Footer');
		}
	}

	public function agregar()
	{
		$data['titulo'] = 'ABM Cliente';

		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');
		$data['mensaje'] = $this->mensaje;
		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Clientes/ABMClientes');
		$this->load->view('Plantillas/Footer');
	}

	public function modificar($id)
	{
		$data['titulo'] = 'ABM Cliente';
		$val['clientes'] = $this->Clientes_model->get_cliente($id);

		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');
		$data['mensaje'] = $this->mensaje;

		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Clientes/ABMClientes',$val);
		$this->load->view('Plantillas/Footer');
	}

	public function operaciones_clientes()
	{
		if($this->input->post('submit_Agregar_Cliente'))
		{
			$this->form_validation->set_rules("NombreCliente","Nombre Cliente","required|trim|xss_clean");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');

			if($this->form_validation->run() == FALSE)
			{
				$this->agregar();
			}
			else
			{
				$data = array('DESCCliente' => $this->input->post('NombreCliente',TRUE));

				$this->Clientes_model->insert_cliente($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->index();
			}
		}
		else if($this->input->post('submit_Modificar_Cliente'))
		{
			$this->form_validation->set_rules("NombreCliente","Nombre Cliente","required|trim|xss_clean");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');

			if($this->form_validation->run() == FALSE)
			{
				$this->modificar($this->input->post('IDCliente',TRUE));
			}
			else
			{
				$data = array('IDCliente' => $this->input->post('IDCliente',TRUE),
						      		'DESCCliente' => $this->input->post('NombreCliente',TRUE));

				$this->Clientes_model->update_cliente($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->index();
			}
		}
		else
		{

		}
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
