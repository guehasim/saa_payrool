<?php 

/**
 * 
 */
class Statuskaryawan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_status_karyawan');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$this->session->unset_userdata('ses_cari'); //hapus session cari karyawan
			$this->session->unset_userdata(array('ses_period_awal','ses_period_akhir','ses_dept','ses_karyawan')); //hapus session cari laporan
			
			$data['status'] 	= $this->M_status_karyawan->lihat_data();
			$data['menu'] 		= "status";
			$this->load->view('template/header',$data);
			$this->load->view('master/statuskaryawan',$data);
			$this->load->view('template/footer');
		}
	}

	public function simpan()
	{
		$kode = $this->input->post('kode');

		$this->db->where('KodeStatusKaryawan', $kode);
		$query = $this->db->get('m_status_karyawan');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error','Data Tidak Tersimpan, Kode Sudah Ada!');
			redirect('Statuskaryawan');
		}else{
			$this->M_status_karyawan->simpan_data();
			$this->session->set_flashdata('success', 'Berhasil Menyimpan');
			redirect('Statuskaryawan');
		}	
	}

	public function update()
	{
		$data = array(
			'NamaStatusKaryawan'	=> $this->input->post('nama')
		);

		$where = array(
			'ID_StatusKaryawan' 	=> $this->input->post('id')
		);

		$this->M_status_karyawan->update_data($where,$data,'m_status_karyawan');
		$this->session->set_flashdata('success', 'Berhasil Diubah');
		redirect('Statuskaryawan');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
		$this->M_status_karyawan->delete_data($id);
        $this->session->set_flashdata('success','Berhasil DiHapus!');
        redirect('Statuskaryawan');
	}
}
 ?>