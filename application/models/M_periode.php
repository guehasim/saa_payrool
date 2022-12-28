<?php 

/**
 * 
 */
class M_periode extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_periode ORDER BY ID_periode DESC");
		return $query;
	}

	public function simpan_data()
	{

		$tanggal 	= '01';
		$bulan  	= $this->input->post('periode_bulan');
		$tahun 		= $this->input->post('periode_tahun');
		$gab_periode= $tanggal.'-'.$bulan.'-'.$tahun;

		$periode 	= date('Y-m-d',strtotime($gab_periode));
		$tglawal 	= date('Y-m-d',strtotime($this->input->post('tgl_awal'))).' '.'07:00:00';
		$tglakhir 	= date('Y-m-d',strtotime('+1 days',strtotime($this->input->post('tgl_akhir')))).' '.'08:00:00';
		
		$data = array(
			'NamaPeriode' 		=> $periode,
			'Tglawal_cutoff'	=> $tglawal,
			'Tglakhir_cutoff' 	=> $tglakhir
		);

		$this->db->insert('m_periode',$data);		
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function delete_data($id)
	{
		$this->db->where('ID_periode',$id);
        $this->db->delete('m_periode');

        $this->db->where('ID_periode',$id);
        $this->db->delete('tbl_kalkulasi');
        
        $this->db->where('ID_periode',$id);
        $this->db->delete('tbl_tunjangan');

	}
}
 ?>