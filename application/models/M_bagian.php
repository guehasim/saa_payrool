<?php 

/**
 * 
 */
class M_bagian extends CI_Model
{
	
	public function lihat_data($limit,$start,$search)
	{
		if ($search != '') {
			$tampil = "WHERE m_bagian.KodeBagian LIKE '%$search%' OR m_bagian.NamaBagian LIKE '%$search%' OR m_bagian.KepalaBagian LIKE '%$search%' ";
		}else{
			$tampil = "";
		}
		$query = $this->db->query("SELECT
										m_bagian.ID_Bagian, 
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian
									FROM
										dbo.m_bagian
									$tampil
									ORDER BY
										m_bagian.ID_Bagian DESC
									OFFSET $start ROWS
									FETCH NEXT $limit ROWS ONLY");
		return $query;
	}

	public function get_count($search)
	{
		if ($search != '') {
			$tampil = "WHERE m_bagian.KodeBagian LIKE '%$search%' OR m_bagian.NamaBagian LIKE '%$search%' OR m_bagian.KepalaBagian LIKE '%$search%' ";
		}else{
			$tampil = "";
		}

		$query = $this->db->query("SELECT
										m_bagian.ID_Bagian, 
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian
									FROM
										dbo.m_bagian
									$tampil
									ORDER BY
										m_bagian.ID_Bagian DESC");
		return $query->num_rows();
	}

	public function lihat_bagian()
	{
		$query = $this->db->query("SELECT * FROM m_bagian ORDER BY KodeBagian ASC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'KodeBagian' 	=> $this->input->post('kode'),
			'NamaBagian'	=> $this->input->post('nama'),
			'KepalaBagian'	=> $this->input->post('kabag')
		);

		$this->db->insert('m_bagian',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function delete_data($id)
	{
		$this->db->where('ID_Bagian',$id);
        $this->db->delete('m_bagian');
	}
}
 ?>