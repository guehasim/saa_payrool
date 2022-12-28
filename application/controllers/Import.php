<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller {

public function __construct() {
parent::__construct();
// load model
	$this->load->model('Import_model', 'tbl_temp_import');
	$this->load->helper(array('url','html','form'));
}

public function importFile(){
			$id = $this->session->userdata('ses_IdUser');
			$query = $this->db->query("DELETE FROM tbl_temp_import WHERE temp_id_user = '$id' ");
			$path = 'uploads/';
			require_once APPPATH . "/third_party/PHPExcel.php";
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uploadFile')) {
			$error = array('error' => $this->upload->display_errors());
			} else {
			$data = array('upload_data' => $this->upload->data());
			}
			
			if(empty($error)){
				if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
				} else {
				$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$flag = true;
					$i=0;
					foreach ($allDataInSheet as $value) {
						if($flag){
						$flag =false;
						continue;
						}
					$inserdata[$i]['temp_kd_status'] 	= $value['A'];
					$inserdata[$i]['temp_kd_dept'] 		= $value['B'];
					$inserdata[$i]['temp_id_kary'] 		= $value['C'];
					$inserdata[$i]['temp_nama'] 		= $value['D'];
					$inserdata[$i]['temp_gaji'] 		= $value['E'];
					$inserdata[$i]['temp_lembur']		= $value['F'];
					$inserdata[$i]['temp_id_user']		= $this->session->userdata('ses_IdUser');
					$i++;
					}               
					$result = $this->tbl_temp_import->insert($inserdata);
					redirect('Import/gofilter');   
				} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
				}
			}else{
			echo $error['error'];
			}	
	}

	public function gofilter()
	{
		$id = $this->session->userdata('ses_IdUser');
		$query = $this->db->query("SELECT * FROM tbl_temp_import WHERE temp_id_user = '$id' ");
		foreach ($query->result() as $ad) {
			$kd_status 	= $ad->temp_kd_status;
			$kd_dept 	= $ad->temp_kd_dept;
			$id_kary 	= $ad->temp_id_kary;
			$nama 		= $ad->temp_nama;
			$gaji 		= $ad->temp_gaji;
			$lembur 	= $ad->temp_lembur;

			$this->db->where('ID_Kary',$id_kary);
			$query = $this->db->get('m_karyawan');
			if ($query->num_rows() > 0) {

				$query1 = $this->db->query("SELECT * FROM m_bagian WHERE KodeBagian = '$kd_dept' ");
				foreach ($query1->result() as $aa) {
					$id_dept = $aa->ID_Bagian;
				}

				$query2 = $this->db->query("SELECT * FROM m_status_karyawan WHERE KodeStatusKaryawan = '$kd_status' ");
				foreach ($query2->result() as $ab) {
					$id_status = $ab->ID_StatusKaryawan;
				}
				
				$data = array(
					'NamaKary'		=> $nama,
					'BagianKary'	=> $id_dept,
					'GajiPokok'		=> $gaji,
					'GajiLembur'	=> $lembur,
					'StatusKaryawan'=> $id_status
				);

				$where = array(
					'ID_Kary'		=> $id_kary
				);

				$this->db->where($where);
				$this->db->update('m_karyawan',$data);

			}else{
				$query1 = $this->db->query("SELECT * FROM m_bagian WHERE KodeBagian = '$kd_dept' ");
				foreach ($query1->result() as $aa) {
					$id_dept = $aa->ID_Bagian;
				}

				$query2 = $this->db->query("SELECT * FROM m_status_karyawan WHERE KodeStatusKaryawan = '$kd_status' ");
				foreach ($query2->result() as $ab) {
					$id_status = $ab->ID_StatusKaryawan;
				}

				$query = $this->db->query("INSERT INTO m_karyawan(ID_Kary,NamaKary,BagianKary,GajiPokok,GajiLembur,StatusKary,StatusKaryawan,FotoKaryawan) SELECT temp_id_kary,temp_nama,$id_dept,$gaji,$lembur,0,$id_status,NULL FROM tbl_temp_import WHERE temp_id_user = $id");
			}
		}

		$this->session->set_flashdata('success','Berhasil Upload Data !!');
		redirect('Karyawan');
	}
}
?>