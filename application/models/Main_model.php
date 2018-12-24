<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
		}

  public function get_admin($name, $pass, $role = 1)
    {
       if( $name && $pass && $role )
         return $this->db->get_where('users',['name'=>$name,'password'=>$pass,'role'=>$role,'is_active'=>1],1);
    }        

    public function not_reserve($table=null,$where=null,$wherenot=null,$select=null,$limit=null,$offset=null) 
    {
      if (!$table) :
        return false;
      else :
        if ($select){ 
          $this->db->select($select);
        }
        if ($where) {
          $this->db->where($where);
        }
        if ($wherenot) {
          $this->db->where_not_in('id',$wherenot);
        }
        $this->db->order_by('created_date','desc');
        return $this->db->get($table,$limit,$offset)->result();
      endif;        
    }
}