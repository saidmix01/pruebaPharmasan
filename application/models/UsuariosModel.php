<?php 

/**
 * 
 */
class UsuariosModel extends CI_Model
{
	//Metodo que valida los datos del usuario
	public function validar_usuario(string $nit)
	{
		return $this->db->get_where("usuarios",array('nit' => $nit));
	}

	//Metodo que creea usuarios
	public function insert($nombres,$nit,$correo,$pass,$perfil)
	{
		if ($this->db->insert("usuarios",array('nombres'=>$nombres,'nit'=>$nit,'correo'=>$correo,'password'=>$pass,'perfil'=>$perfil))) {
			return true;
		}else{
			return false;
		}
	}

	//Metodo para borrar usuario
	public function delete($nit)
	{
		
		if($this->db->delete('usuarios',array('nit'=>$nit))){
			return true;
		}else{
			return false;
		}
	}

	//Metodo para editar usuario
	public function update($id,$data)
	{
		$this->db->where('id_user',$id);
		$this->db->update('usuarios',$data);
	}

	//Metodo que lista todos los usuarios
	public function get_users()
	{
		$sql = "SELECT u.nombres,u.nit,u.correo,p.perfil,u.id_user FROM usuarios u INNER JOIN perfiles p ON p.id_perfil = u.perfil";
		return $this->db->query($sql);
	}

	//Metodo para traer la info de un usuario por el id
	public function get_users_by_id($id)
	{
		$sql = "SELECT u.nombres,u.nit,u.correo,p.perfil,u.id_user,p.id_perfil,u.password FROM usuarios u INNER JOIN perfiles p ON p.id_perfil = u.perfil
		WHERE id_user = ".$id;
		return $this->db->query($sql);
	}
}

 ?>