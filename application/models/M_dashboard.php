<?php 

/**
 * 
 */
class M_dashboard extends CI_Model
{
	
	public function total_user()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM m_user");
		return $query;
	}

	public function total_bagian()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM m_bagian");
		return $query;
	}

	public function total_karyawan()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM m_karyawan WHERE StatusKary = 0");
		return $query;
	}

	public function lihat_chart()
	{
		// $tahun = date('Y');
		$query = $this->db->query("SELECT
										m_periode.NamaPeriode,
										COUNT(ID_Kary) AS total
									FROM
										dbo.tbl_kalkulasi
										INNER JOIN
										dbo.m_periode
										ON 
											tbl_kalkulasi.ID_periode = m_periode.ID_periode
									WHERE
										tbl_kalkulasi.JamIn IS NOT NULL AND
										tbl_kalkulasi.JamOut IS NOT NULL
										
									GROUP BY
										m_periode.NamaPeriode");
		return $query;
	}
}
 ?>