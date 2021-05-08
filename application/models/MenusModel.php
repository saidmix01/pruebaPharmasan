<?php 

/**
 * 
 */
class MenusModel extends CI_Model
{
	
	public function get_menus($perfil)
	{
		$sql = "SELECT  m.menu,m.url,m.icon FROM menu_perfil mp INNER JOIN perfiles p ON p.id_perfil = mp.perfil INNER JOIN menus m ON m.id_menu = mp.menu WHERE p.id_perfil = ".$perfil;
		return $this->db->query($sql);
	}
}

 ?>