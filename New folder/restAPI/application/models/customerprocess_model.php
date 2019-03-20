<?php 
 
class Customerprocess_model extends CI_Model{
	

	function __construct() {
        parent::__construct();
    }
     

	public function get_by_id($id)
	{
		$this->db->from('customer');
		$this->db->where('Id_customer',$id);
		$query = $this->db->get();

	return $query->row();
	}
	
	public function update($where, $data)
	{
		$this->db->update('customer', $data, $where);
		return $this->db->affected_rows();
	}

	//-------------------------------------------------------------
	public function add($data)
	{
		$this->db->insert('customer', $data);
		return $this->db->insert_id();
	}

	public function delete($Id_customer)
	{
		$this->db->where('Id_customer', $Id_customer);
		$this->db->delete('customer');
	}


	


}
?>