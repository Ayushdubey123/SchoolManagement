        public function addstudent() 
          {
              // echo json_encode("heeelmeme");
            try{
        $items = array();

        $items[] = 'school_id';
        $items[] = 'name';
        $items[] = 'mobile_no';       
        $items[] = 'email_id';
        $items[] = 'group';
        $items[] = 'gender';
        $items[] = 'dob';
        $items[] = 'fathername';
        $items[] = 'father_mobile';
        $items[] = 'father_email';
        $items[] = 'mother_name';        
        $items[] = 'mother_mobile';
        $items[] = 'mother_email';
        $items[] = 'parmanent_address';
        $items[] = '';
        $items[] = '';
        
        $items[] = '';
        $items[] = '';
        $items[] = '';
        
        $items[] = '';
        $items[] = '';
        $items[] = '';
        $items[] = '';
        $items[] = '';
        
        $items[] = '';
        $items[] = '';
        $items[] = '';
        $items[] = '';
        $items[] = '';
        
        $items[] = '';
        $items[] = '';
        
        //$items[] = 'is_guardian';
        $items[] = '';

            
          

        $data = elements($items, $_POST);
             // print_r($data);

        //      // redirect('student/index');
        

        // if ($this->input->post('id')) {
            
        //     $data['guardian_id'] = $this->input->post('guardian_id');
        //     $data['modified_at'] = date('Y-m-d H:i:s');
        //     $data['modified_by'] = logged_in_user_id();
        //     $data['status_type'] = $this->input->post('status_type');
                

        // } else {    
            
            // $data['created_at'] = date('Y-m-d H:i:s');
            // $data['created_by'] = logged_in_user_id();
            // $data['modified_at'] = date('Y-m-d H:i:s');
            // $data['modified_by'] = logged_in_user_id();
            // $data['status'] = 1;
            // $data['status_type'] = 'regular';
            // echo "hello";
            //  // create guardian and guardian user if not exist
            // if($this->input->post('is_guardian') == 'exist_guardian'){
                
            //     $data['guardian_id'] = $this->input->post('guardian_id');
                
            // }else{

                $info = array();
                $guardian = array();    

                $info['role_id']  = GUARDIAN;
                $info['name']     =  $this->input->post('gud_name');
                $info['phone'] = $this->input->post('gud_phone'); 
                $info['email'] = $this->input->post('gud_email'); 
                $info['username'] = $this->input->post('gud_username'); 
                $info['password'] = rand(5);

                // now creating guardian user
                $guardian['user_id'] = $this->student->create_custom_user($info);
                // echo($guardian['user_id']);
                // create guardian....     
              

                $guardian['school_id']    = $data['school_id'];
                $guardian['name']    = $this->input->post('gud_name');
                $guardian['phone']   = $this->input->post('gud_phone');
                $guardian['email']   = $this->input->post('gud_email');
                $guardian['profession']   = $this->input->post('gud_profession');
                $guardian['religion']   = $this->input->post('gud_religion');
                $guardian['national_id'] = $this->input->post('gud_national_id');
                $guardian['present_address']   = $this->input->post('gud_present_address');
                $guardian['permanent_address']   = $this->input->post('gud_permanent_address');
                $guardian['other_info']   = $this->input->post('gud_other_info');
                $guardian['created_at'] = date('Y-m-d H:i:s');
                $guardian['created_by'] = logged_in_user_id();
                $guardian['modified_at'] = date('Y-m-d H:i:s');
                $guardian['modified_by'] = logged_in_user_id();
                $guardian['status'] = 1;
                
                $student_info = array();
                $student = array(); 

                $student['guardian_id'] = $this->student->insert('guardians', $guardian);
                $guardian=[];                    
            // }                
            // create user 
                $student_info['role_id']  = STUDENT;
                $student_info['name']     =  $this->input->post('student_name');
                $student_info['phone'] = $this->input->post('student_phone'); 
                $student_info['email'] = $this->input->post('student_email'); 
                $student_info['username'] = $this->input->post('student_username'); 
                $student_info['password'] = rand(5);
               // print_r($student_info);die;
                
               
                // print_r(expression)  
                $student['school_id']    = $this->input->post('school_id');
                $student['name']    = $this->input->post('student_name');
                $student['phone']   = $this->input->post('student_phone');
                $student['email']   = $this->input->post('student_email');
                $student['group']   = $this->input->post('student_group');
                $student['gender']   = $this->input->post('student_gender');
                $student['dob'] = $this->input->post('student_dob');
                $student['fathername'] = $this->input->post('student_fathername');
                $student['father_mobile'] = $this->input->post('student_father_mobile');
                $student['father_email'] = $this->input->post('student_father_email');
                $student['mothername'] = $this->input->post('student_mothername');
                $student['mother_mobile'] = $this->input->post('student_mother_mobile');
                $student['mother_email'] = $this->input->post('student_mother_email');
                
                $student['permanent_address']   = $this->input->post('student_permanent_address');
                // $guardian['other_info']   = $this->input->post('gud_other_info');
                $student['created_at'] = date('Y-m-d H:i:s');
                // $student['created_by'] = logged_in_user_id();
                $student['modified_at'] = date('Y-m-d H:i:s');
                // $student['modified_by'] = logged_in_user_id();
                $student['status'] = 1;
                print_r($student);die;
                echo($student['student_permanent_address']);
                $data['student_id'] = $this->student->insert('students', $student);
                   echo json_encode($data);
                   die();
           //  if(!empty($data)){
           //      $result['status']=true;
           //      $result['message']="Student Inserts Successfully";
           //      $result['data']=$data;
           //  }else{
           //      $result['status']=false;
           //      $result['message']="Data Not Inserted Please Check It";
           //      $result['data']=[];
           // }
} catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
         }

     echo json_encode($result);

 }
