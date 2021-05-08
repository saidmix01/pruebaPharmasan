<?php 

/**
 * CLASE QUE CONTROLA EL LOGIN DE LA PLATAFORMA
 */
class login extends CI_Controller
{
	//Carga la vista del login
	public function index()
	{
		$this->load->view("LoginView");
	}

	//Logea al usuario con los datos ingresados
	public function logear()
	{
		//modelo usuarios
		$this->load->model("UsuariosModel");
		//modelo menus
		$this->load->model("MenusModel");
		//Validamos si hay datos se session
		if (!$this->session->userdata('login')) {
			//recibimos los datos del usuario
			$user = $this->input->POST('user');
			$pass = $this->input->POST('pass');
			$data_user = $this->UsuariosModel->validar_usuario($user);
			$user_db = "";
			$pass_db = "";
			$perfil = "";
			$nombre = "";
			$correo = "";
			foreach ($data_user->result() as $key) {
				$user_db = $key->nit;
				$pass_db = $key->password;
				$perfil = $key->perfil;
				$nombre = $key->nombres;
				$correo = $key->correo;
			}
			if ($user == $user_db) {
				if ($pass == $pass_db) {
					//Creamos el array de las cookies
					$arr_cookies = array('user' => $user_db, 'perfil' => $perfil, 'login' => true,'pass'=>$pass);
					//Cargamos el array de cookies
					$this->session->set_userdata($arr_cookies);
					//cargarmos los menus del perfil
					$menus = $this->MenusModel->get_menus($perfil);
					//array de datos para la vista
					$data_view = array('nombre' => $nombre,'menus'=>$menus);
					//cargamos la vista
					$this->load->view("HomeView",$data_view);
				}else{
					header("Location: " . base_url() . "login?log=err");
				}
			}else{
				header("Location: " . base_url() . "login?log=err");
			}
		}else{
			//traemos los datos de session
			$user = $this->session->userdata('user');
			$pass = $this->session->userdata('pass');
			//traemos los datos de usuario de la db
			$data_user = $this->UsuariosModel->validar_usuario($user);
			$user_db = "";
			$pass_db = "";
			$perfil = "";
			$nombre = "";
			$correo = "";
			foreach ($data_user->result() as $key) {
				$user_db = $key->nit;
				$pass_db = $key->password;
				$perfil = $key->perfil;
				$nombre = $key->nombres;
				$correo = $key->correo;
			}
			if ($user == $user_db) {
				if ($pass == $pass_db) {
					//cargarmos los menus del perfil
					$menus = $this->MenusModel->get_menus($perfil);
					//array de datos para la vista
					$data_view = array('nombre' => $nombre,'menus'=>$menus);
					//cargamos la vista
					$this->load->view("HomeView",$data_view);
				}else{
					echo "error";
					$this->session->sess_destroy();
					header("Location: " . base_url() . "login?log=err");
				}
			}else{
				$this->session->sess_destroy();
				header("Location: " . base_url() . "login?log=err");
			}
		}
	}

	public function logout()
	{
		//se destruye la sessions
		$this->session->sess_destroy();
		header("Location: " . base_url());
	}
}

 ?>