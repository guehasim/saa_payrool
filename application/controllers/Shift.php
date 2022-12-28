<?php 

/**
 * 
 */
class Shift extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_shift');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$this->session->unset_userdata('ses_cari'); //hapus session cari karyawan
			$this->session->unset_userdata(array('ses_period_awal','ses_period_akhir','ses_dept','ses_karyawan')); //hapus session cari laporan
			
			$data['shift'] 	= $this->M_shift->lihat_data();
			$data['menu'] 	= "shift";
			$this->load->view('template/header',$data);
			$this->load->view('master/shift',$data);
			$this->load->view('template/footer');
		}
	}

	public function simpan()
	{
		$nama 		= $this->input->post('nama');
		$this->db->where('NamaShift',$nama);
		$query = $this->db->get('m_shift');
		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error','Shift kerja tersebut sudah ada');
			redirect('Shift');
		}else{
			$this->M_shift->simpan_data();
			$this->session->set_flashdata('success','Berhasil disimpan');
			redirect('Shift');
		}
	}

	public function update()
	{
		$jam_masuk 		= date('Y-m-d H:i:s',strtotime('1970-01-01'.$this->input->post('jam')));
		$interval_masuk = date_create('1970-01-01'.$this->input->post('jam'));
		date_add($interval_masuk, date_interval_create_from_date_string('-1 hours'));
		$jam_start 		= date_format($interval_masuk, 'Y-m-d H:i:s');
		$jam_pulang 	= date('Y-m-d H:i:s',strtotime('1970-01-01'.$this->input->post('jam_pulang')));
		$interval_pulang= date_create('1970-01-01'.$this->input->post('jam_pulang'));
		date_add($interval_pulang, date_interval_create_from_date_string('4 hours'));
		$jam_end 		= date_format($interval_pulang, 'Y-m-d H:i:s');

		if($this->input->post('ket') != NULL){
			$tampil = $this->input->post('ket');
		}else{
			$tampil = 0;
		}


		$data = array(
			'NamaShift'			=> $this->input->post('nama'),
			'JamIntervalStart'	=> $jam_start,
			'JamStart'			=> $jam_masuk,
			'JamEnd'			=> $jam_pulang,
			'JamIntervalEnd'	=> $jam_end,
			'KetShift'			=> $tampil
		);

		$where = array(
			'ID_Shift'			=> $this->input->post('id')
		);

		$this->M_shift->update_data($where,$data,'m_shift');
		$this->session->set_flashdata('success','Berhasil di update');
		redirect('Shift');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
		$this->M_shift->hapus_data($id);
		$this->session->set_flashdata('success','Berhasil dihapus');
		redirect('Shift');
	}
}
 ?>