<?php 

/**
 * 
 */
class Productos extends CI_Controller
{
	
	public function index()
	{
		//llamamos los modelos
		$this->load->model('ProductosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('MenusModel');
		//validamos las session y el perfil
		if ($this->session->userdata('login')) {
			if ($this->session->userdata('perfil') == 1 || $this->session->userdata('perfil') == 2) {
				//traemos el usuario de las cooquies
				$user = $this->session->userdata('user');
				//traemos los datos del usuario
				$data_user = $this->UsuariosModel->validar_usuario($user);
				$nombre = "";
				foreach ($data_user->result() as $key) {
					$nombre = $key->nombres;
				}
				//traemos los usuarios
				$allprod = $this->ProductosModel->get_productos();
				//traemos los menus
				$perfil = $this->session->userdata('perfil');
				$menus = $this->MenusModel->get_menus($perfil);
				//array de la vista
				$arr_view = array('nombre' => $nombre,'menus'=>$menus,'allprod'=>$allprod);
				//vista
				$this->load->view('ProductosView',$arr_view);
			}else{
				$this->session->sess_destroy();
				header("Location: " . base_url());
			}
		}else{
			$this->session->sess_destroy();
			header("Location: " . base_url());
		}
	}
}

 ?>