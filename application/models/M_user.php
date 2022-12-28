<?php 


class M_user extends CI_Model
{

	//====================================== admin
	
	public function lihat_user()
	{
		$query = $this->db->query("SELECT * FROM m_user ORDER BY ID_User DESC");
		return $query;
	}

	public function simpan_user()
	{
		$data = array(
			'NamaUser'	=> $this->input->post('nama'),
			'Username' 	=> $this->input->post('user'),
			'PassUser'	=> sha1(md5($this->input->post('pass')))
		);

		$this->db->insert('m_user',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function delete_user($id)
	{
		$this->db->where('ID_User',$id);
        $this->db->delete('m_user');
	}
}
 ?>