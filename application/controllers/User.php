<?php 

/**
 * 
 */
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$this->session->unset_userdata('ses_cari'); //hapus session cari karyawan
			$this->session->unset_userdata(array('ses_period_awal','ses_period_akhir','ses_dept','ses_karyawan')); //hapus session cari laporan
			
			$data['user'] 	= $this->M_user->lihat_user();
			$data['menu'] 	= "user";
			$this->load->view('template/header',$data);
			$this->load->view('master/user',$data);
			$this->load->view('template/footer');
		}
	}

	public function simpan()
	{
		$user = $this->input->post('user');

		$this->db->where('Username', $user);
		$query = $this->db->get('M_user');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('error','Data Tidak Tersimpan, Username Sudah Ada!');
			redirect('User');
		}else{
			if (isset($_POST)) {
			$this->M_user->simpan_user();
			 $this->session->set_flashdata('success', 'Berhasil Menyimpan');
			redirect('User');
			}
		}	
	}

	public function update()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$user 		= $this->input->post('user');

		$data = array(
			'NamaUser'	=> $nama,
			'Username' 	=> $user
			);

		$where = array(
			'ID_User' 		=> $id
			);

		$this->M_user->update_data($where,$data,'M_user');

		$this->session->set_flashdata('success','Berhasil Diubah!');
		redirect('User');
	}

	public function update_password()
	{
		$id 	= $this->input->post('id');
		$pwd 	= sha1(md5($this->input->post('pass')));

		$data = array(
			'PassUser'  		=> $pwd,
			);

		$where = array(
			'ID_User' 		=> $id
			);

		$this->M_user->update_data($where,$data,'M_user');

		$this->session->set_flashdata('info','Password Berhasil DiGanti!');
		redirect('User');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
        $this->M_user->delete_user($id);
        $this->session->set_flashdata('success','Berhasil DiHapus!');
        redirect('User');
	}
}
 ?>