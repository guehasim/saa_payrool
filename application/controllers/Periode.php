<?php 

class Periode extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_periode');
	}

	public function index()
	{
		$data['menu'] 		= 'periode';
		$data['periode'] 	= $this->M_periode->lihat_data();
		$this->load->view('template/header',$data);
		$this->load->view('master/periode',$data);
		$this->load->view('template/footer');
	}

	public function simpan()
	{
		$tanggal 	= '01';
		$bulan  	= $this->input->post('periode_bulan');
		$tahun 		= $this->input->post('periode_tahun');
		$gab_periode= $tanggal.'-'.$bulan.'-'.$tahun;

		$periode 	= date('Y-m-d',strtotime($gab_periode));
		$tglawal 	= date('Y-m-d',strtotime($this->input->post('tgl_awal')));
		$tglakhir 	= date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		
		$this->db->where('NamaPeriode',$periode);
		$this->db->where('Tglawal_cutoff',$tglawal);
		$this->db->where('Tglakhir_cutoff',$tglakhir);
		$query = $this->db->get('m_periode');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error','Data Tidak Tersimpan, Periode tersebut sudah ada!');
			redirect('Periode');
		}else{
			$this->M_periode->simpan_data();
			$this->session->set_flashdata('success','Berhasil menyimpan!');
			redirect('Periode');
		}

	}

	public function update()
	{
		$tanggal 	= '01';
		$bulan  	= $this->input->post('periode_bulan');
		$tahun 		= $this->input->post('periode_tahun');
		$gab_periode= $tanggal.'-'.$bulan.'-'.$tahun;

		$id 		= $this->input->post('id');
		$periode 	= date('Y-m-d',strtotime($gab_periode));
		$tglawal 	= date('Y-m-d',strtotime($this->input->post('tgl_awal')));
		$tglakhir 	= date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

		$data = array(
			'NamaPeriode' 			=> $periode,
			'Tglawal_cutoff' 		=> $tglawal,
			'Tglakhir_cutoff'		=> $tglakhir
		);

		$where = array(
			'ID_periode'	=> $id
		);

		$this->M_periode->update_data($where,$data,'m_periode');

		$this->session->set_flashdata('success','Berhasil mengubah!');
		redirect('Periode');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
		$this->M_periode->delete_data($id);
		$this->session->set_flashdata('success','Berhasil menghapus!');
		redirect('Periode');
	}
}
 ?>