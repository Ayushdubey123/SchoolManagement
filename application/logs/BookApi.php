<?php
	
	class ComplainApi extends CI_Controller
    {   

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('report');
		$this->load->model('../modules/library/models/Book_Model', 'book', true);
        $this->load->model('Auth_Model', 'auth', true);        
    }







}

?>