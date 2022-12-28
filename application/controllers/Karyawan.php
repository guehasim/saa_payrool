<?php 


/**
 * 
 */
class Karyawan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

		$this->load->library("session");
		$this->load->library("pagination");
		$this->load->library("upload");

		$this->load->model("M_karyawan");
		$this->load->model("M_bagian");
		$this->load->model("M_status_karyawan");
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{

			$this->db->query("DELETE FROM temp_gaji WHERE ID_User = $user ");
			$this->session->unset_userdata(array('ses_period','ses_tgl_awal','ses_tgl_akhir','ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_tgl_awal_lembur','ses_tgl_akhir_lembur'));

			if ($this->input->post('cek') == 'Cari' && $this->input->post('cari') != '') {
            $oke_cari = array(
                    'ses_cari' => $this->input->post('cari')
                    );
	            $this->session->set_userdata($oke_cari);
	            $search = $this->session->userdata('ses_cari');
	        }else if($this->input->post('cek') == '' && $this->input->post('cari') != ''){
	            $search = $this->session->userdata('ses_cari');
	        }
	        else if($this->input->post('cek') == '' && $this->input->post('cari') == ''){
	            $search = $this->session->userdata('ses_cari');
	        }
	        else if($this->input->post('cek') == 'Cari' && $this->input->post('cari') == ''){
	            $this->session->unset_userdata('ses_cari');
	            $search = '';
	        }else if($this->input->post('cek') == 'Reset'){
	            $this->session->unset_userdata('ses_cari');
	            $search = '';
	        }

	        $config["base_url"] 		= base_url() . "Karyawan";
	        $config["total_rows"] 		= $this->M_karyawan->get_count($search);
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

	        $data['nomor'] 	= $page;

	        $data["links"] 	= $this->pagination->create_links();

			$data['menu'] 	= 'karyawan';
			$data['status']	= $this->M_status_karyawan->lihat_data();
			$data['bagian'] = $this->M_bagian->lihat_bagian();
			$data['gaji'] = $this->M_karyawan->lihat_data($config["per_page"], $page, $search);
			$this->load->view('template/header',$data);
			$this->load->view('master/karyawan',$data);
			$this->load->view('template/footer');

		}
	}


	public function simpan()
	{
		$nik = $this->input->post('nik');
		$this->db->where('ID_Kary',$nik);
		$query = $this->db->get('m_karyawan');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error','NIK Sudah Digunakan !!');
			redirect('Karyawan');
		}else{			

			$config['upload_path'] = 'assets/upload/images/'; //path folder
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
	        $this->upload->initialize($config);

	        if(!empty($_FILES['image']['name'])){
		 
	            if ($this->upload->do_upload('image')){
	                $gbr = $this->upload->data();
	                //Compress Image
	                $config['image_library']='gd2';
	                $config['source_image']='assets/upload/images/'.$gbr['file_name'];
	                $config['create_thumb']= FALSE;
	                $config['maintain_ratio']= FALSE;
	                $config['quality']= '50%';
	                $config['width']= 400;
	                $config['height']= 500;
	                $config['new_image']= 'assets/upload/images/'.$gbr['file_name'];
	                $this->load->library('image_lib', $config);
	                $this->image_lib->resize();

	                $gambar=$gbr['file_name'];
	                // echo "Image berhasil diupload";

	                if (isset($_POST)) {
	                	$this->M_karyawan->simpan_data($gambar);

						$this->session->set_flashdata('success','Berhasil Menyimpan !!');
						redirect('Karyawan');						
	                }
	            }else{
	            	$this->session->set_flashdata('error', 'Ukuran Gambar Terlalu Besar atau format gambar tidak sesuai !!');
					redirect('Karyawan');
	            }
	                      
	        }else{
	        	$gambar = null;
	            if (isset($_POST)) {
	                	$this->M_karyawan->simpan_data($gambar);

						$this->session->set_flashdata('success','Berhasil Menyimpan !!');
						redirect('Karyawan');						
	                }
	        }
		}		
	}

	public function resign()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{

		$data['menu'] = 'karyawan';
		$data['gaji'] = $this->M_karyawan->lihat_data_resign();
		$this->load->view('template/header',$data);
		$this->load->view('master/resign',$data);
		$this->load->view('template/footer');

		}
	}

	public function update()
	{
		$config['upload_path'] = 'assets/upload/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->upload->initialize($config);

        if(!empty($_FILES['image']['name'])){
		 
            if ($this->upload->do_upload('image')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='assets/upload/images/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 400;
                $config['height']= 500;
                $config['new_image']= 'assets/upload/images/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar=$gbr['file_name'];
                // echo "Image berhasil diupload";

                $data = array(
					'ID_Kary'		=> $this->input->post('nik'),
					'NamaKary'		=> $this->input->post('nama'),
					'BagianKary'	=> $this->input->post('bagian'), 
					'GajiPokok'		=> $this->input->post('gajipokok'),
					'GajiLembur' 	=> $this->input->post('gajilembur'),
					'StatusKaryawan'=> $this->input->post('status'),
					'FotoKaryawan'	=> $gambar
					);

				$where = array(
					'ID_Karyawan' 	=> $this->input->post('id')
					);

				$this->M_karyawan->update_data($where,$data,'m_karyawan');

                
            }else{
            	$this->session->set_flashdata('error', 'Ukuran Gambar Terlalu Besar atau format gambar tidak sesuai !!');
				redirect('Karyawan');
            }
                      
        }else{
        	$data = array(
				'ID_Kary'		=> $this->input->post('nik'),
				'NamaKary'		=> $this->input->post('nama'),
				'BagianKary'	=> $this->input->post('bagian'), 
				'GajiPokok'		=> $this->input->post('gajipokok'),
				'GajiLembur' 	=> $this->input->post('gajilembur'),
				'StatusKaryawan'=> $this->input->post('status')
				);

			$where = array(
				'ID_Karyawan' 	=> $this->input->post('id')
				);

			$this->M_karyawan->update_data($where,$data,'m_karyawan');
        }

		$this->session->set_flashdata('success','Berhasil Diubah!');
		redirect('Karyawan');
	}

	public function import_karyawan()
	{
		
	}

	public function update_status()
	{
		$id 		= $this->input->post('id');

		$data = array(
			'StatusKary'	=> 1
			);

		$where = array(
			'ID_Karyawan' 	=> $id
			);

		$this->M_karyawan->update_data($where,$data,'m_karyawan');

		$this->session->set_flashdata('success','Berhasil Statusnya jadi Resign!');
		redirect('Karyawan');
	}

	public function update_aktif()
	{
		$id 		= $this->input->post('id');

		$data = array(
			'StatusKary'	=> 0
			);

		$where = array(
			'ID_Karyawan' 	=> $id
			);

		$this->M_karyawan->update_data($where,$data,'m_karyawan');

		$this->session->set_flashdata('success','Karyawan Status Aktif Kembali!');
		redirect('Karyawan/resign');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
		$this->M_karyawan->hapus_data($id);
		$this->session->set_flashdata('success','Berhasil Dihapus!');
		redirect('Karyawan');
	}
}
 ?>