<?php 

/**
 * 
 */
class Usuarios extends CI_Controller
{
	
	public function index()
	{	
		//llamamos los modelos
		$this->load->model('UsuariosModel');
		$this->load->model('MenusModel');
		$this->load->model('PerfilesModel');
		//validamos las session y el perfil
		if ($this->session->userdata('login')) {
			if ($this->session->userdata('perfil') == 1) {
				//traemos el usuario de las cooquies
				$user = $this->session->userdata('user');
				//traemos los datos del usuario
				$data_user = $this->UsuariosModel->validar_usuario($user);
				$nombre = "";
				foreach ($data_user->result() as $key) {
					$nombre = $key->nombres;
				}
				//traemos los usuarios
				$alluser = $this->UsuariosModel->get_users();
				//traemos los perfiles
				$perfiles = $this->PerfilesModel->get_perfiles();
				//traemos los menus
				$perfil = $this->session->userdata('perfil');
				$menus = $this->MenusModel->get_menus($perfil);
				//array de la vista
				$arr_view = array('nombre' => $nombre,'menus'=>$menus,'perfiles'=>$perfiles,'alluser'=>$alluser);
				//vista
				$this->load->view('UsuariosView',$arr_view);
			}else{
				$this->session->sess_destroy();
				header("Location: " . base_url());
			}
		}else{
			$this->session->sess_destroy();
			header("Location: " . base_url());
		}
	}

	//metodo para crear usuario
	public function crear_usuario()
	{
		$this->load->model('UsuariosModel');
		$nombre = $this->input->POST('nombre');
		$nit = $this->input->POST('nit');
		$correo = $this->input->POST('correo');
		$pass = $this->input->POST('pass');
		$perfil = $this->input->POST('perfil');
		try {
			$this->db->trans_begin();
			$this->UsuariosModel->insert($nombre,$nit,$correo,$pass,$perfil);
			$this->db->trans_commit();
			echo "bien";

		} catch (PDOException $e) {
			$this->db->trans_rollback();
			echo "mal";
		}
		
	}
	//metodo para borrar usuario
	public function borrar_usuario()
	{
		$this->load->model('UsuariosModel');
		$nit = $this->input->POST('nit');
		try {
			$this->db->trans_begin();
			$this->UsuariosModel->delete($nit);
			$this->db->trans_commit();
			echo "bien";
		} catch (PDOException $e) {
			$this->db->trans_rollback();
			echo "mal";
		}
	}

	public function cargar_info_user()
	{
		//llamamos los modelos
		$this->load->model('UsuariosModel');
		$this->load->model('MenusModel');
		$this->load->model('PerfilesModel');
		//validamos las session y el perfil
		if ($this->session->userdata('login')) {
			if ($this->session->userdata('perfil') == 1) {
				//traemos el usuario de las cooquies
				$user = $this->session->userdata('user');
				//parametros por url
				$id_user = $this->input->GET('id');
				//traemos los datos del usuario
				$data_user = $this->UsuariosModel->validar_usuario($user);
				$nombre = "";
				foreach ($data_user->result() as $key) {
					$nombre = $key->nombres;
				}
				//traemos los usuarios
				$data_user = $this->UsuariosModel->get_users_by_id($id_user);
				//traemos los perfiles
				$perfiles = $this->PerfilesModel->get_perfiles();
				//traemos los menus
				$perfil = $this->session->userdata('perfil');
				$menus = $this->MenusModel->get_menus($perfil);
				//array de la vista
				$arr_view = array('nombre' => $nombre,'menus'=>$menus,'perfiles'=>$perfiles,'data_user'=>$data_user);
				//vista
				$this->load->view('EditarUsuariosView',$arr_view);
			}else{
				$this->session->sess_destroy();
				header("Location: " . base_url());
			}
		}else{
			$this->session->sess_destroy();
			header("Location: " . base_url());
		}
	}

	//funcion para editar usuarios
	public function editar_usuario()
	{
		$this->load->model('UsuariosModel');
		$nombre = $this->input->POST('nombre');
		$nit = $this->input->POST('nit');
		$correo = $this->input->POST('correo');
		$pass = $this->input->POST('pass');
		$perfil = $this->input->POST('perfil');
		$id = $this->input->POST('id');
		$data = array('nombres' => $nombre, 'nit'=>$nit,'correo'=>$correo,'password'=>$pass,'perfil'=>$perfil);
		try {
			$this->db->trans_begin();
			$this->UsuariosModel->update($id,$data);
			$this->db->trans_commit();
			echo "bien";
		} catch (PDOException $e) {
			$this->db->trans_rollback();
			echo "mal";
		}
	}

	public function load_tabla()
	{
		//Cargamos los modelos
		$this->load->model('UsuariosModel');
		//traemos los usuarios
		$alluser = $this->UsuariosModel->get_users();
		foreach ($alluser->result() as $key) {
			echo '
				<tr align="center">
                        <td>'.$key->nit.'</td>
                        <td>'.$key->nombres.'</td>
                        <td>'.$key->correo.'</td>
                        <td>'.$key->perfil.'</td>
                        <td>
                          <a href="#" onclick="del_user('.$key->nit.');"><i class="far btn btn-outline-danger fa-trash-alt"></i></a>
                          <a href="'.base_url().'usuarios/cargar_info_user?id='.$key->id_user.'"><i class="far btn btn-outline-info fa-edit"></i></a>
                        </td>
                      </tr>
			';
		}
	}
}

 ?>