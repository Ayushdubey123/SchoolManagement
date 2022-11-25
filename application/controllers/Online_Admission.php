<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Online_Admission extends CI_Controller {


	public function index(){
		$this->load->view('online_admission');
	}

	public function add(){
			$data=array();
			$data=$this->input->post('school_id');
			$data=$this->input->post('type_id');
			$data=$this->input->post('admission_no');
			$data=$this->input->post('national_id');
			$data=$this->input->post('registration_no');
			$data=$this->input->post('name');
			$data=$this->input->post('group');
			$data=$this->input->post('phone');
			$data=$this->input->post('email');
			$data=$this->input->post('gender');
			$data=$this->input->post('blood_group');
			$data=$this->input->post('religion');
			$data=$this->input->post('caste');
			$data=$this->input->post('discount_id');
			$data=$this->input->post('present_address');
			$data=$this->input->post('permanent_address');
			$data=$this->input->post('second_language');
			$data=$this->input->post('previous_school');
			$data=$this->input->post('previous_class');
			$data=$this->input->post('father_name');
			$data=$this->input->post('father_name');
			$data=$this->input->post('father_phone');
			$data=$this->input->post('father_education');
			$data=$this->input->post('father_profession');
			$data=$this->input->post('father_designation');



	}


}
?>