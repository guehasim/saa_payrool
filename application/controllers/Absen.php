<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Absen extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library("pagination");
		$this->load->model("M_absen");
		$this->load->model("M_karyawan");
		$this->load->model("M_periode");
		$this->load->library("session");
		$this->load->model('M_bagian');
		$this->load->model('M_status_karyawan');
	}

	public function index()
	{
		$tombol 			= $this->input->post('cek');
		$tgl_awal_absen 	= $this->input->post('tgl_awal');
	    $tgl_akhir_absen	= $this->input->post('tgl_akhir');
	    $kary_absen			= $this->input->post('karyawan');
	    $bag_absen 			= $this->input->post('bagian');
		$stat_absen 		= $this->input->post('status');
	    
	    $user = $this->session->userdata('ses_IdUser');

	    if ($tombol == 'Search') {
	       	
	       	$datas = array(
	       		'ses_tgl_awal_absensi' 	=> $tgl_awal_absen,
	       		'ses_tgl_akhir_absensi'	=> $tgl_akhir_absen,
	       		'ses_karyawan_absensi'	=> $kary_absen,
	       		'ses_bagian_absensi'	=> $bag_absen,
		       	'ses_status_absensi'	=> $stat_absen
	       	);

	       	$this->session->set_userdata($datas);

	       	$period_awal_absen 	= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_awal_absensi')));
	    	$period_akhir_absen = date('Y-m-d',strtotime($this->session->userdata('ses_tgl_akhir_absensi')));
	    	$karyawan_absen 	= $this->session->userdata('ses_karyawan_absensi');
	    	$bagian_absen 		= $this->session->userdata('ses_bagian_absensi');
	    	$status_absen 		= $this->session->userdata('ses_status_absensi');

	    	$config["base_url"] 		= base_url() . "Absen";
	        $config["total_rows"] 		= $this->M_absen->get_count($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);
	        $config["per_page"] 		= 10;
	        $config["uri_segment"] 		= 2;

	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';

	        $this->pagination->initialize($config);

	        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

	        $data['nomor'] = $page;

	        $data["links"] = $this->pagination->create_links();

			$data['menu'] 		= 'absen';
			$data['gaji'] 		= $this->M_absen->lihat_data($config["per_page"], $page, $period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);
			$data['bagian'] 	= $this->M_bagian->lihat_bagian();
			$data['status']		= $this->M_status_karyawan->lihat_data();
			$data['karyawan']	= $this->M_karyawan->lihat_data_biasa();
			$data['periode'] 	= $this->M_periode->lihat_data();
			$this->load->view("template/header",$data);
			$this->load->view("laporan/absen",$data);
			$this->load->view("template/footer");

	    }elseif($tombol == 'Reset'){
	    	$this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi'));
	    	redirect('Absen');
	    }elseif($tombol == 'Print'){
	    	$period_awal_absen 	= $this->input->post('tgl_awal');
		    $period_akhir_absen	= $this->input->post('tgl_akhir');
		    $karyawan_absen		= $this->input->post('karyawan');
		    $bagian_absen		= $this->input->post('bagian');
			$status_absen 		= $this->input->post('status');
	    	$data ['cetak']= $this->M_absen->lihat_data_biasa($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);
			$this->load->view('laporan/cetak_rekap_absen',$data);	
	    }elseif($tombol == 'Excel'){
	    	$period_awal_absen 	= $this->input->post('tgl_awal');
		    $period_akhir_absen	= $this->input->post('tgl_akhir');
		    $karyawan_absen		= $this->input->post('karyawan');
		    $bagian_absen		= $this->input->post('bagian');
			$status_absen 		= $this->input->post('status');

			$semua_pengguna = $this->M_absen->lihat_data_biasa($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);

			$spreadsheet = new Spreadsheet;

	          $spreadsheet->setActiveSheetIndex(0)
	                      ->setCellValue('A1', 'NO')
	                      ->setCellValue('B1', 'Status')
	                      ->setCellValue('C1', 'Department')
	                      ->setCellValue('D1', 'NIK')
	                      ->setCellValue('E1', 'Nama')
	                      ->setCellValue('F1', 'Tanggal Masuk')
	                      ->setCellValue('G1', 'Jam Masuk')
	                      ->setCellValue('H1', 'Tanggal Pulang')
	                      ->setCellValue('I1', 'Jam Pulang');

	          $kolom = 2;
	          $nomor = 1;
	          foreach($semua_pengguna->result() as $pengguna) {

	               $spreadsheet->setActiveSheetIndex(0)
	                           ->setCellValue('A' . $kolom, $nomor)
	                           ->setCellValue('B' . $kolom, $pengguna->NamaStatusKaryawan)
	                           ->setCellValue('C' . $kolom, $pengguna->NamaBagian)
	                           ->setCellValue('D' . $kolom, $pengguna->ID_Kary)
	                           ->setCellValue('E' . $kolom, $pengguna->NamaKary)
	                           ->setCellValue('F' . $kolom, date('d M y',strtotime($pengguna->JamIn)))
	                           ->setCellValue('G' . $kolom, date('H:i:s',strtotime($pengguna->JamIn)))
	                           ->setCellValue('H' . $kolom, date('d M y',strtotime($pengguna->JamOut)))
	                           ->setCellValue('I' . $kolom, date('H:i:s',strtotime($pengguna->JamOut)));

	               $kolom++;
	               $nomor++;

	          }

	          $writer = new Xlsx($spreadsheet);

	          $nomor = date('his');

	        header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Laporan Rekap Absensi Finger Karyawan-"'.$nomor.'".xls');
			header('Cache-Control: max-age=0');

		  	$writer->save('php://output');

	    }else{

	    	$period_awal_absen 	= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_awal_absensi')));
	    	$period_akhir_absen = date('Y-m-d',strtotime($this->session->userdata('ses_tgl_akhir_absensi')));
	    	$karyawan_absen 	= $this->session->userdata('ses_karyawan_absensi');
	    	$bagian_absen 		= $this->session->userdata('ses_bagian_absensi');
	    	$status_absen 		= $this->session->userdata('ses_status_absensi');

	    	$config["base_url"] 		= base_url() . "Absen";
	        $config["total_rows"] 		= $this->M_absen->get_count($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);
	        $config["per_page"] 		= 10;
	        $config["uri_segment"] 		= 2;

	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';

	        $this->pagination->initialize($config);

	        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

	        $data['nomor'] = $page;

	        $data["links"] = $this->pagination->create_links();

			$data['menu'] 		= 'absen';
			$data['gaji'] 		= $this->M_absen->lihat_data($config["per_page"], $page, $period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);
			$data['bagian'] 	= $this->M_bagian->lihat_bagian();
			$data['status']		= $this->M_status_karyawan->lihat_data();
			$data['karyawan']	= $this->M_karyawan->lihat_data_biasa();
			$data['periode'] 	= $this->M_periode->lihat_data();
			$this->load->view("template/header",$data);
			$this->load->view("laporan/absen",$data);
			$this->load->view("template/footer");
	    }	    
	}

	public function refresh2()
	{
		$queryx = $this->db->query("DELETE FROM tbl_temp_absen");
		$queryx = $this->db->query("DELETE FROM tbl_kalkulasi");

		$ids = $this->input->post('periode');
		//cek tanggal cutoff periode
		$query0 = $this->db->query("SELECT * FROM m_periode WHERE ID_periode = '$ids' ");
			foreach ($query0->result() as $ass) {
				$tgl_awal 	= date('Y-m-d',strtotime($ass->Tglawal_cutoff));
				$tgl_akhir 	= date('Y-m-d',strtotime($ass->Tglakhir_cutoff));

				$waktu_awal = date('H:i:s',strtotime($ass->Tglawal_cutoff));
				$waktu_akhir= date('H:i:s',strtotime($ass->Tglakhir_cutoff));
			}

		//simpan dari mesin absen ke tabel temp absen
		$query1 = $this->db->query("INSERT INTO tbl_temp_absen(ID_Kary_Temp,JamIn_Temp,JamOut_Temp,Tanggal_Temp) SELECT ID_Kary,JamIn,JamOut,Tanggal FROM AbsenInOut WHERE Tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ");

		//update dari gabung tanggal jam where jam out tidak null
		$query2 = $this->db->query("SELECT * FROM tbl_temp_absen WHERE JamOut_Temp IS NOT NULL");
		foreach ($query2->result() as $aa) {
			$tanggalnya = $aa->Tanggal_Temp;
			$waktu_in 	= $aa->JamIn_Temp;
			$waktu_out 	= $aa->JamOut_Temp;
			$id 		= $aa->ID_Ot;

			$data = array(
				'JamIn_Temp' => date('Y-m-d',strtotime($tanggalnya)).' '.substr($waktu_in,11,18),
				'JamOut_Temp' => date('Y-m-d',strtotime($tanggalnya)).' '.substr($waktu_out,11,18)
			); 

			$where = array(
				'ID_Ot'	=> $id
			);

			$this->M_absen->update_data($where,$data,'tbl_temp_absen');

		}

		//update dari gabung tanggal jam where jam out null
		$query3 = $this->db->query("SELECT * FROM tbl_temp_absen WHERE JamOut_Temp IS NULL");
		foreach ($query3->result() as $aa) {
			$tanggalnya = $aa->Tanggal_Temp;
			$waktu_in 	= $aa->JamIn_Temp;
			$id 		= $aa->ID_Ot;

			$data = array(
				'JamIn_Temp' => date('Y-m-d',strtotime($tanggalnya)).' '.substr($waktu_in,11,18)
			); 

			$where = array(
				'ID_Ot'	=> $id
			);

			$this->M_absen->update_data($where,$data,'tbl_temp_absen');

		}

		//update jam out kosong
		$query4 = $this->db->query("SELECT * FROM tbl_temp_absen WHERE JamOut_Temp IS NULL");
		foreach ($query4->result() as $ad) {
			$tanggalnya = date('Y-m-d',strtotime('+1 days',strtotime($ad->Tanggal_Temp)));
			$id_kary 	= $ad->ID_Kary_Temp;
			$id 		= $ad->ID_Ot;

			$query3 = $this->db->query("SELECT * FROM MesinAbsen WHERE ID_Kary = '$id_kary' AND Tanggal = '$tanggalnya' AND Status = 'out' ");
			foreach ($query3->result() as $ae) {
				$jam = $ae->Jam;

				$data = array(
					'JamOut_Temp' => date('Y-m-d',strtotime($tanggalnya)).' '.substr($jam,11,18)
				); 

				$where = array(
					'ID_Ot'	=> $id
				);

				$this->M_absen->update_data($where,$data,'tbl_temp_absen');

			}
		}

		//simpan ke tbl_kalkulasi
		$query3 = $this->db->query("INSERT INTO tbl_kalkulasi (ID_Kary,Tanggal,JamIn,JamOut,KalkulasiJam,TotalGaji,ID_periode,GajiPokok)SELECT ID_Kary_Temp,CONVERT(date,JamIn_Temp),JamIn_Temp,JamOut_Temp,0,0,$ids,0 FROM tbl_temp_absen");

		//hapus duplikat data
		$this->M_absen->delete_duplikat();


		//update gaji pokok dan lembur
		$query7 = $this->db->query("SELECT
									tbl_kalkulasi.ID_Kalkulasi, 
									tbl_kalkulasi.ID_Kary, 
									tbl_kalkulasi.Tanggal, 
									tbl_kalkulasi.JamIn, 
									tbl_kalkulasi.JamOut, 
									tbl_kalkulasi.KalkulasiJam, 
									tbl_kalkulasi.TotalGaji, 
									tbl_kalkulasi.ID_periode, 
									tbl_kalkulasi.GajiPokok,  
									m_karyawan.GajiPokok AS GajiPokokKar
								FROM
									dbo.tbl_kalkulasi
									INNER JOIN
									dbo.m_karyawan
									ON 
										tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
								WHERE
									ID_periode = '$ids' ");

		foreach ($query7->result() as $aee) {
			$datac = array(
				'GajiPokok' 	=> $aee->GajiPokokKar
			);
			$wherec = array(
				'ID_Kalkulasi' 	=> $aee->ID_Kalkulasi
			);
			$this->M_absen->update_data($wherec,$datac,'tbl_kalkulasi');
		}

		$query8 = $this->db->query("SELECT * FROM tbl_kalkulasi WHERE ID_periode = '$ids' ");

			foreach ($query8->result() as $aff) {
				if($aff->JamIn == NULL){
					
				}elseif ($aff->JamOut == NULL) {
					
				}elseif($aff->JamIn != NULL && $aff->JamOut != NULL){
					
					$id_karyawan1 	= $aff->ID_Kalkulasi;

					$jammasuk 		= strtotime($aff->JamIn);
					$jamkeluar 		= strtotime($aff->JamOut);

					$gajijam 		= $aff->GajiPokok;

					$diff 			= $jamkeluar - $jammasuk;

					$jampokok 		= floor($diff/(60*60));

					$totgajipokok 	= $gajijam * $jampokok;

					$datad 		= array(
						'KalkulasiJam' 		=> $jampokok,
						'TotalGaji'			=> $totgajipokok
					);
					$whered 	= array(
						'ID_Kalkulasi'		=> $id_karyawan1
					);
					$this->M_absen->update_data($whered,$datad,'tbl_kalkulasi');
				}
			}

		$this->session->set_flashdata('success','Data Berhasil Disimpan !!');

		redirect('Absen');

	}

	public function refresh()
	{
		//delete temporari
		$this->db->query("DELETE FROM tbl_temp_absen");

		//cek pilih periode or no
		$ids = $this->input->post('periode');
		if ($ids == 0) {
			$this->session->set_flashdata('error','Pilih dulu periode !!');
			redirect('Absen');
		}else{			
			$querya = $this->db->query("SELECT * FROM m_periode WHERE ID_periode = '$ids' ");
			foreach ($querya->result() as $ass) {
				$period_awal 	= $ass->Tglawal_cutoff;
				$period_akhir 	= $ass->Tglakhir_cutoff;
			}

			//cek data di mesin absen
			$queryb = $this->db->query("SELECT * FROM MesinAbsen WHERE Tanggal BETWEEN '$period_awal' AND '$period_akhir' ");
			if ($queryb->num_rows() > 0) {
				$this->db->where('ID_periode',$ids);
				$queryc = $this->db->get('m_periode');
				if ($queryc->num_rows() > 0) {
					$this->db->query("DELETE FROM tbl_kalkulasi WHERE ID_periode = '$ids' ");

					$query = $this->db->query("SELECT * FROM QryAbsenHarianInOut");
					foreach ($query->result() as $aa) {
						$id 		= $aa->ID_Kary;
						$tanggal 	= $aa->Tanggal;
						$jammasuk 	= new DateTime($aa->JamIn);
						$jamkeluar 	= new DateTime($aa->JamOut);
						$durasi 	= $aa->DurasiKerja;

						$tanggal_x = date('Y-m-d',strtotime($tanggal)).' '.$jammasuk->format('H:i:s');
						$tanggal_i = date('Y-m-d H:i:s',strtotime($tanggal_x));

						if ($durasi == '1900-01-01 00:00:00.000') {
							$tanggal_out = date('Y-m-d',strtotime('+1 days',strtotime($tanggal)));
							$query1 = $this->db->query("SELECT MIN(Jam) AS Jam FROM MesinAbsen WHERE ID_Kary = '$id' AND Tanggal = '$tanggal_out' ");
							foreach ($query1->result() as $ab) {
								$out_tgl = new DateTime($ab->Jam);
								$tanggal_o = $tanggal_out.' '.$out_tgl->format('H:i:s');

								$durasi = strtotime($tanggal_o) - strtotime($tanggal_i);
								$tot = floor($durasi / (60 * 60));;

								if($tot > 12){

								}else{
									$query = $this->db->query("INSERT INTO tbl_temp_absen (ID_Kary_Temp,JamIn_Temp,JamOut_Temp) VALUES ('$id','$tanggal_i','$tanggal_o') ");
								}

							}

						}else{
							$tanggal_o = date('Y-m-d',strtotime($tanggal)).' '.$jamkeluar->format('H:i:s');
							$query2 = $this->db->query("INSERT INTO tbl_temp_absen (ID_Kary_Temp,JamIn_Temp,JamOut_Temp) VALUES ('$id','$tanggal_i','$tanggal_o') ");
						}
					}

					//simpan ke tbl_kalkulasi
					$query3 = $this->db->query("INSERT INTO tbl_kalkulasi (ID_Kary,Tanggal,JamIn,JamOut,KalkulasiJam,KalkulasiLembur,ValidasiLembur,TotalGaji,TotalLembur,ID_periode,GajiPokok,GajiLembur,TotalGajiAll)SELECT ID_Kary_Temp,CONVERT(date,JamIn_Temp),JamIn_Temp,JamOut_Temp,0,0,0,0,0,$ids,0,0,0 FROM tbl_temp_absen");

					//hapus duplikat data
					$this->M_absen->delete_duplikat();

					//update gaji pokok dan lembur
					$query7 = $this->db->query("SELECT
												tbl_kalkulasi.ID_Kalkulasi, 
												tbl_kalkulasi.ID_Kary, 
												tbl_kalkulasi.Tanggal, 
												tbl_kalkulasi.JamIn, 
												tbl_kalkulasi.JamOut, 
												tbl_kalkulasi.KalkulasiJam, 
												tbl_kalkulasi.KalkulasiLembur, 
												tbl_kalkulasi.ValidasiLembur, 
												tbl_kalkulasi.TotalGaji, 
												tbl_kalkulasi.TotalLembur, 
												tbl_kalkulasi.ID_periode, 
												tbl_kalkulasi.GajiPokok, 
												tbl_kalkulasi.GajiLembur, 
												m_karyawan.GajiPokok AS GajiPokokKar, 
												m_karyawan.GajiLembur AS GajiLemburKar
											FROM
												dbo.tbl_kalkulasi
												INNER JOIN
												dbo.m_karyawan
												ON 
													tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
											WHERE
												ID_periode = '$ids' ");

					foreach ($query7->result() as $aee) {
						$datac = array(
							'GajiPokok' 	=> $aee->GajiPokokKar,
							'GajiLembur'	=> $aee->GajiLemburKar
						);
						$wherec = array(
							'ID_Kalkulasi' 	=> $aee->ID_Kalkulasi
						);
						$this->M_absen->update_data($wherec,$datac,'tbl_kalkulasi');
					}

					$query8 = $this->db->query("SELECT * FROM tbl_kalkulasi WHERE ID_periode = '$ids' ");

					foreach ($query8->result() as $aff) {
						if($aff->JamIn == NULL){
							
						}elseif ($aff->JamOut == NULL) {
							
						}elseif($aff->JamIn != NULL && $aff->JamOut != NULL){
							
							$id_karyawan1 	= $aff->ID_Kalkulasi;

							$jammasuk 		= strtotime($aff->JamIn);
							$jamkeluar 		= strtotime($aff->JamOut);

							$gajijam 		= $aff->GajiPokok;
							$lemburjam 		= $aff->GajiLembur;

							$diff 			= $jamkeluar - $jammasuk;

							$jampokok 		= floor($diff/(60*60));

							if ($jampokok > 8) {
								$jamlembur = $jampokok - 8;
							}else{
								$jamlembur = 0;
							}

							$totgajipokok 	= $gajijam * $jampokok;
							$totgajilembur 	= $lemburjam * $jamlembur;
							$totalgaji 		= $totgajipokok + $totgajilembur;

							$datad 		= array(
								'KalkulasiJam' 		=> $jampokok,
								'KalkulasiLembur' 	=> $jamlembur,
								'TotalGaji'			=> $totgajipokok,
								'TotalLembur'		=> $totgajilembur,
								'TotalGajiAll'		=> $totalgaji
							);
							$whered 	= array(
								'ID_Kalkulasi'		=> $id_karyawan1
							);
							$this->M_absen->update_data($whered,$datad,'tbl_kalkulasi');
						}
					}

				$this->session->set_flashdata('success','Data Berhasil Disimpan !!');
				redirect('Absen');

				}else{
					$query = $this->db->query("SELECT * FROM QryAbsenHarianInOut");
					foreach ($query->result() as $aa) {
						$id 		= $aa->ID_Kary;
						$tanggal 	= $aa->Tanggal;
						$jammasuk 	= new DateTime($aa->JamIn);
						$jamkeluar 	= new DateTime($aa->JamOut);
						$durasi 	= $aa->DurasiKerja;

						$tanggal_x = date('Y-m-d',strtotime($tanggal)).' '.$jammasuk->format('H:i:s');
						$tanggal_i = date('Y-m-d H:i:s',strtotime($tanggal_x));

						if ($durasi == '1900-01-01 00:00:00.000') {
							$tanggal_out = date('Y-m-d',strtotime('+1 days',strtotime($tanggal)));
							$query1 = $this->db->query("SELECT MIN(Jam) AS Jam FROM MesinAbsen WHERE ID_Kary = '$id' AND Tanggal = '$tanggal_out' ");
							foreach ($query1->result() as $ab) {
								$out_tgl = new DateTime($ab->Jam);
								$tanggal_o = $tanggal_out.' '.$out_tgl->format('H:i:s');

								$durasi = strtotime($tanggal_o) - strtotime($tanggal_i);
								$tot = floor($durasi / (60 * 60));;

								if($tot > 12){

								}else{
									$query = $this->db->query("INSERT INTO tbl_temp_absen (ID_Kary_Temp,JamIn_Temp,JamOut_Temp) VALUES ('$id','$tanggal_i','$tanggal_o') ");
								}

							}

						}else{
							$tanggal_o = date('Y-m-d',strtotime($tanggal)).' '.$jamkeluar->format('H:i:s');
							$query2 = $this->db->query("INSERT INTO tbl_temp_absen (ID_Kary_Temp,JamIn_Temp,JamOut_Temp) VALUES ('$id','$tanggal_i','$tanggal_o') ");
						}
					}

					//simpan ke tbl_kalkulasi
					$query3 = $this->db->query("INSERT INTO tbl_kalkulasi (ID_Kary,Tanggal,JamIn,JamOut,KalkulasiJam,KalkulasiLembur,ValidasiLembur,TotalGaji,TotalLembur,ID_periode,GajiPokok,GajiLembur,TotalGajiAll)SELECT ID_Kary_Temp,CONVERT(date,JamIn_Temp),JamIn_Temp,JamOut_Temp,0,0,0,0,0,$ids,0,0,0 FROM tbl_temp_absen");

					//hapus duplikat data
					$this->M_absen->delete_duplikat();

					//update gaji pokok dan lembur
					$query7 = $this->db->query("SELECT
												tbl_kalkulasi.ID_Kalkulasi, 
												tbl_kalkulasi.ID_Kary, 
												tbl_kalkulasi.Tanggal, 
												tbl_kalkulasi.JamIn, 
												tbl_kalkulasi.JamOut, 
												tbl_kalkulasi.KalkulasiJam, 
												tbl_kalkulasi.KalkulasiLembur, 
												tbl_kalkulasi.ValidasiLembur, 
												tbl_kalkulasi.TotalGaji, 
												tbl_kalkulasi.TotalLembur, 
												tbl_kalkulasi.ID_periode, 
												tbl_kalkulasi.GajiPokok, 
												tbl_kalkulasi.GajiLembur, 
												m_karyawan.GajiPokok AS GajiPokokKar, 
												m_karyawan.GajiLembur AS GajiLemburKar
											FROM
												dbo.tbl_kalkulasi
												INNER JOIN
												dbo.m_karyawan
												ON 
													tbl_kalkulasi.ID_Kary = m_karyawan.ID_Kary
											WHERE
												ID_periode = '$ids' ");

					foreach ($query7->result() as $aee) {
						$datac = array(
							'GajiPokok' 	=> $aee->GajiPokokKar,
							'GajiLembur'	=> $aee->GajiLemburKar
						);
						$wherec = array(
							'ID_Kalkulasi' 	=> $aee->ID_Kalkulasi
						);
						$this->M_absen->update_data($wherec,$datac,'tbl_kalkulasi');
					}

					$query8 = $this->db->query("SELECT * FROM tbl_kalkulasi WHERE ID_periode = '$ids' ");

					foreach ($query8->result() as $aff) {
						if($aff->JamIn == NULL){
							
						}elseif ($aff->JamOut == NULL) {
							
						}elseif($aff->JamIn != NULL && $aff->JamOut != NULL){
							
							$id_karyawan1 	= $aff->ID_Kalkulasi;

							$jammasuk 		= strtotime($aff->JamIn);
							$jamkeluar 		= strtotime($aff->JamOut);

							$gajijam 		= $aff->GajiPokok;
							$lemburjam 		= $aff->GajiLembur;

							$diff 			= $jamkeluar - $jammasuk;

							$jampokok 		= floor($diff/(60*60));

							if ($jampokok > 8) {
								$jamlembur = $jampokok - 8;
							}else{
								$jamlembur = 0;
							}

							$totgajipokok 	= $gajijam * $jampokok;
							$totgajilembur 	= $lemburjam * $jamlembur;
							$totalgaji 		= $totgajipokok + $totgajilembur;

							$datad 		= array(
								'KalkulasiJam' 		=> $jampokok,
								'KalkulasiLembur' 	=> $jamlembur,
								'TotalGaji'			=> $totgajipokok,
								'TotalLembur'		=> $totgajilembur,
								'TotalGajiAll'		=> $totalgaji
							);
							$whered 	= array(
								'ID_Kalkulasi'		=> $id_karyawan1
							);
							$this->M_absen->update_data($whered,$datad,'tbl_kalkulasi');
						}
					}

				$this->session->set_flashdata('success','Data Berhasil Disimpan !!');
				redirect('Absen');
				}	
			}else{
				$this->session->set_flashdata('error','Data belum ada di database !!');
				redirect('Absen');
			}				

		}
	}

	public function update_absensi()
	{
		$ids = $this->input->post('id');

		$datas = array(
			'JamIn'		=> $this->input->post('jam_masuk'),
			'JamOut' 	=> $this->input->post('jam_keluar')
		);

		$wheres = array(
			'ID_Kalkulasi' 	=> $ids
		);
		$this->M_absen->update_data($wheres,$datas,'tbl_kalkulasi');

		$query8 = $this->db->query("SELECT * FROM tbl_kalkulasi WHERE ID_Kalkulasi = '$ids' ");

		foreach ($query8->result() as $aff) {
			if($aff->JamIn == NULL){
				// echo "jam in |";
			}elseif ($aff->JamOut == NULL) {
				// echo "jam out |";
			}elseif($aff->JamIn != NULL && $aff->JamOut != NULL){
				// echo "jam in dan out |";
				$id_karyawan1 	= $aff->ID_Kalkulasi;
				$jammasukx 		= substr($aff->JamIn,11,19);
				$jamkeluarx 	= substr($aff->JamOut,11,19);

				$jammasuk 		= strtotime('1970-01-01'.$jammasukx);
				$jamkeluar 		= strtotime('1970-01-01'.$jamkeluarx);

				$gajijam 		= $aff->GajiPokok;
				$lemburjam 		= $aff->GajiLembur;

				$diff 			= $jamkeluar - $jammasuk;

				$jampokok 		= floor($diff/(60*60));

				if ($jampokok > 8) {
					$jamlembur = $jampokok - 8;
				}else{
					$jamlembur = 0;
				}

				$totgajipokok 	= $gajijam * $jampokok;
				$totgajilembur 		= $lemburjam * $jamlembur;
				$totalgaji 		= $totgajipokok + $totgajilembur;

				$datad 		= array(
					'KalkulasiJam' 		=> $jampokok,
					'KalkulasiLembur' 	=> $jamlembur,
					'TotalGaji'			=> $totgajipokok,
					'TotalLembur'		=> $totgajilembur,
					'TotalGajiAll'		=> $totalgaji
				);
				$whered 	= array(
					'ID_Kalkulasi'		=> $id_karyawan1
				);
				$this->M_absen->update_data($whered,$datad,'tbl_kalkulasi');
			}
		}

		$this->session->set_flashdata('success','Data berhasil di update !!');
		redirect('Absen');

	}

	public function update_jamkeluar()
	{
		$ids = $this->input->post('id');

		$datas = array(
			'JamOut' 	=> $this->input->post('jam_keluar')
		);

		$wheres = array(
			'ID_Kalkulasi' 	=> $ids
		);
		$this->M_absen->update_data($wheres,$datas,'tbl_kalkulasi');

		$query8 = $this->db->query("SELECT * FROM tbl_kalkulasi WHERE ID_Kalkulasi = '$ids' ");

		foreach ($query8->result() as $aff) {
			if($aff->JamIn == NULL){
				// echo "jam in |";
			}elseif ($aff->JamOut == NULL) {
				// echo "jam out |";
			}elseif($aff->JamIn != NULL && $aff->JamOut != NULL){
				// echo "jam in dan out |";
				$id_karyawan1 	= $aff->ID_Kalkulasi;
				$jammasukx 		= substr($aff->JamIn,11,19);
				$jamkeluarx 	= substr($aff->JamOut,11,19);

				$jammasuk 		= strtotime('1970-01-01'.$jammasukx);
				$jamkeluar 		= strtotime('1970-01-01'.$jamkeluarx);

				$gajijam 		= $aff->GajiPokok;
				$lemburjam 		= $aff->GajiLembur;

				$diff 			= $jamkeluar - $jammasuk;

				$jampokok 		= floor($diff/(60*60));

				if ($jampokok > 8) {
					$jamlembur = $jampokok - 8;
				}else{
					$jamlembur = 0;
				}

				$totgajipokok 	= $gajijam * $jampokok;
				$totgajilembur 		= $lemburjam * $jamlembur;
				$totalgaji 		= $totgajipokok + $totgajilembur;

				$datad 		= array(
					'KalkulasiJam' 		=> $jampokok,
					'KalkulasiLembur' 	=> $jamlembur,
					'TotalGaji'			=> $totgajipokok,
					'TotalLembur'		=> $totgajilembur,
					'TotalGajiAll'		=> $totalgaji
				);
				$whered 	= array(
					'ID_Kalkulasi'		=> $id_karyawan1
				);
				$this->M_absen->update_data($whered,$datad,'tbl_kalkulasi');
			}
		}

		$this->session->set_flashdata('success','Data berhasil di update !!');
		redirect('Absen');
	}

	public function update_jammasuk()
	{
		$ids = $this->input->post('id');

		$datas = array(
			'JamIn' 	=> $this->input->post('jam_masuk')
		);

		$wheres = array(
			'ID_Kalkulasi' 	=> $ids
		);
		$this->M_absen->update_data($wheres,$datas,'tbl_kalkulasi');

		$query8 = $this->db->query("SELECT * FROM tbl_kalkulasi WHERE ID_Kalkulasi = '$ids' ");

		foreach ($query8->result() as $aff) {
			if($aff->JamIn == NULL){
				// echo "jam in |";
			}elseif ($aff->JamOut == NULL) {
				// echo "jam out |";
			}elseif($aff->JamIn != NULL && $aff->JamOut != NULL){
				// echo "jam in dan out |";
				$id_karyawan1 	= $aff->ID_Kalkulasi;
				$jammasukx 		= substr($aff->JamIn,11,19);
				$jamkeluarx 	= substr($aff->JamOut,11,19);

				$jammasuk 		= strtotime('1970-01-01'.$jammasukx);
				$jamkeluar 		= strtotime('1970-01-01'.$jamkeluarx);

				$gajijam 		= $aff->GajiPokok;
				$lemburjam 		= $aff->GajiLembur;

				$diff 			= $jamkeluar - $jammasuk;

				$jampokok 		= floor($diff/(60*60));

				if ($jampokok > 8) {
					$jamlembur = $jampokok - 8;
				}else{
					$jamlembur = 0;
				}

				$totgajipokok 	= $gajijam * $jampokok;
				$totgajilembur 		= $lemburjam * $jamlembur;
				$totalgaji 		= $totgajipokok + $totgajilembur;

				$datad 		= array(
					'KalkulasiJam' 		=> $jampokok,
					'KalkulasiLembur' 	=> $jamlembur,
					'TotalGaji'			=> $totgajipokok,
					'TotalLembur'		=> $totgajilembur,
					'TotalGajiAll'		=> $totalgaji
				);
				$whered 	= array(
					'ID_Kalkulasi'		=> $id_karyawan1
				);
				$this->M_absen->update_data($whered,$datad,'tbl_kalkulasi');
			}
		}

		redirect('Absen');
	}

	public function simpan_manual()
	{
		$id_karyawan = $this->input->post('karyawan');
		$this->db->where('ID_Kary',$id_karyawan);
		$this->db->where('StatusKary',0);
		$query = $this->db->get('m_karyawan');

		if ($query->num_rows() > 0) {
			$this->M_absen->simpan_ketik();
			$this->session->set_flashdata('success', 'Berhasil Menyimpan');
			redirect('Absen');
		}else{
			$this->session->set_flashdata('error', 'Status Karyawan Tidak Aktif !!');
			redirect('Absen');
		}
	}
}
 ?>