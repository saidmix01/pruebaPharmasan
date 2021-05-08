<?php 

/**
 * 
 */
class ClientesModel extends CI_Model
{

	//Metodo que creea clientes
	public function insert($nombres,$nit,$correo,$direccion)
	{
		if ($this->db->insert("clientes",array('nombres'=>$nombres,'nit'=>$nit,'correo'=>$correo,'direccion'=>$direccion))) {
			return true;
		}else{
			return false;
		}
	}

	//Metodo para borrar clientes
	public function delete($id)
	{
		
		if($this->db->delete('clientes',array('id_client'=>$id))){
			return true;
		}else{
			return false;
		}
	}

	//Metodo para editar clientes
	public function update($id,$data)
	{
		$this->db->where('id_client',$id);
		$this->db->update('clientes',$data);
	}

	//Metodo que lista todos los clientes
	public function get_clientes()
	{
		return $this->db->get("clientes");
	}

	//Metodo para traer la info de un cliente por el id
	public function get_cliente_by_id($id)
	{
		return $this->db->get_where("clientes",array('id_client'=>$id));
	}
}

 ?>