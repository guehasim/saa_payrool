<?php 

/**
 * 
 */
class M_status_karyawan extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_status_karyawan ORDER BY ID_StatusKaryawan DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'KodeStatusKaryawan' 	=> $this->input->post('kode'),
			'NamaStatusKaryawan'	=> $this->input->post('nama')
		);
		$this->db->insert('m_status_karyawan',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function delete_data($id)
	{
		$this->db->where('ID_StatusKaryawan',$id);
        $this->db->delete('m_status_karyawan');
	}
}
 ?>