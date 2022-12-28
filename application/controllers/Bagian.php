<?php 

/**
 * 
 */
class Bagian extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

		$this->load->library("session");
		$this->load->library("pagination");
		
		$this->load->model("M_bagian");
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');

		if ($user == '') {
			redirect('login');
		}else{

			$this->db->query("DELETE FROM temp_gaji WHERE ID_User = $user ");

			if ($this->input->post('cek') == 'Cari' && $this->input->post('cari') != '') {
            $oke_cari = array(
                    'ses_cari_bagian' => $this->input->post('cari')
                    );
	            $this->session->set_userdata($oke_cari);
	            $search = $this->session->userdata('ses_cari_bagian');
	        }else if($this->input->post('cek') == '' && $this->input->post('cari') != ''){
	            $search = $this->session->userdata('ses_cari_bagian');
	        }
	        else if($this->input->post('cek') == '' && $this->input->post('cari') == ''){
	            $search = $this->session->userdata('ses_cari_bagian');
	        }
	        else if($this->input->post('cek') == 'Cari' && $this->input->post('cari') == ''){
	            $this->session->unset_userdata('ses_cari_bagian');
	            $search = '';
	        }else if($this->input->post('cek') == 'Reset'){
	            $this->session->unset_userdata('ses_cari_bagian');
	            $search = '';
	        }

	        $config["base_url"] 		= base_url() . "Bagian";
	        $config["total_rows"] 		= $this->M_bagian->get_count($search);
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

			$data['menu'] 	= 'bagian';
			$data['bagian'] = $this->M_bagian->lihat_data($config["per_page"], $page, $search);
			$this->load->view('template/header',$data);
			$this->load->view('master/bagian',$data);
			$this->load->view('template/footer');
		}
	}

	public function simpan()
	{
		$kode = $this->input->post('kode');
		$this->db->where('KodeBagian',$kode);
		$query = $this->db->get('m_bagian');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error','Kode sudah digunakan di bagian lain!!');
			redirect('Bagian');
		}else{
			$this->M_bagian->simpan_data();
			$this->session->set_flashdata('success','Data Berhasil Tersimpan !!');
			redirect('Bagian');
		}		
	}

	public function update()
	{
		$data = array(
			'KodeBagian' 	=> $this->input->post('kode'),
			'NamaBagian' 	=> $this->input->post('nama'),
			'KepalaBagian'	=> $this->input->post('kabag')
		);

		$where = array(
			'ID_Bagian' 	=> $this->input->post('id')
		);

		$this->M_bagian->update_data($where,$data,'m_bagian');
		$this->session->set_flashdata('success','Data Berhasil DiUpdate !!');
		redirect('Bagian');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
		$this->M_bagian->delete_data($id);
		$this->session->set_flashdata('success','Data Berhasil DiHapus !!');
		redirect('Bagian');
	}
}
 ?>