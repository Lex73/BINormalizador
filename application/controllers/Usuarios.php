<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	private $mensaje;
	private $m_id;

	public function __construct()
	{
		parent:: __construct();
		$this->very_sesion();
		$this->load->model('Usuarios_model');
		$this->load->model('Perfiles_model');
		$this->load->model('Permisos_model');
		$this->mensaje = '';
		$this->m_id = '';
	}

	public function index()
	{
		$data['titulo'] = 'Usuarios';
		$data['query'] = $this->Usuarios_model->getall_usuarios();
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
			$mensaje['titulo'] = 'Usuarios';
			$this->load->view('Plantillas/Header',$mensaje);
			$this->load->view('Usuarios/Index',$data);
			$this->load->view('Plantillas/Footer');
		}
		else
		{
			$this->load->view('Plantillas/Header',$data);
			$this->load->view('errors/Index');
			$this->load->view('Plantillas/Footer');
		}
	}

	public function CambiaClave()
	{
		$data['titulo'] = 'Clave';
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$data['cuenta'] = $this->session->userdata('cuenta');

		$data['accion'] = 'VER';

		$permiso = $this->Permisos_model->get_permiso($data);

		if($permiso == true)
        {
        	$data['titulo'] = 'Clave';

			$this->load->view('Plantillas/Header',$data);
			$this->load->view('Usuarios/CambiaClave');
			$this->load->view('Plantillas/Footer');
		}
		else
		{
			$this->load->view('Plantillas/Header',$data);
			$this->load->view('Errores/Index');
			$this->load->view('Plantillas/Footer');
		}
	}

	public function agregar()
	{
		$data['titulo'] = 'ABM Usuarios';

		$data['query'] = $this->perfiles_model->getall_perfiles();
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');
		$this->load->view('Plantilla/Header',$data);
		$this->load->view('Usuarios/ABMUsuarios');
		$this->load->view('Plantilla/Footer');
	}

	public function modificar($id)
	{
		$data['titulo'] = 'ABM Usuarios';
		$val['user'] = $this->usuarios_model->get_usuario($id);
		$val['query'] = $this->perfiles_model->getall_perfiles();
		$data['usuario'] = $this->session->userdata('usuario');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['perfil'] = $this->session->userdata('perfil');

		$this->load->view('Plantilla/Header',$data);
		$this->load->view('Usuarios/ABMUsuarios',$val);
		$this->load->view('Plantilla/Footer');
	}

	function cargar_archivo() {

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

	public function operaciones_usuario()
	{
		if($this->input->post('submit_Agregar_Usuarios'))
		{
			$this->form_validation->set_rules("IDUsuario","Usuario","required|trim|xss_clean|callback_username_check");
			$this->form_validation->set_rules("NombreUsuario","Nombre","required|trim|xss_clean");
			$this->form_validation->set_rules("ClaveUsuario","Clave","required|trim|xss_clean");
			$this->form_validation->set_rules("IDProfile","Perfil","required");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');
			$this->form_validation->set_message('username_check','El %s ya existe.');

			if($this->form_validation->run() == FALSE)
			{
				$this->agregar();
			}
			else
			{
				$data = array(
						'IDUsuario' => $this->input->post('IDUsuario',TRUE),
						'NombreUsuario' => $this->input->post('NombreUsuario',TRUE),
						'ClaveUsuario' => $this->input->post('ClaveUsuario',TRUE),
						'IDProfile' => $this->input->post('IDProfile',TRUE));

				$this->usuarios_model->insert_usuario($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->cargar_archivo();
				$this->index();
			}
		}
		else if($this->input->post('submit_Modificar_Usuarios'))
		{
			$this->form_validation->set_rules("IDUsuario","Usuario","required|trim|xss_clean");
			$this->form_validation->set_rules("NombreUsuario","Nombre","required|trim|xss_clean");
			$this->form_validation->set_rules("IDProfile","Perfil","required");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');

			if($this->form_validation->run() == FALSE)
			{
				$this->modificar($this->input->post('IDUsuario',TRUE));
			}
			else
			{
				$data = array(
						'IDUsuario' => $this->input->post('IDUsuario',TRUE),
						'NombreUsuario' => $this->input->post('NombreUsuario',TRUE),
						'IDProfile' => $this->input->post('IDProfile',TRUE));

				$this->usuarios_model->update_usuario($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->index();
			}
		}
		else if($this->input->post('submit_Blanquear_Clave'))
		{
			$data = $this->input->post('IDUsuario',TRUE);

			$this->usuarios_model->blanquea_clave($data);

			$this->mensaje  = 'Acción completada exitosamente.';
			$this->index();
		}
		else if($this->input->post('submit_Cambiar_Clave'))
		{
			$this->form_validation->set_rules("ClaveUsuario","Clave Anterior","required|trim|xss_clean|callback_clave_check");
			$this->form_validation->set_rules("NuevaClaveUsuario","Nueva Clave","required|trim|xss_clean|matches[RepetirClaveUsuario]|callback_clave_anterior");
			$this->form_validation->set_rules("RepetirClaveUsuario","Repetición de Clave","required|trim|xss_clean");

			$this->form_validation->set_message('required','El campo %s es obligatorio.');
			$this->form_validation->set_message('clave_check','La clave anterior es incorrecta.');
			$this->form_validation->set_message('clave_anterior','La clave nueva no puede ser igual a la anterior.');
			$this->form_validation->set_message('matches','La clave nueva y la repeticón deben coincidir.');

			if($this->form_validation->run() == FALSE)
			{
				$data['titulo'] = 'Cambiar Clave';
				$data['usuario'] = $this->session->userdata('usuario');
				$data['nombre'] = $this->session->userdata('nombre');
				$data['perfil'] = $this->session->userdata('perfil');
				$this->load->view('Plantilla/Header',$data);
				$this->load->view('Usuarios/CambiaClave');
				$this->load->view('Plantilla/Footer');
			}
			else
			{
				$data = array(
						'IDUsuario' => $this->session->userdata('usuario'),
						'ClaveUsuario' => $this->input->post('NuevaClaveUsuario'));

				$this->usuarios_model->cambia_clave($data);

				$this->mensaje  = 'Acción completada exitosamente.';
				$this->index();
			}
		}
		else
		{

		}
	}

	function clave_anterior()
	{
		if($this->input->post('NuevaClaveUsuario') == $this->input->post('ClaveUsuario'))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function clave_check()
	{
		$data = array('IDUsuario'=>$this->session->userdata('usuario'),
					        //'ClaveUsuario'=>$this->input->post('inputPassword',TRUE)
					        'ClaveUsuario'=>do_hash($this->input->post('ClaveUsuario',TRUE),'md5'));

		$resultado  = $this->usuarios_model->very_user($data);

		foreach ($resultado as $row)
		{
			return true;
		}

		return false;

	}

	function username_check($id)
    {
    	$val = $this->usuarios_model->verif_usuario($id);

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
