<?php 

/**
 * 
 */
class Dashboard extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_dashboard');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');		

		if ($user=="") {
			redirect('login');
		}else{
			$this->db->query("DELETE FROM temp_gaji WHERE ID_User = $user ");
			$this->session->unset_userdata(array('ses_period','ses_tgl_awal','ses_tgl_akhir','ses_cari','ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_tgl_awal_lembur','ses_tgl_akhir_lembur'));
			
			$data['menu'] 			= 'dashboard';
			$data['char'] 			= $this->M_dashboard->lihat_chart();
			$data['tot_user'] 		= $this->M_dashboard->total_user();
			$data['tot_bagian']		= $this->M_dashboard->total_bagian();
			$data['tot_karyawan']	= $this->M_dashboard->total_karyawan();
			$this->load->view('template/header',$data);
			$this->load->view('dashboard/index',$data);
			$this->load->view('template/footer2');
		}
	}
}
 ?>