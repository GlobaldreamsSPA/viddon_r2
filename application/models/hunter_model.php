<?php
Class Hunter_model extends CI_Model
{

   function __construct()
   {
     parent::__construct();
   }

   function login($email, $password)
   {
     $this->db->select('id, name, email, password, about_us, we_look_for, logo');
     $this->db->from('entities');
     $this->db->where('email', $email);
     $this->db->where('password', MD5($password));
     $this->db->limit(1);

     $query = $this->db->get();
     $first_row = $query->first_row('array');

     if($query->num_rows() > 0)
     {
       return $first_row;
     }
     else
     {
       return false;
     }
   }

	function update($profile)
	{
		$data = array(
				'name' => $profile['name'],
				'email' => $profile['email'],
				'address' => $profile['address'],
				'about_us' => $profile['about_us'],
				'we_look_for' => $profile['we_look_for']
			);

		$this->db->where('id', $profile['id']);
		$this->db->update('entities', $data);
	}

	function select($id)
	{
		//Rescatar los datos de la tabla entities
		$this->db->select('name, email, address,about_us, we_look_for,logo');
		$this->db->from('entities');
		$this->db->where('id', $id);
		$query = $this->db->get()->first_row('array');

		return $query;
	}
}
?>