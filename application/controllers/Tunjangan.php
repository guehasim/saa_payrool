<?php 

/**
 * 
 */
class Tunjangan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_periode");
		$this->load->model("M_tunjangan");
		$this->load->model("M_karyawan");
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{			
			$data['periode']	= $this->M_periode->lihat_data();
			$data['menu'] 		= "tunjangan";
			$this->load->view('template/header',$data);
			$this->load->view('laporan/gab_tunjangan_potongan',$data);
			$this->load->view('template/footer');
		}
	}

	public function load_tunjangan()
	{
		if (isset($_GET['us']) ) {
            $id_periode 	= $_GET['us'];
            $nama_periode 	= $_GET['nama'];
            
            $data = array(
			'ses_tunjangan_periode'		=> $id_periode,
			'ses_tunjangan_nm_periode'	=> $nama_periode
			);

            $this->session->set_userdata($data);
            redirect('Tunjangan/view_tunjangan');
        }else{
        	echo "no";
        }
	}

	public function view_tunjangan()
	{
		if ($this->session->userdata('ses_tunjangan_periode') != NULL) {
			$periode 			= $this->session->userdata('ses_tunjangan_periode');
			$jenis 				= 0;
			$data['tunjangan']	= $this->M_tunjangan->lihat_data($periode,$jenis);
			$data['karyawan']	= $this->M_karyawan->lihat_data_biasa();
			$data['menu'] 		= "tunjangan";
			$this->load->view('template/header',$data);
			$this->load->view('laporan/tunjangan',$data);
			$this->load->view('template/footer');
		}else{
			$this->session->set_flashdata('error', 'Harus pilih di menu periode dulu');
			redirect('Tunjangan');
		}
	}

	public function load_potongan()
	{
		if (isset($_GET['us']) ) {
            $id_periode = $_GET['us'];
            $nama_periode 	= $_GET['nama'];
            
            $data = array(
			'ses_tunjangan_periode'		=> $id_periode,
			'ses_tunjangan_nm_periode'	=> $nama_periode
			);

            $this->session->set_userdata($data);
            redirect('Tunjangan/view_potongan');
        }else{
        	echo "no";
        }
	}

	public function view_potongan()
	{
		if ($this->session->userdata('ses_tunjangan_periode') != NULL) {
			$periode 			= $this->session->userdata('ses_tunjangan_periode');
			$jenis 				= 1;
			$data['tunjangan']	= $this->M_tunjangan->lihat_data($periode,$jenis);
			$data['karyawan']	= $this->M_karyawan->lihat_data_biasa();
			$data['menu'] 		= "tunjangan";
			$this->load->view('template/header',$data);
			$this->load->view('laporan/potongan',$data);
			$this->load->view('template/footer');	
		}else{
			$this->session->set_flashdata('error', 'Harus pilih di menu periode dulu');
			redirect('Tunjangan');
		}		
	}

	public function simpan_tunjangan()
	{
		$id_karyawan 	= $this->input->post('karyawan');
		$id_periode 	= $this->session->userdata('ses_tunjangan_periode');
		$this->db->where('ID_Kary',$id_karyawan);
		$this->db->where('ID_periode',$id_periode);
		$this->db->where('JenisTunjangan',0);
		$query = $this->db->get('tbl_tunjangan');
		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error', 'Tidak bisa menyimpan, karena karyawan tersebut sudah dapat tunjangan di periode '.$this->session->userdata('ses_tunjangan_nm_periode'));
			redirect('Tunjangan/view_tunjangan');
		}else{
			$this->M_tunjangan->simpan_data();
			$this->session->set_flashdata('success', 'Berhasil menyimpan');
			redirect('Tunjangan/view_tunjangan');
		}		
	}

	public function simpan_potongan()
	{
		$id_karyawan 	= $this->input->post('karyawan');
		$id_periode 	= $this->session->userdata('ses_tunjangan_periode');
		$this->db->where('ID_Kary',$id_karyawan);
		$this->db->where('ID_periode',$id_periode);
		$this->db->where('JenisTunjangan',1);
		$query = $this->db->get('tbl_tunjangan');
		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error', 'Tidak bisa menyimpan, karena karyawan tersebut sudah dapat tunjangan di periode '.$this->session->userdata('ses_tunjangan_nm_periode'));
			redirect('Tunjangan/view_potongan');
		}else{
			$this->M_tunjangan->simpan_data();
			$this->session->set_flashdata('success', 'Berhasil menyimpan');
			redirect('Tunjangan/view_potongan');
		}		
	}

	public function update_tunjangan()
	{
		$data = array(
			'ID_Kary' 			=> $this->input->post('karyawan'),
			'TotalTunjangan'	=> $this->input->post('total'),
			'KetTunjangan'		=> $this->input->post('keterangan'),
			'ID_User'			=> $this->session->userdata('ses_IdUser')
		);

		$where = array(
			'ID_Tunjangan' 		=> $this->input->post('id')
		);

		$this->M_tunjangan->update_data($where,$data,'tbl_tunjangan');
		
		$this->session->set_flashdata('success', 'Berhasil mengubah');
		redirect('Tunjangan/view_tunjangan');
	}

	public function update_potongan()
	{
		$data = array(
			'ID_Kary' 			=> $this->input->post('karyawan'),
			'TotalTunjangan'	=> $this->input->post('total'),
			'KetTunjangan'		=> $this->input->post('keterangan'),
			'ID_User'			=> $this->session->userdata('ses_IdUser')
		);

		$where = array(
			'ID_Tunjangan' 		=> $this->input->post('id')
		);

		$this->M_tunjangan->update_data($where,$data,'tbl_tunjangan');
		
		$this->session->set_flashdata('success', 'Berhasil mengubah');
		redirect('Tunjangan/view_potongan');
	}

	public function hapus_tunjangan()
	{
		$id = $this->input->post('id');
		$this->M_tunjangan->hapus_data($id);
		$this->session->set_flashdata('success','Berhasil dihapus!!');
		redirect('Tunjangan/view_tunjangan');
	}

	public function hapus_potongan()
	{
		$id = $this->input->post('id');
		$this->M_tunjangan->hapus_data($id);
		$this->session->set_flashdata('success','Berhasil dihapus!!');
		redirect('Tunjangan/view_potongan');
	}
}
 ?>