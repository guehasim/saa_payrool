<?php 

/**
 * 
 */
class M_shift extends CI_Model
{
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_shift ORDER BY ID_Shift DESC");
		return $query;
	}

	public function simpan_data()
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
			'Namashift' 		=> $this->input->post('nama'),
			'JamIntervalStart'	=> $jam_start,
			'JamStart' 			=> $jam_masuk,
			'JamEnd'			=> $jam_pulang,
			'JamIntervalEnd'	=> $jam_end,
			'KetShift'			=> $tampil
		);

		$this->db->insert('M_shift',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
	{
		$this->db->where('ID_Shift',$id);
        $this->db->delete('m_shift');
	}
}
 ?>