<?php 


class M_lembur extends CI_Model
{
	
	public function lihat_data($limit, $start, $period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur)
	{

		if ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND ";
		}
		elseif($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur == '' && $status_lembur == ''){
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND ";
		}
		elseif($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur != ''){
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur != '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur == '' && $status_lembur != ''){
			$tampil = "m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur == '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur != '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		else{
			$tampil = "";
		}

		$query = $this->db->query("SELECT
										tbl_kalkulasi.ID_Kalkulasi,
										tbl_kalkulasi.ID_Kary,
										m_karyawan.NamaKary,
										tbl_kalkulasi.Tanggal,
										tbl_kalkulasi.JamIn,
										tbl_kalkulasi.JamOut,
										tbl_kalkulasi.KalkulasiJam,
										tbl_kalkulasi.KalkulasiLembur,
										tbl_kalkulasi.ValidasiLembur,
										m_bagian.NamaBagian,
										m_status_karyawan.NamaStatusKaryawan 
									FROM
										dbo.tbl_kalkulasi
										LEFT JOIN dbo.m_karyawan ON tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN dbo.m_bagian ON m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN dbo.m_status_karyawan ON m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									WHERE
										$tampil tbl_kalkulasi.KalkulasiLembur <> 0 
									ORDER BY tbl_kalkulasi.Tanggal DESC
									OFFSET $start ROWS
									FETCH NEXT $limit ROWS ONLY");
		return $query;
	}

	public function get_count($period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur)
	{
		if ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND ";
		}
		elseif($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur == '' && $status_lembur == ''){
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND ";
		}
		elseif($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur != ''){
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur != '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur == '' && $status_lembur != ''){
			$tampil = "m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur == '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur != '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		else{
			$tampil = "";
		}

		$query = $this->db->query("SELECT
										tbl_kalkulasi.ID_Kalkulasi,
										tbl_kalkulasi.ID_Kary,
										m_karyawan.NamaKary,
										tbl_kalkulasi.Tanggal,
										tbl_kalkulasi.JamIn,
										tbl_kalkulasi.JamOut,
										tbl_kalkulasi.KalkulasiJam,
										tbl_kalkulasi.KalkulasiLembur,
										tbl_kalkulasi.ValidasiLembur,
										m_bagian.NamaBagian,
										m_status_karyawan.NamaStatusKaryawan 
									FROM
										dbo.tbl_kalkulasi
										LEFT JOIN dbo.m_karyawan ON tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN dbo.m_bagian ON m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN dbo.m_status_karyawan ON m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									WHERE
										$tampil tbl_kalkulasi.KalkulasiLembur <> 0 
									ORDER BY tbl_kalkulasi.Tanggal DESC");
		return $query->num_rows();
	}

	public function lihat_data_biasa($period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur)
	{
		if ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND ";
		}
		elseif($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur == '' && $status_lembur == ''){
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND ";
		}
		elseif($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur != ''){
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur != '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur == '' && $status_lembur != ''){
			$tampil = "m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur == '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND ";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur == '' && $karyawan_lembur != '' && $status_lembur == '') {
			$tampil = "tbl_kalkulasi.ID_Kary = '$karyawan_lembur' AND";
		}
		elseif ($period_awal_lembur == '1970-01-01' && $period_akhir_lembur == '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur != '') {
			$tampil = "m_karyawan.BagianKary = '$bagian_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		elseif ($period_awal_lembur != '1970-01-01' && $period_akhir_lembur != '1970-01-01' && $bagian_lembur != '' && $karyawan_lembur == '' && $status_lembur != '') {
			$tampil = "tbl_kalkulasi.Tanggal BETWEEN '$period_awal_lembur' AND '$period_akhir_lembur' AND m_karyawan.BagianKary = '$bagian_lembur' AND m_karyawan.StatusKaryawan = '$status_lembur' AND ";
		}
		else{
			$tampil = "";
		}

		$query = $this->db->query("SELECT
										tbl_kalkulasi.ID_Kalkulasi,
										tbl_kalkulasi.ID_Kary,
										m_karyawan.NamaKary,
										tbl_kalkulasi.Tanggal,
										tbl_kalkulasi.JamIn,
										tbl_kalkulasi.JamOut,
										tbl_kalkulasi.KalkulasiJam,
										tbl_kalkulasi.KalkulasiLembur,
										tbl_kalkulasi.ValidasiLembur,
										m_bagian.NamaBagian,
										m_status_karyawan.NamaStatusKaryawan 
									FROM
										dbo.tbl_kalkulasi
										LEFT JOIN dbo.m_karyawan ON tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN dbo.m_bagian ON m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN dbo.m_status_karyawan ON m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									WHERE
										$tampil tbl_kalkulasi.KalkulasiLembur <> 0 
									ORDER BY tbl_kalkulasi.Tanggal DESC");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}
 ?>