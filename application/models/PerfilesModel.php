<?php 

/**
 * 
 */
class PerfilesModel extends CI_Model
{
	
	public function get_perfiles()
	{
		$sql = "SELECT * FROM perfiles";
		return $this->db->get("perfiles");
	}
}

 ?>