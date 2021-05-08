<?php 

/**
 * 
 */
class ProductosModel extends CI_Model
{
	
	//Metodo que obtiene todos los productos
	public function get_productos()
	{
		return $this->db->get("productos");
	}
}

 ?>