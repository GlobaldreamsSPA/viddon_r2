<?php
Class Hunter_model extends CI_Model
{

   function __construct()
   {
     parent::__construct();
   }

   function login($email, $password)
   {
     $this->db->select('id, email, password, about_us, we_look');
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
}
?>