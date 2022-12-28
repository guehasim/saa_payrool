<?php 

/**
 * 
 */
class Import_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function insert($data)
	{
		$res = $this->db->insert_batch('tbl_temp_import',$data);
		if ($res) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
 ?>