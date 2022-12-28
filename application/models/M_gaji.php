<?php 

/**
 * 
 */
class M_gaji extends CI_Model
{

	public function lihat_data($id, $limit, $start)
	{
		$query = $this->db->query("SELECT
										temp_gaji.ID_Kary, 
										temp_gaji.NamaKary, 
										temp_gaji.GajiJam, 
										temp_gaji.LemburJam, 
										temp_gaji.TotHadir, 
										temp_gaji.TotLembur, 
										temp_gaji.GajiHadir, 
										temp_gaji.GajiLembur, 
										temp_gaji.TotGajiAll, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian, 
										temp_gaji.Tunjangan, 
										temp_gaji.Potongan, 
										m_status_karyawan.NamaStatusKaryawan
									FROM
										dbo.temp_gaji
										LEFT JOIN
										dbo.m_karyawan
										ON 
											temp_gaji.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN
										dbo.m_status_karyawan
										ON 
											m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									WHERE
										temp_gaji.ID_User = $id
									ORDER BY
										temp_gaji.ID_Kary ASC
									OFFSET $start ROWS
									FETCH NEXT $limit ROWS ONLY");
		return $query;
	}

	public function get_count($id)
	{
		$query = $this->db->query("SELECT * FROM temp_gaji WHERE temp_gaji.ID_User = $id ORDER BY temp_gaji.ID_Kary");
		return $query->num_rows();
	}

	public function lihat_data_biasa($id)
	{
		$query = $this->db->query("SELECT
										temp_gaji.ID_Kary, 
										temp_gaji.NamaKary, 
										temp_gaji.GajiJam, 
										temp_gaji.LemburJam, 
										temp_gaji.TotHadir, 
										temp_gaji.TotLembur, 
										temp_gaji.GajiHadir, 
										temp_gaji.GajiLembur, 
										temp_gaji.TotGajiAll, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian, 
										temp_gaji.Tunjangan, 
										temp_gaji.Potongan, 
										m_status_karyawan.NamaStatusKaryawan
									FROM
										dbo.temp_gaji
										LEFT JOIN
										dbo.m_karyawan
										ON 
											temp_gaji.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN
										dbo.m_status_karyawan
										ON 
											m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									WHERE
										temp_gaji.ID_User = $id
									ORDER BY
										temp_gaji.ID_Kary ASC");
		return $query;
	}
	
	public function simpan_identitas()
	{		

		$query = $this->db->query("INSERT INTO temp_gaji (ID_User,ID_Kary,NamaKary,GajiJam,LemburJam,TotHadir,TotLembur,GajiHadir,GajiLembur,TotGajiAll,Tunjangan,Potongan)
			SELECT
				1,
				m_karyawan.ID_Kary,
				m_karyawan.NamaKary, 
				m_karyawan.GajiPokok, 
				m_karyawan.GajiLembur, 
				0, 
				0,
				0,
				0,
				0,
				0,
				0
			FROM
				dbo.m_karyawan
			WHERE
				m_karyawan.StatusKary = 0");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}
 ?>