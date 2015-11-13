<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tablas extends CI_Controller {

	private $mensaje;
	private $m_id;

	public function __construct()
	{
		parent:: __construct();
		$this->very_sesion();
		$this->load->model('Tablas_model');
    $this->load->model('Usuarios_model');
    $this->load->model('Permisos_model');
		$this->mensaje = '';
		$this->m_id = '';
	}

	public function index()
	{
		$data['titulo'] = 'Tablas';
		$data['query'] = $this->Tablas_model->gettodas_usuarios();
		$data['mensaje'] = $this->mensaje;
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
			$mensaje['titulo'] = 'Tablas';
			$this->load->view('Plantillas/Header',$mensaje);
			$this->load->view('Tablas/Index',$data);
			$this->load->view('Plantillas/Footer');
		}
		else
		{
			show_error('No tiene permisos para ver esta página.', 1, $heading = 'Permisos');
		}
	}

	public function agregar()
	{
		$data['titulo'] = 'ABM Tablas';

		$data['cuentas'] = $this->Usuarios_model->gettodas_cuentas();
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');
		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Tablas/ABMTablas');
		$this->load->view('Plantillas/Footer');
	}

	public function modificar($id)
	{
		$data['titulo'] = 'ABM Tablas';
		$val['tablas'] = $this->Tablas_model->obtener_tabla($id);
		$val['campos'] = $this->Tablas_model->get_campos($id);
		$data['cuentas'] = $this->Usuarios_model->gettodas_cuentas();
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');

		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Tablas/ABMTablas',$val);
		$this->load->view('Plantillas/Footer');
	}

	public function campos($id)
	{
		$data['titulo'] = 'ABM Campos';
		$val['campos'] = $this->Tablas_model->get_campos($id);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');

		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Tablas/ABMCampos',$val);
		$this->load->view('Plantillas/Footer');
	}

	public function operaciones_tablas()
	{
		if($this->input->post('submit_Agregar_Tablas'))
		{
      $this->form_validation->set_rules("NombreTabla","Tabla","required|trim|xss_clean|callback_tabname_check");
			$this->form_validation->set_rules("IDCuenta","Cuenta","required");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');
      $this->form_validation->set_message('tabname_check','El nombre de la %s ya existe para esa cuenta.');

			if($this->form_validation->run() == FALSE)
			{
				$this->agregar();
			}
			else
			{
				$data = array(
						'NOMTabla' => $this->input->post('NombreTabla',TRUE),
					  'IDCuenta' => $this->input->post('IDCuenta',TRUE));

				$this->Tablas_model->insert_tabla($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->index();
			}
		}
		else if($this->input->post('submit_Modificar_Tablas'))
		{
      $this->form_validation->set_rules("NombreTabla","Nombre","required|trim|xss_clean");
			$this->form_validation->set_rules("IDCuenta","Cuenta","required");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');

			if($this->form_validation->run() == FALSE)
			{
				$this->modificar($this->input->post('IDTabla',TRUE));
			}
			else
			{
				$data = array(
          'IDTabla' => $this->input->post('IDTabla',TRUE),
          'NOMTabla' => $this->input->post('NombreTabla',TRUE),
          'IDCuenta' => $this->input->post('IDCuenta',TRUE));

				$this->Tablas_model->update_tabla($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->index();
			}
		}
		else
		{

		}
	}

  function tabname_check($id)
  {
    	$val = $this->Tablas_model->verif_tabla($id);

    	if($val == true)
    	{
    		return false;
    	}
    	else
    	{
    		return true;
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
