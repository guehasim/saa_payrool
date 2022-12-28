<?php 


class M_absen extends CI_Model
{
	
	public function lihat_data($limit, $start, $period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen)
	{
		if ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen == ''){
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' ";
		}
		elseif($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != ''){
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != ''){
			$tampil = "WHERE m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.ID_Kary = '$karyawan_absen'";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
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
										m_bagian.NamaBagian,
										m_status_karyawan.NamaStatusKaryawan 
									FROM
										dbo.tbl_kalkulasi
										LEFT JOIN dbo.m_karyawan ON tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN dbo.m_bagian ON m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN dbo.m_status_karyawan ON m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									$tampil 
									ORDER BY
										tbl_kalkulasi.Tanggal DESC,
										tbl_kalkulasi.ID_Kary ASC
									OFFSET $start ROWS
									FETCH NEXT $limit ROWS ONLY");
		return $query;
	}

	public function get_count($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen)
	{
		if ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen == ''){
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' ";
		}
		elseif($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != ''){
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != ''){
			$tampil = "WHERE m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.ID_Kary = '$karyawan_absen'";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
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
										m_bagian.NamaBagian,
										m_status_karyawan.NamaStatusKaryawan 
									FROM
										dbo.tbl_kalkulasi
										LEFT JOIN dbo.m_karyawan ON tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN dbo.m_bagian ON m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN dbo.m_status_karyawan ON m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									$tampil 
									ORDER BY
										tbl_kalkulasi.Tanggal DESC,
										tbl_kalkulasi.ID_Kary ASC");
		return $query->num_rows();
	}

	public function lihat_data_biasa($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen)
	{
		if ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen == ''){
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' ";
		}
		elseif($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen != ''){
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.ID_Kary = '$karyawan_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen == '' && $status_absen != ''){
			$tampil = "WHERE m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND tbl_kalkulasi.ID_Kary = '$karyawan_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen == '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' ";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen == '' && $karyawan_absen != '' && $status_absen == '') {
			$tampil = "WHERE tbl_kalkulasi.ID_Kary = '$karyawan_absen'";
		}
		elseif ($period_awal_absen == '1970-01-01' && $period_akhir_absen == '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
		}
		elseif ($period_awal_absen != '1970-01-01' && $period_akhir_absen != '1970-01-01' && $bagian_absen != '' && $karyawan_absen == '' && $status_absen != '') {
			$tampil = "WHERE tbl_kalkulasi.Tanggal BETWEEN '$period_awal_absen' AND '$period_akhir_absen' AND m_karyawan.BagianKary = '$bagian_absen' AND m_karyawan.StatusKaryawan = '$status_absen' ";
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
										m_bagian.NamaBagian,
										m_status_karyawan.NamaStatusKaryawan 
									FROM
										dbo.tbl_kalkulasi
										LEFT JOIN dbo.m_karyawan ON tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
										LEFT JOIN dbo.m_bagian ON m_karyawan.BagianKary = m_bagian.ID_Bagian
										LEFT JOIN dbo.m_status_karyawan ON m_karyawan.StatusKaryawan = m_status_karyawan.ID_StatusKaryawan
									$tampil 
									ORDER BY
										tbl_kalkulasi.Tanggal DESC,
										tbl_kalkulasi.ID_Kary ASC");
		return $query;
	}

	public function simpan_karyawan()
	{
		$query = $this->db->query("SELECT
										m_karyawan.ID_Kary, 
										m_karyawan.GajiPokok, 
										m_karyawan.GajiLembur
									FROM
										dbo.m_karyawan
										LEFT JOIN
										dbo.tbl_kalkulasi
										ON 
											m_karyawan.ID_Kary = tbl_kalkulasi.ID_Kary
									WHERE m_karyawan.StatusKary = 0 AND tbl_kalkulasi.ID_Kary IS NULL");
		return $query;
	}

	public function simpan_ketik()
	{
		$id_karyawan 	= $this->input->post('karyawan');
		$TanggalAbsen	= date('Y-m-d',strtotime($this->input->post('tgl')));
		$JamMasuk 		= date('Y-m-d h:i:s',strtotime($this->input->post('jam_in')));
		$JamKeluar 		= date('Y-m-d h:i:s',strtotime($this->input->post('jam_out')));

		$JamIn 			= strtotime(substr($JamMasuk, 11));
		$JamOut 		= strtotime(substr($JamKeluar, 11));
		$diff 			= $JamOut - $JamIn; //menghitung selisih dengan hasil detik
		$jam_cek		= floor($diff/(60*60)); //membagi detik menjadi jam
		$lembur_cek 	= $jam_cek - 8;

		if ($jam_cek <= 8) {
			$jam = $jam_cek;
		}else{
			$jam = 8;
		}

		if ($lembur_cek <= 0) {
			$lembur = 0;
		}else{
			$lembur = $lembur_cek;
		}

		$query = $this->db->query("SELECT ID_Kary,GajiNormal,GajiLembur FROM m_karyawan WHERE ID_Kary = '$id_kayawan' ");

		foreach ($query->result() as $ad) {

			$gajikary 		= $ad->GajiNormal;
			$lemburkary 	= $ad->GajiLembur;
			$totgaji 		= $gajikary * $jam;
			$totlembur 		= $lemburkary * $lembur;

			$data = array(
				'ID_Kary'			=> $ad->ID_Kary,
				'Tanggal' 			=> $TanggalAbsen,
				'JamIn'				=> $JamMasuk,
				'JamOut' 			=> $JamKeluar,
				'KalkulasiJam'		=> $jam,
				'ValidasiLembur'	=> 0,
				'ID_MesinIn'		=> 2,
				'ID_MesinOut'		=> 2,
				'TotalGaji'			=> $totgaji,
				'TotalLembur'		=> $totlembur
			);

			$this->db->insert('tbl_kalkulasi',$data);
		}		
	}

	public function delete_duplikat()
	{
		$query = $this->db->query("WITH CTE AS (
									SELECT RN = ROW_NUMBER()OVER(PARTITION BY ID_Kary,Tanggal ORDER BY Tanggal DESC)
									,*
									FROM dbo.tbl_kalkulasi
									)
									DELETE FROM tbl_kalkulasi WHERE ID_Kalkulasi IN(
									SELECT ID_Kalkulasi FROM CTE WHERE RN > 1)");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}
 ?>