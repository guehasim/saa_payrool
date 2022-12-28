<?php 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Lembur extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_lembur");
		$this->load->model("M_absen");
		$this->load->model("M_bagian");
		$this->load->model("M_status_karyawan");
	}

	public function index()
	{
		$tombol 			= $this->input->post('cek');
		$tgl_awal_lembur 	= $this->input->post('tgl_awal');
	    $tgl_akhir_lembur	= $this->input->post('tgl_akhir');
	    $kary_lembur		= $this->input->post('karyawan');
	    $bag_lembur 		= $this->input->post('bagian');
	    $stat_absen 		= $this->input->post('status');

	    $user = $this->session->userdata('ses_IdUser');

	    $this->db->query("DELETE FROM temp_gaji WHERE ID_User = $user ");

	    if ($tombol == 'Search') {
	    	$datas = array(
	       		'ses_tgl_awal_lembur' 	=> $tgl_awal_lembur,
	       		'ses_tgl_akhir_lembur'	=> $tgl_akhir_lembur,
	       		'ses_karyawan_lembur'	=> $kary_lembur,
	       		'ses_bagian_lembur'		=> $bag_lembur,
	       		'ses_status_lembur'		=> $stat_absen
	       	);

	       	$this->session->set_userdata($datas);
	       	$period_awal_lembur 	= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_awal_lembur')));
	    	$period_akhir_lembur 	= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_akhir_lembur')));
	    	$karyawan_lembur 		= $this->session->userdata('ses_karyawan_lembur');
	    	$bagian_lembur 			= $this->session->userdata('ses_bagian_lembur');
	    	$status_lembur			= $this->session->userdata('ses_status_lembur');

	    	$config["base_url"] 		= base_url() . "Lembur";
	        $config["total_rows"] 		= $this->M_lembur->get_count($period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur);
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

			$data['menu'] 		= 'lembur';
			$data['lembur'] 		= $this->M_lembur->lihat_data($config["per_page"], $page, $period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur);
			$data['status']		= $this->M_status_karyawan->lihat_data();
			$data['bagian'] 	= $this->M_bagian->lihat_bagian();
			$this->load->view('template/header',$data);
			$this->load->view('laporan/lembur',$data);
			$this->load->view('template/footer');

	    }elseif($tombol == 'Reset'){
	    	$this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur'));
	    	redirect('Lembur');
	    }elseif($tombol == 'Print'){
	    	$period_awal_lembur 	= $this->input->post('tgl_awal');
		    $period_akhir_lembur	= $this->input->post('tgl_akhir');
		    $karyawan_lembur		= $this->input->post('karyawan');
		    $bagian_lembur 			= $this->input->post('bagian');
		    $status_lembur 			= $this->input->post('status');
	    	$data ['cetak']= $this->M_lembur->lihat_data_biasa($period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur);
			$this->load->view('laporan/cetak_rekap_lembur',$data);
	    }elseif($tombol == 'Excel'){
	    		$period_awal_absen 	= $this->input->post('tgl_awal');
			    $period_akhir_absen	= $this->input->post('tgl_akhir');
			    $karyawan_absen		= $this->input->post('karyawan');
			    $bagian_absen		= $this->input->post('bagian');
				$status_absen 		= $this->input->post('status');

				$semua_pengguna = $this->M_lembur->lihat_data_biasa($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);

				$spreadsheet = new Spreadsheet;

		          $spreadsheet->setActiveSheetIndex(0)
		                      ->setCellValue('A1', 'NO')
		                      ->setCellValue('B1', 'Status')
		                      ->setCellValue('C1', 'Department')
		                      ->setCellValue('D1', 'NIK')
		                      ->setCellValue('E1', 'Nama')
		                      ->setCellValue('F1', 'Tanggal')
		                      ->setCellValue('G1', 'Lembur/Jam')
		                      ->setCellValue('H1', 'Status');

		          $kolom = 2;
		          $nomor = 1;
		          foreach($semua_pengguna->result() as $pengguna) {

		          	if ($pengguna->ValidasiLembur == 0) {
                       $tampil = 'Tidak Disetujui';
                       }else{
                       $tampil = 'Disetujui';
                       }

		               $spreadsheet->setActiveSheetIndex(0)
		                           ->setCellValue('A' . $kolom, $nomor)
		                           ->setCellValue('B' . $kolom, $pengguna->NamaStatusKaryawan)
		                           ->setCellValue('C' . $kolom, $pengguna->NamaBagian)
		                           ->setCellValue('D' . $kolom, $pengguna->ID_Kary)
		                           ->setCellValue('E' . $kolom, $pengguna->NamaKary)
		                           ->setCellValue('F' . $kolom, date('d M y',strtotime($pengguna->JamIn)))
		                           ->setCellValue('G' . $kolom, $pengguna->KalkulasiLembur)
		                           ->setCellValue('H' . $kolom, $tampil);
		                           

		               $kolom++;
		               $nomor++;

		          }

		          $writer = new Xlsx($spreadsheet);

		          $nomor = date('his');

		        header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Laporan Lembur Karyawan-"'.$nomor.'".xls');
				header('Cache-Control: max-age=0');

			  	$writer->save('php://output');
	    }else{
	    	$period_awal_lembur 	= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_awal_lembur')));
	    	$period_akhir_lembur 	= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_akhir_lembur')));
	    	$karyawan_lembur 		= $this->session->userdata('ses_karyawan_lembur');
	    	$bagian_lembur 			= $this->session->userdata('ses_bagian_lembur');
	    	$status_lembur 			= $this->session->userdata('ses_status_lembur');

	    	$config["base_url"] 		= base_url() . "Lembur";
	        $config["total_rows"] 		= $this->M_lembur->get_count($period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur);
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

			$data['menu'] 		= 'lembur';
			$data['lembur'] 		= $this->M_lembur->lihat_data($config["per_page"], $page, $period_awal_lembur,$period_akhir_lembur,$karyawan_lembur,$bagian_lembur,$status_lembur);
			$data['status']		= $this->M_status_karyawan->lihat_data();
			$data['bagian'] 	= $this->M_bagian->lihat_bagian();
			$this->load->view('template/header',$data);
			$this->load->view('laporan/lembur',$data);
			$this->load->view('template/footer');
	    }		
	}

	public function update()
	{
		$ver 	= $this->input->post('verifikasi');
		$id 	= $this->input->post('id');
		$lemburx= $this->input->post('txt_lembur');

		if ($ver == 0) {
			$data = array(
				'ValidasiLembur' 	=> 1,
				'KalkulasiLembur'	=> $lemburx
			);
		}else{
			$data = array(
				'ValidasiLembur' 	=> 0
			);
		}

		$where = array(
			'ID_Kalkulasi' 			=> $id
		);

		$this->M_lembur->update_data($where,$data,'tbl_kalkulasi');

		$query8 = $this->db->query("SELECT * FROM tbl_kalkulasi WHERE ID_Kalkulasi = '$id' ");

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

				$jamlembur 		= $aff->KalkulasiLembur;

				$totgajipokok 	= $gajijam * $jampokok;
				$totgajilembur 	= $lemburjam * $jamlembur;

				$totalgaji 		= $totgajipokok + $totgajilembur;

				echo $lemburjam;

				$datad 		= array(
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

		$this->session->set_flashdata('success','Data berhasil di update!');
		redirect('Lembur');
	}
}
 ?>