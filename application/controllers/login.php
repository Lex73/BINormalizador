<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->session->unset_userdata('usuario');
		//$this->session->sess_destroy();
		$this->load->model('Usuarios_model');
	}

	public function index()
	{
		$data['titulo'] = 'Login';
		$this->load->view('Login/Index',$data);
	}

	public function ingresar()
	{
		if($this->input->post('submit_login'))
		{
			$data = array('IDUsuarios'=>$this->input->post('inputUser',TRUE));
			$clave = do_hash($this->input->post('inputPassword',TRUE),'md5');

			$resultado  = $this->Usuarios_model->very_user($data);

			foreach ($resultado as $row)
			{
				if ($clave == $row->CLAVUsuario)
				{
						$cuenta = $this->Usuarios_model->get_cuenta($row->IDCuenta);

						$datos = array('usuario'=> $row->IDUsuarios,
												   'nombre'=> $row->NOMBUsuario,
												   'perfil'=> $row->PERFUsuario,
												   'IDcuenta'=> $row->IDCuenta,
												   'cuenta'=> $cuenta,
												   'cambia'=> $row->Cambia);

						$this->session->set_userdata($datos);
						redirect(base_url().'Home/');
						return;
				}
				else
				{
							$data = array('mensaje' => 'El usuario y/o la contraseña son incorrectos.',
														'titulo' => 'Login');
							$this->load->view('Login/Index',$data);
				}
			}
		}
		else
		{
			$this->index();
		}
	}
}
?>
