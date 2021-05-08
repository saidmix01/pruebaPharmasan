<?php 

/**
 * 
 */
class Clientes extends CI_Controller
{
	
	public function index()
	{	
		//llamamos los modelos
		$this->load->model('UsuariosModel');
		$this->load->model('ClientesModel');
		$this->load->model('MenusModel');
		//validamos las session y el perfil
		if ($this->session->userdata('login')) {
			if ($this->session->userdata('perfil') == 1  || $this->session->userdata('perfil') == 2) {
				//traemos el usuario de las cooquies
				$user = $this->session->userdata('user');
				//traemos los datos del usuario
				$data_user = $this->UsuariosModel->validar_usuario($user);
				$nombre = "";
				foreach ($data_user->result() as $key) {
					$nombre = $key->nombres;
				}
				//traemos los usuarios
				$allclientes = $this->ClientesModel->get_clientes();
				//traemos los menus
				$perfil = $this->session->userdata('perfil');
				$menus = $this->MenusModel->get_menus($perfil);
				//array de la vista
				$arr_view = array('nombre' => $nombre,'menus'=>$menus,'allclientes'=>$allclientes);
				//vista
				$this->load->view('ClientesView',$arr_view);
			}else{
				$this->session->sess_destroy();
				header("Location: " . base_url());
			}
		}else{
			$this->session->sess_destroy();
			header("Location: " . base_url());
		}
	}

	//metodo para crear clientes
	public function crear_cliente()
	{
		$this->load->model('ClientesModel');
		$nombre = $this->input->POST('nombre');
		$nit = $this->input->POST('nit');
		$correo = $this->input->POST('correo');
		$direccion = $this->input->POST('direccion');
		try {
			$this->db->trans_begin();
			$this->ClientesModel->insert($nombre,$nit,$correo,$direccion);
			$this->db->trans_commit();
			echo "bien";

		} catch (PDOException $e) {
			$this->db->trans_rollback();
			echo "mal";
		}
		
	}
	//metodo para borrar usuario
	public function borrar_cliente()
	{
		$this->load->model('ClientesModel');
		$id = $this->input->POST('id');
		try {
			$this->db->trans_begin();
			$this->ClientesModel->delete($id);
			$this->db->trans_commit();
			echo "bien";
		} catch (PDOException $e) {
			$this->db->trans_rollback();
			echo "mal";
		}
	}

	public function cargar_info_cliente()
	{
		//llamamos los modelos
		$this->load->model('UsuariosModel');
		$this->load->model('MenusModel');
		$this->load->model('ClientesModel');
		//validamos las session y el perfil
		if ($this->session->userdata('login')) {
			if ($this->session->userdata('perfil') == 1 || $this->session->userdata('perfil') == 2) {
				//traemos el usuario de las cooquies
				$user = $this->session->userdata('user');
				//parametros por url
				$id_client = $this->input->GET('id');
				//traemos los datos del usuario
				$data_user = $this->UsuariosModel->validar_usuario($user);
				$nombre = "";
				foreach ($data_user->result() as $key) {
					$nombre = $key->nombres;
				}
				//traemos los usuarios
				$data_client = $this->ClientesModel->get_cliente_by_id($id_client);
				//traemos los menus
				$perfil = $this->session->userdata('perfil');
				$menus = $this->MenusModel->get_menus($perfil);
				//array de la vista
				$arr_view = array('nombre' => $nombre,'menus'=>$menus,'data_client'=>$data_client);
				//vista
				$this->load->view('EditarClientesView',$arr_view);
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
	public function editar_cliente()
	{
		$this->load->model('ClientesModel');
		$nombre = $this->input->POST('nombre');
		$nit = $this->input->POST('nit');
		$correo = $this->input->POST('correo');
		$direccion = $this->input->POST('direccion');
		$id = $this->input->POST('id');
		$data = array('nombres' => $nombre, 'nit'=>$nit,'correo'=>$correo,"direccion"=>$direccion);
		try {
			$this->db->trans_begin();
			$this->ClientesModel->update($id,$data);
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
		$this->load->model('ClientesModel');
		//traemos los usuarios
		$allclientes = $this->ClientesModel->get_clientes();
		foreach ($allclientes->result() as $key) {
			echo '
				<tr align="center">
                        <td>'.$key->nit.'</td>
                        <td>'.$key->nombres.'</td>
                        <td>'.$key->correo.'</td>
                        <td>'.$key->direccion.'</td>
                        <td>
                          <a href="#" onclick="del_user('.$key->id_client.');"><i class="far btn btn-outline-danger fa-trash-alt"></i></a>
                          <a href="'.base_url().'usuarios/cargar_info_cliente?id='.$key->id_client.'"><i class="far btn btn-outline-info fa-edit"></i></a>
                        </td>
                      </tr>
			';
		}
	}
}

 ?>