<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Branch_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_class_list($school_id = null){
        
        $this->db->select('B.*, S.school_name');
        $this->db->from('branch AS B');
        $this->db->join('schools AS S', 'S.id = B.school_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('C.school_id', $this->session->userdata('school_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $school_id){
            $this->db->where('C.school_id', $school_id);
        }        
        $this->db->where('S.status', 1);
        
        return $this->db->get()->result();
        
    }
    

    
    function duplicate_check($school_id, $name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        $this->db->where('school_id', $school_id);
        return $this->db->get('classes')->num_rows();            
    }
}
