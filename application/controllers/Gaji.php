<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Gaji extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->model('M_periode');
		$this->load->model('M_gaji');
		$this->load->model('M_karyawan');
	}

	public function index()
	{
		$id = $this->session->userdata('ses_IdUser');

		$config["base_url"] 		= base_url() . "Gaji";
        $config["total_rows"] 		= $this->M_gaji->get_count($id);
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

		$data['menu'] 		= "gaji";
		$data['periode']	= $this->M_periode->lihat_data();
		$data['karyawan'] 	= $this->M_karyawan->lihat_data_biasa();
		$data['gaji'] 		= $this->M_gaji->lihat_data($id, $config["per_page"], $page);

		$this->load->view('template/header',$data);
		$this->load->view('laporan/gaji',$data);
		$this->load->view('template/footer');
	}

	public function filter()
	{
		$ids = $this->session->userdata('ses_IdUser');

		$submitdata = $this->input->post("submitdata");

		if ($submitdata == 'SEARCH') {

			$this->db->where('ID_User',$this->session->userdata('ses_IdUser'));
			$query6 = $this->db->get('temp_gaji');
				if ($query6->num_rows() > 0) {
					redirect('Gaji');
			}else{
				$start_date = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
				$end_date 	= date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

				$data = array(
					'ses_tgl_awal_gaji'		=> $start_date, 
					'ses_tgl_akhir_gaji'	=> $end_date
				);
				$this->session->set_userdata($data);

				$this->db->where('Tanggal >=',$start_date);
				$this->db->where('Tanggal <=',$end_date);
				$query8 = $this->db->get('tbl_kalkulasi');
				if ($query8->num_rows() > 0) {
					
					$this->M_gaji->simpan_identitas();	//simpan data ID_User,ID_Kary,Nama,Gaji_Jam,Lembur_Jam	

					$tgl_awal 	= $this->session->userdata('ses_tgl_awal_gaji');
					$tgl_akhir 	= $this->session->userdata('ses_tgl_akhir_gaji');
					$id_user 	= $this->session->userdata('ses_IdUser');

					//update tot_hadir,gaji_hadir
					$query3 = $this->db->query("SELECT
									temp_gaji.ID_Kary, 
									SUM(tbl_kalkulasi.KalkulasiJam) AS KalkulasiJam, 
									SUM(tbl_kalkulasi.TotalGaji) AS TotalGaji
								FROM
									temp_gaji
								LEFT JOIN tbl_kalkulasi ON temp_gaji.ID_Kary = tbl_kalkulasi.ID_Kary 
								WHERE
									tbl_kalkulasi.Tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND temp_gaji.ID_User = '$id_user'
								GROUP BY
								temp_gaji.ID_Kary");

					foreach ($query3->result() as $aa) {

						$data = array(
							'TotHadir' 	=> $aa->KalkulasiJam,
							'GajiHadir'	=> $aa->TotalGaji
						);

						$where = array(
							'ID_Kary' 	=> $aa->ID_Kary,
							'ID_User' 	=> $id_user
						);

						$this->M_gaji->update_data($where,$data,'temp_gaji');
					
					}

					$query4 = $this->db->query("SELECT
										temp_gaji.ID_Kary, 
										SUM(tbl_kalkulasi.KalkulasiLembur) AS KalkulasiLembur, 
										SUM(tbl_kalkulasi.TotalLembur) AS TotalLembur
									FROM
										temp_gaji
									LEFT JOIN tbl_kalkulasi ON temp_gaji.ID_Kary = tbl_kalkulasi.ID_Kary 
									WHERE
										tbl_kalkulasi.ID_periode = '$id_period' AND temp_gaji.ID_User = '$id_user' AND tbl_kalkulasi.ValidasiLembur = '1'
									GROUP BY
									temp_gaji.ID_Kary");
						foreach($query4->result() as $ab){

							$data = array(
								'TotLembur'	=> $ab->KalkulasiLembur,
								'GajiLembur'=> $ab->TotalLembur
							);

							$where = array(
								'ID_Kary' 	=> $ab->ID_Kary,
								'ID_User' 	=> $id_user
							);
							$this->M_gaji->update_data($where,$data,'temp_gaji');
						}

					$query5 = $this->db->query("SELECT * FROM tbl_tunjangan WHERE ID_periode = '$id_period' AND JenisTunjangan = '0' ");

					foreach ($query5->result() as $aee) {
						$data = array(
							'Tunjangan' 	=> $aee->TotalTunjangan
						);
						$where = array(
							'ID_Kary' 		=> $aee->ID_Kary,
							'ID_User' 		=> $id_user
						); 
						$this->M_gaji->update_data($where,$data,'temp_gaji');
					}

					$query6 = $this->db->query("SELECT * FROM tbl_tunjangan WHERE ID_periode = '$id_period' AND JenisTunjangan = '1' ");

					foreach ($query6->result() as $aee) {
						$data = array(
							'Potongan' 	=> $aee->TotalTunjangan
						);
						$where = array(
							'ID_Kary' 		=> $aee->ID_Kary,
							'ID_User' 		=> $id_user
						); 
						$this->M_gaji->update_data($where,$data,'temp_gaji');
					}

					$query7 = $this->db->query("SELECT * FROM temp_gaji WHERE ID_User = '$id_user' ");

					foreach ($query7->result() as $ac) {
						$gajipokok 		= $ac->GajiHadir;
						$gajilembur 	= $ac->GajiLembur;
						$tunjangan 		= $ac->Tunjangan;
						$potongan 		= $ac->Potongan;

						$gajitot = $gajipokok + $gajilembur + $tunjangan - $potongan;

						$data = array(
							'TotGajiAll' 	=> $gajitot
						);
						$where = array(
							'ID_Kary' 		=> $ac->ID_Kary,
							'ID_User' 		=> $id_user
						); 
						$this->M_gaji->update_data($where,$data,'temp_gaji');
					}

					redirect('Gaji');

				}else{
					$this->session->set_flashdata('error','Tidak Ada data');
					redirect('Gaji');
				}					
			}
		}elseif($submitdata == 'EXCEL'){
			$id = $this->session->userdata('ses_IdUser');
			$this->db->where('ID_User',$id);
			$query = $this->db->get('temp_gaji');
			if ($query->num_rows() > 0) {
				
				$semua_pengguna = $this->M_gaji->lihat_data_biasa($id);

				$spreadsheet = new Spreadsheet;

		          $spreadsheet->setActiveSheetIndex(0)
		                      ->setCellValue('A1', 'NO')
		                      ->setCellValue('B1', 'Nik/Kode Finger')
		                      ->setCellValue('C1', 'Status Karyawan')
		                      ->setCellValue('D1', 'Nama')
		                      ->setCellValue('E1', 'Kabag')
		                      ->setCellValue('F1', 'Department')
		                      ->setCellValue('G1', 'Gaji/Jam')
		                      ->setCellValue('H1', 'Lembur/Jam')
		                      ->setCellValue('I1', 'Total Hadir (Jam)')
		                      ->setCellValue('J1', 'Total Overtime (Jam)')
		                      ->setCellValue('K1', 'Nilai Gaji Pokok')
		                      ->setCellValue('L1', 'Nilai Lembur')
		                      ->setCellValue('M1', 'Nilai Total yang diterima');

		          $kolom = 2;
		          $nomor = 1;
		          foreach($semua_pengguna->result() as $pengguna) {

		               $spreadsheet->setActiveSheetIndex(0)
		                           ->setCellValue('A' . $kolom, $nomor)
		                           ->setCellValue('B' . $kolom, $pengguna->ID_Kary)
		                           ->setCellValue('C' . $kolom, $pengguna->NamaStatusKaryawan)
		                           ->setCellValue('D' . $kolom, $pengguna->NamaKary)
		                           ->setCellValue('E' . $kolom, $pengguna->KepalaBagian)
		                           ->setCellValue('F' . $kolom, $pengguna->NamaBagian)
		                           ->setCellValue('G' . $kolom, $pengguna->GajiJam)
		                           ->setCellValue('H' . $kolom, $pengguna->LemburJam)
		                           ->setCellValue('I' . $kolom, $pengguna->TotHadir)
		                           ->setCellValue('J' . $kolom, $pengguna->TotLembur)
		                           ->setCellValue('K' . $kolom, $pengguna->GajiHadir)
		                           ->setCellValue('L' . $kolom, $pengguna->GajiLembur)
		                           ->setCellValue('M' . $kolom, $pengguna->TotGajiAll);

		               $kolom++;
		               $nomor++;

		          }

		          $writer = new Xlsx($spreadsheet);

		          $nomor = date('his');

		         header('Content-Type: application/vnd.ms-excel');
			  header('Content-Disposition: attachment;filename="Laporan Gaji-"'.$nomor.'".xls');
			  header('Cache-Control: max-age=0');

			  $writer->save('php://output');

			}else{
				$this->session->set_flashdata('error','Data belum ada, silahkan klik tombol SEARCH dulu !!');
				redirect('Gaji');
			}

		}elseif($submitdata == 'RESET'){
			$id = $this->session->userdata('ses_IdUser');
			$query = $this->db->query("DELETE FROM temp_gaji WHERE ID_User = $id ");
			$this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); 
			redirect('Gaji');
		}elseif($submitdata == 'PRINT'){
			$id = $this->session->userdata('ses_IdUser');
			$this->db->where('ID_User',$id);
			$query = $this->db->get('temp_gaji');
			if ($query->num_rows() > 0) {
				$data['cetak'] = $this->M_gaji->lihat_data_biasa($id);
				$this->load->view('laporan/cetak_gaji',$data);	
			}else{
				$this->session->set_flashdata('error','Data belum ada, silahkan klik tombol SEARCH dulu !!');
				redirect('Gaji');				
			}
			
		}
	}

}
 ?>