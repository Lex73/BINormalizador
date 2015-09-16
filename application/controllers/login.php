<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->session->unset_userdata('usuario');
		$this->load->model('usuarios_model');
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
			$data = array('IDUsuarios'=>$this->input->post('inputUser',TRUE),
										'CLAVUsuario'=>$this->input->post('inputPassword',TRUE));
						  		  //'CLAVUsuario'=>do_hash($this->input->post('inputPassword',TRUE),'md5'));

			$resultado  = $this->usuarios_model->very_user($data);

			foreach ($resultado as $row)
			{
				$cuenta = $this->usuarios_model->get_cuenta($row->IDCuenta);

				$datos = array('usuario'=> $row->IDUsuarios,
										   'nombre'=> $row->NOMBUsuario,
										   'perfil'=> $row->PERFUsuario,
										 	 'IDcuenta'=> $row->IDCuenta,
										 	 'cuenta'=> $cuenta);

				$this->session->set_userdata($datos);
				redirect(base_url().'Home/');
				return;
			}

				$data = array('mensaje' => 'El usuario y/o la contraseña son incorrectos.');
				$this->load->view('Login/Index',$data);
		}
		else
		{
			$this->index();
		}
	}
}
?>
