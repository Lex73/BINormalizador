<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentas extends CI_Controller {

	private $mensaje;
	private $m_id;

	public function __construct()
	{
		parent:: __construct();
		$this->very_sesion();
		$this->load->model('Usuarios_model');
		$this->load->model('Clientes_model');
		$this->load->model('Permisos_model');
		$this->mensaje = '';
		$this->m_id = '';
	}

	public function index()
	{
		$data['titulo'] = 'Cuentas';
		$data['query'] = $this->Usuarios_model->getall_cuentas();
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
			$mensaje['titulo'] = 'Cuentas';
			$this->load->view('Plantillas/Header',$mensaje);
			$this->load->view('Cuentas/Index',$data);
			$this->load->view('Plantillas/Footer');
		}
		else
		{
			show_error('No tiene permisos para ver esta página.', 1, $heading = 'Permisos');
		}
	}

	public function agregar()
	{
		$data['titulo'] = 'ABM Cuentas';

		$data['query'] = $this->Clientes_model->getall_clientes();
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');

		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Cuentas/ABMCuentas');
		$this->load->view('Plantillas/Footer');
	}

	public function modificar($id)
	{
		$data['titulo'] = 'ABM Cuentas';
		$val['user'] = $this->Usuarios_model->get_cuenta_1($id);
		$val['query'] = $this->Clientes_model->getall_clientes();
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');

		$this->load->view('Plantillas/Header',$data);
		$this->load->view('Cuentas/ABMCuentas',$val);
		$this->load->view('Plantillas/Footer');
	}

	function cargar_archivo()
	{
        $mi_archivo = $this->input->post('Imagen');
        $config['upload_path'] = "C:/xampp/htdocs/MagicWeb/assets/Imagenes/Usuarios/";
        $config['file_name'] =  $this->input->post('IDUsuario',TRUE).".gif";
        $config['allowed_types'] = "gif";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }
        else
        {
        	echo 'OK';
        }

    }

	public function operaciones_cuentas()
	{
		if($this->input->post('submit_Agregar_Cuentas'))
		{
			$this->form_validation->set_rules("DESCCuenta","Descripción Cuenta","required|trim|xss_clean");
			$this->form_validation->set_rules("IDCliente","Client","required|trim|xss_clean");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');

			if($this->form_validation->run() == FALSE)
			{
				$this->agregar();
			}
			else
			{
				$data = array('DESCCuenta' => $this->input->post('DESCCuenta',TRUE),
											'IDCliente' => $this->input->post('IDCliente',TRUE));

				$this->Usuarios_model->Insert_cuenta($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->index();
			}
		}
		else if($this->input->post('submit_Modificar_Cuentas'))
		{
			$this->form_validation->set_rules("DESCCuenta","Descripción Cuenta","required|trim|xss_clean");
			$this->form_validation->set_rules("IDCliente","Client","required|trim|xss_clean");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');

			if($this->form_validation->run() == FALSE)
			{
				$this->modificar($this->input->post('IDCuenta',TRUE));
			}
			else
			{
				$data = array(
						'IDCuenta' => $this->input->post('IDCuenta',TRUE),
						'DESCCuenta' => $this->input->post('DESCCuenta',TRUE),
						'IDCliente' => $this->input->post('IDCliente',TRUE));

				$this->Usuarios_model->update_cuenta($data);

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
