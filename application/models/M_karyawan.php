<?php 

/**
 * 
 */
class M_karyawan extends CI_Model
{
	
	public function lihat_data($limit, $start, $search)
	{
		if ($search != '') {
			$tampil = "AND m_karyawan.ID_Kary LIKE '%$search%' OR m_karyawan.NamaKary LIKE '%$search%' OR m_bagian.KodeBagian LIKE '%$search%' OR m_bagian.NamaBagian LIKE '%$search%' OR m_bagian.KepalaBagian LIKE '%$search%' OR m_karyawan.GajiPokok LIKE '%$search%' OR m_karyawan.GajiLembur LIKE '%$search%' ";
		}else{
			$tampil = "";
		}


		$query = $this->db->query("SELECT
										m_karyawan.ID_Karyawan, 
										m_karyawan.ID_Kary, 
										m_karyawan.NamaKary, 
										m_karyawan.BagianKary, 
										m_karyawan.GajiPokok, 
										m_karyawan.GajiLembur, 
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian,
										m_karyawan.StatusKary,
										m_karyawan.StatusKaryawan,
										m_karyawan.FotoKaryawan,
										m_status_karyawan.NamaStatusKaryawan
									FROM
										dbo.m_karyawan
									LEFT JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
									LEFT JOIN
										dbo.m_status_karyawan
										ON
											m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									WHERE m_karyawan.StatusKary = 0 $tampil
									ORDER BY
										m_karyawan.ID_Karyawan DESC
									OFFSET $start ROWS
									FETCH NEXT $limit ROWS ONLY");
		return $query;
	}

	public function get_count($search)
	{
		if ($search != '') {
			$tampil = "AND m_karyawan.ID_Kary LIKE '%$search%' OR m_karyawan.NamaKary LIKE '%$search%' OR m_bagian.KodeBagian LIKE '%$search%' OR m_bagian.NamaBagian LIKE '%$search%' OR m_bagian.KepalaBagian LIKE '%$search%' OR m_karyawan.GajiPokok LIKE '%$search%' OR m_karyawan.GajiLembur LIKE '%$search%' ";
		}else{
			$tampil = "";
		}

		$query = $this->db->query("SELECT
										m_karyawan.ID_Karyawan, 
										m_karyawan.ID_Kary, 
										m_karyawan.NamaKary, 
										m_karyawan.BagianKary, 
										m_karyawan.GajiPokok, 
										m_karyawan.GajiLembur, 
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian,
										m_karyawan.StatusKary
									FROM
										dbo.m_karyawan
										INNER JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
									WHERE m_karyawan.StatusKary = 0 $tampil
									ORDER BY
										m_karyawan.ID_Kary ASC");
		return $query->num_rows();
	}

	public function lihat_data_biasa()
	{
		$query = $this->db->query("SELECT * FROM m_karyawan WHERE StatusKary = 0 ORDER BY NamaKary ASC");
			return $query;
	}

	public function lihat_data_resign()
	{

		$query = $this->db->query("SELECT
										m_karyawan.ID_Karyawan, 
										m_karyawan.ID_Kary, 
										m_karyawan.NamaKary, 
										m_karyawan.BagianKary, 
										m_karyawan.GajiPokok, 
										m_karyawan.GajiLembur, 
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian
									FROM
										dbo.m_karyawan
										INNER JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
									WHERE
										m_karyawan.StatusKary = 1
									ORDER BY
										m_karyawan.ID_Karyawan DESC");
		return $query;
	}

	public function simpan_data($gambar)
	{
		$data = array(
			'ID_Kary' 		=> $this->input->post('nik'),
			'NamaKary'		=> $this->input->post('nama'),
			'BagianKary'	=> $this->input->post('bagian'),
			'GajiPokok'		=> $this->input->post('gajipokok'),
			'GajiLembur'	=> $this->input->post('gajilembur'),
			'StatusKary'	=> 0,
			'StatusKaryawan'=> $this->input->post('status'),
			'FotoKaryawan'	=> $gambar
		);

		$this->db->insert('m_karyawan',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
	{
		$this->db->where('ID_Karyawan',$id);
        $this->db->delete('m_karyawan');
	}
}
 ?>