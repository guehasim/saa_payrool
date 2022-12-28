<?php 

/**
 * 
 */
class M_tunjangan extends CI_Model
{
	
	public function lihat_data($periode,$jenis)
	{
		$query = $this->db->query("SELECT
										m_status_karyawan.NamaStatusKaryawan, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian, 
										tbl_tunjangan.ID_Kary, 
										m_karyawan.NamaKary, 
										tbl_tunjangan.TotalTunjangan, 
										tbl_tunjangan.KetTunjangan, 
										tbl_tunjangan.JenisTunjangan, 
										tbl_tunjangan.ID_User, 
										tbl_tunjangan.ID_periode, 
										tbl_tunjangan.ID_Tunjangan
									FROM
										dbo.tbl_tunjangan
										LEFT JOIN
										dbo.m_karyawan
										ON 
											tbl_tunjangan.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN
										dbo.m_status_karyawan
										ON 
											m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
										LEFT JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
									WHERE
										tbl_tunjangan.ID_periode = '$periode' AND
										tbl_tunjangan.JenisTunjangan = '$jenis' 
									ORDER BY tbl_tunjangan.ID_Tunjangan DESC");
		return $query;
	}

	public function simpan_data()
	{	
		$data = array(
			'ID_periode'	=> $this->session->userdata('ses_tunjangan_periode'),
			'ID_Kary'		=> $this->input->post('karyawan'),
			'JenisTunjangan'=> $this->input->post('jenis'),
			'TotalTunjangan'=> $this->input->post('total'),
			'ID_User'		=> $this->session->userdata('ses_IdUser'),
			'KetTunjangan'	=> $this->input->post('keterangan')
		);
		$this->db->insert('tbl_tunjangan',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
	{
		$this->db->where('ID_Tunjangan',$id);
        $this->db->delete('tbl_tunjangan');
	}

}
 ?>