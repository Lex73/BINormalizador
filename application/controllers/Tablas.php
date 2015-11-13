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

	public function agregarCampos($id)
	{
		$data['titulo'] = 'ABM Campos';
		$val['tablas'] = $this->Tablas_model->obtener_tabla($id);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');
		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Tablas/ABMCampos',$val);
		$this->load->view('Plantillas/Footer');
	}

	public function modificarCampo($tabla, $campo)
	{
		$data['titulo'] = 'ABM Campos';
		$val['tablas'] = $this->Tablas_model->obtener_tabla($tabla);
		$val['campo'] =$this->Tablas_model->obtener_campo($campo);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');
		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Tablas/ABMCampos',$val);
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
		else if($this->input->post('submit_Agregar_Campo'))
		{
			$this->form_validation->set_rules("NOMCampo","Nombre del campo","required|trim|xss_clean|callback_campo_check");
      $this->form_validation->set_rules("TYPCampo","Tipo de campo","required|trim|xss_clean");
			$this->form_validation->set_rules("LONGCampo","Longitud de campo","required|integer|trim|xss_clean");
			$this->form_validation->set_rules("ORDER","Orden","required|integer|trim|xss_clean|callback_order_check");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');
			$this->form_validation->set_message('integer','El campo %s debe ser numerico.');
			$this->form_validation->set_message('order_check','El orden asignado ya existe para esta tabla.');
			$this->form_validation->set_message('campo_check','El nombre de campo asignado ya existe para esta tabla.');

			if($this->form_validation->run() == FALSE)
			{
				$this->agregarCampos($this->input->post('IDTabla',TRUE));
			}
			else
			{
				$data = array(
          'IDTabla' => $this->input->post('IDTabla',TRUE),
					'NOMCampo' => $this->input->post('NOMCampo',TRUE),
          'TYPCampo' => $this->input->post('TYPCampo',TRUE),
					'LONGCampo' => $this->input->post('LONGCampo',TRUE),
          'ORDER' => $this->input->post('ORDER',TRUE));

				$this->Tablas_model->insert_campo($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->modificar($this->input->post('IDTabla',TRUE));
			}
		}
		else if($this->input->post('submit_Modificar_Campo'))
		{
			$this->form_validation->set_rules("NOMCampo","Nombre del campo","required|trim|xss_clean");
      $this->form_validation->set_rules("TYPCampo","Tipo de campo","required|trim|xss_clean");
			$this->form_validation->set_rules("LONGCampo","Longitud de campo","required|integer|trim|xss_clean");
			$this->form_validation->set_rules("ORDER","Orden","required|integer|trim|xss_clean");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');
			$this->form_validation->set_message('integer','El campo %s debe ser numerico.');

			if($this->form_validation->run() == FALSE)
			{
				$this->agregarCampos($this->input->post('IDTabla',TRUE));
			}
			else
			{
				$data = array(
					'IDCampo' => $this->input->post('IDCampo',TRUE),
          'IDTabla' => $this->input->post('IDTabla',TRUE),
					'NOMCampo' => $this->input->post('NOMCampo',TRUE),
          'TYPCampo' => $this->input->post('TYPCampo',TRUE),
					'LONGCampo' => $this->input->post('LONGCampo',TRUE),
          'ORDER' => $this->input->post('ORDER',TRUE));

				$this->Tablas_model->update_campo($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->modificar($this->input->post('IDTabla',TRUE));
			}
		}
		else
		{

		}
	}

	function order_check($order)
	{
			$val = $this->Tablas_model->verif_order($order, $this->input->post('IDTabla',TRUE));

			if($val == true)
			{
				return false;
			}
			else
			{
				return true;
			}
	}

	function campo_check($nombre)
	{
			$val = $this->Tablas_model->verif_campo($nombre, $this->input->post('IDTabla',TRUE));

			if($val == true)
			{
				return false;
			}
			else
			{
				return true;
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
