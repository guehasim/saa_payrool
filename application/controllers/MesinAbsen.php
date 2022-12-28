<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class MesinAbsen extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_mesin_absen');
		$this->load->model('M_bagian');
		$this->load->model('M_status_karyawan');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == '') {
			redirect('Login');
		}else{

			$tombol 			= $this->input->post('cek');
			$tgl_awal_absensi 	= $this->input->post('tgl_awal');
		    $tgl_akhir_absensi	= $this->input->post('tgl_akhir');
		    $bag_absensi 		= $this->input->post('bagian');
		    $kary_absensi		= $this->input->post('karyawan');
		    $stat_absensi 		= $this->input->post('status');

		    if ($tombol == 'Search') {
		    	
		    	$datas = array(
		       		'ses_tgl_awal_absen' 	=> $tgl_awal_absensi,
		       		'ses_tgl_akhir_absen'	=> $tgl_akhir_absensi,
		       		'ses_karyawan_absen'	=> $kary_absensi,
		       		'ses_bagian_absen'		=> $bag_absensi,
		       		'ses_status_absen'		=> $stat_absensi
		       	);
		       	$this->session->set_userdata($datas);

		       	$period_awal_absen		= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_awal_absen')));
		    	$period_akhir_absen 	= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_akhir_absen')));
		    	$bagian_absen 			= $this->session->userdata('ses_bagian_absen');
		    	$karyawan_absen 		= $this->session->userdata('ses_karyawan_absen');
		    	$status_absen 			= $this->session->userdata('ses_status_absen');

		    	$config["base_url"] 		= base_url() . "MesinAbsen";
		        $config["total_rows"] 		= $this->M_mesin_absen->get_count($period_awal_absen,$period_akhir_absen,$bagian_absen,$karyawan_absen,$status_absen);
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
				$data['absen'] 		= $this->M_mesin_absen->lihat_data($config["per_page"], $page, $period_awal_absen,$period_akhir_absen,$bagian_absen,$karyawan_absen,$status_absen);	
				$data['bagian'] 	= $this->M_bagian->lihat_bagian();
				$data['status']		= $this->M_status_karyawan->lihat_data();
				$data['menu'] 		= 'mesinabsen';
				$this->load->view('template/header',$data);
				$this->load->view('laporan/mesin_absen',$data);
				$this->load->view('template/footer');

		    }elseif($tombol == 'Reset'){
		    	$this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_bagian_absen','ses_karyawan_absen','ses_status_absen'));
		    	redirect('MesinAbsen');
		    }elseif($tombol == 'Print'){
		    	$period_awal_absen 	= date('Y-m-d',strtotime($this->input->post('tgl_awal')));
			    $period_akhir_absen	= date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
			    $karyawan_absen		= $this->input->post('karyawan');
			    $bagian_absen		= $this->input->post('bagian');
				$status_absen 		= $this->input->post('status');
		    	$data ['cetak']= $this->M_mesin_absen->lihat_data_biasa($period_awal_absen,$period_akhir_absen,$bagian_absen,$karyawan_absen,$status_absen);
		    	$this->load->view('laporan/cetak_mesin_absen',$data);
		    }elseif($tombol == 'Excel'){
		    	$period_awal_absen 	= $this->input->post('tgl_awal');
			    $period_akhir_absen	= $this->input->post('tgl_akhir');
			    $karyawan_absen		= $this->input->post('karyawan');
			    $bagian_absen		= $this->input->post('bagian');
				$status_absen 		= $this->input->post('status');

				$semua_pengguna = $this->M_mesin_absen->lihat_data_biasa($period_awal_absen,$period_akhir_absen,$karyawan_absen,$bagian_absen,$status_absen);

				$spreadsheet = new Spreadsheet;

		          $spreadsheet->setActiveSheetIndex(0)
		                      ->setCellValue('A1', 'NO')
		                      ->setCellValue('B1', 'Status')
		                      ->setCellValue('C1', 'Department')
		                      ->setCellValue('D1', 'NIK')
		                      ->setCellValue('E1', 'Nama')
		                      ->setCellValue('F1', 'Tanggal')
		                      ->setCellValue('G1', 'Jam');

		          $kolom = 2;
		          $nomor = 1;
		          foreach($semua_pengguna->result() as $pengguna) {

		               $spreadsheet->setActiveSheetIndex(0)
		                           ->setCellValue('A' . $kolom, $nomor)
		                           ->setCellValue('B' . $kolom, $pengguna->NamaStatusKaryawan)
		                           ->setCellValue('C' . $kolom, $pengguna->NamaBagian)
		                           ->setCellValue('D' . $kolom, $pengguna->ID_Kary)
		                           ->setCellValue('E' . $kolom, $pengguna->Nama)
		                           ->setCellValue('F' . $kolom, date('d M y',strtotime($pengguna->Tanggal)))
		                           ->setCellValue('G' . $kolom, substr($pengguna->Jam,11,8));

		               $kolom++;
		               $nomor++;

		          }

		          $writer = new Xlsx($spreadsheet);

		          $nomor = date('his');

		        header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Laporan Absensi Finger Karyawan-"'.$nomor.'".xls');
				header('Cache-Control: max-age=0');

			  	$writer->save('php://output');
		    }else{
		    	$period_awal_absen 			= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_awal_absen')));
		    	$period_akhir_absen 		= date('Y-m-d',strtotime($this->session->userdata('ses_tgl_akhir_absen')));
		    	$bagian_absen 				= $this->session->userdata('ses_bagian_absen');
		    	$karyawan_absen 			= $this->session->userdata('ses_karyawan_absen');
		    	$status_absen 				= $this->session->userdata('ses_status_absen');

		    	$config["base_url"] 		= base_url() . "MesinAbsen";
		        $config["total_rows"] 		= $this->M_mesin_absen->get_count($period_awal_absen,$period_akhir_absen,$bagian_absen,$karyawan_absen,$status_absen);
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
				$data['absen'] 		= $this->M_mesin_absen->lihat_data($config["per_page"], $page, $period_awal_absen,$period_akhir_absen,$bagian_absen,$karyawan_absen,$status_absen);	
				$data['bagian'] 	= $this->M_bagian->lihat_bagian();
				$data['status']		= $this->M_status_karyawan->lihat_data();
				$data['menu'] 		= 'mesinabsen';
				$this->load->view('template/header',$data);
				$this->load->view('laporan/mesin_absen',$data);
				$this->load->view('template/footer');

		    }			
		}
	}
}
 ?>