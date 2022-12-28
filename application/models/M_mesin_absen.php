<?php 

/**
 * 
 */
class M_mesin_absen extends CI_Model
{
	
	public function lihat_data($limit, $start, $period_awal_absen,$period_akhir_absen,$bagian_absen,$karyawan_absen,$status_absen)
	{	

		if ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		else{
			$tampil = "";
		}

		$query = $this->db->query("SELECT
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian, 
										MesinAbsen.ID_Kary, 
										MesinAbsen.Tanggal, 
										MesinAbsen.Jam, 
										MesinAbsen.Nama, 
										m_status_karyawan.NamaStatusKaryawan
									FROM
										dbo.MesinAbsen
										LEFT JOIN
										dbo.m_karyawan
										ON 
											MesinAbsen.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN
										dbo.m_status_karyawan
										ON 
											m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									$tampil
									ORDER BY
										MesinAbsen.Tanggal DESC, 
										MesinAbsen.Jam DESC,
										MesinAbsen.ID_Kary ASC,
										MesinAbsen.Nama ASC
									OFFSET $start ROWS
									FETCH NEXT $limit ROWS ONLY");
		return $query;
	}

	public function get_count($period_awal_absen,$period_akhir_absen,$bagian_absen, $karyawan_absen,$status_absen)
	{
		if ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		else{
			$tampil = "";
		}


		$query = $this->db->query("SELECT
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian, 
										MesinAbsen.ID_Kary, 
										MesinAbsen.Tanggal, 
										MesinAbsen.Jam, 
										MesinAbsen.Nama, 
										m_status_karyawan.NamaStatusKaryawan
									FROM
										dbo.MesinAbsen
										LEFT JOIN
										dbo.m_karyawan
										ON 
											MesinAbsen.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN
										dbo.m_status_karyawan
										ON 
											m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									$tampil");
		return $query->num_rows();
	}

	public function lihat_data_biasa($period_awal_absen,$period_akhir_absen,$bagian_absen, $karyawan_absen,$status_absen)
	{
		if ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE MesinAbsen.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE MesinAbsen.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		else{
			$tampil = "";
		}


		$query = $this->db->query("SELECT
										m_bagian.KodeBagian, 
										m_bagian.NamaBagian, 
										m_bagian.KepalaBagian, 
										MesinAbsen.ID_Kary, 
										MesinAbsen.Tanggal, 
										MesinAbsen.Jam, 
										MesinAbsen.Nama, 
										m_status_karyawan.NamaStatusKaryawan
									FROM
										dbo.MesinAbsen
										LEFT JOIN
										dbo.m_karyawan
										ON 
											MesinAbsen.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN
										dbo.m_bagian
										ON 
											m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN
										dbo.m_status_karyawan
										ON 
											m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									$tampil
									ORDER BY
										MesinAbsen.Tanggal DESC, 
										MesinAbsen.Jam DESC,
										MesinAbsen.ID_Kary ASC,
										MesinAbsen.Nama ASC ");
		return $query;
	}
}

 ?>