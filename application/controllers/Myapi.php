
 <?php 
    // defined('BASEPATH') OR exit('No direct script access allowed');

     class Myapi extends CI_Controller
    {   

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('report');
		$this->load->model('../modules/teacher/models/Teacher_Model', 'teacher', true);
		$this->load->model('../modules/student/models/Student_Model', 'student', true);
        $this->load->model('../modules/attendance/models/Student_Model', 'student_att', true);
        $this->load->model('../modules/complain/models/Complain_Model','complain',true);
        $this->load->model('../modules/event/models/Event_Model','event',true);
        $this->load->model('../modules/announcement/models/Notice_Model','notice',true);
        $this->load->model('Auth_Model', 'auth', true);        
    }

/// Api For Teacher Login
 //    public function teacher_login_post()
 //    {
	// 		$result=array();

	// try {
 //    		$data['username'] = $this->input->post('username');           
 //            $data['password'] = md5($this->input->post('password'));
 //            $login = $this->auth->get_single('users', $data);
 //            if (!empty($login)) {
 //            $teacher_data=$this->get_teacher_info($login->id);
 //              $result['status']=true;
 //              $result['message']="Login Successfully";
 //              $result['data']=array("teacher_data"=>$teacher_data,
 //                "login_auth"=>$login);

 //              }
 //              else{
 //              $result['status']=false;
 //              $result['message']="Login Faileds";
 //              $result['data']=[];
 //              }

 //    	} catch (Exception $e) {
 //              $result['status']=false;
 //              $result['message']=$e;
 //              $result['data']=[];
    		
 //    	}
	// 		echo json_encode($result);
            
 //    }



    //get student list by class teacher
    // SELECT *, students.id as studentId,enrollments.id as EnrollId FROM `enrollments` INNER JOIN students on enrollments.student_id=students.id where students.school_id="5" and class_id=(select id from classes where teacher_id="2")

// public function get_teacher_info($id)
// {
//           $query_teacher="select *, id as teacher_id from teachers where user_id=".$id;
//            $teache_data=$this->db->query($query_teacher)->result_array();
//            return $teache_data;

// }

/// Api For Find Student By School Or Teacher Id
    	public function Find_Student()
 	{

           $result=array();
        try {

     		 	$school_id= $this->input->post('school_id');         
                $user_id= $this->input->post('teacher_id');
                $query_teacher="select *, id as teacher_id from teachers where user_id=".$user_id;
                $teache_data=$this->db->query($query_teacher)->result_array();
                $teacher_id=$teache_data[0]['teacher_id'];
             
                $Alldata=$this->db->query("SELECT *, students.id as studentId,enrollments.id as EnrollId FROM `enrollments` INNER JOIN students on enrollments.student_id=students.id where students.school_id='".$school_id."' and enrollments.class_id =(SELECT id FROM classes where teacher_id='".$teacher_id."' limit 1 )")-> result_array();

            if (!empty($Alldata)) {
              $result['status']=true;
              $result['message']="Data Find Successfully";
              $result['data']=$Alldata;
              }else{
              $result['status']=false;
              $result['message']="Data Not Found";
              $result['data']=[];
              } 	

    } catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
            
        }
            echo json_encode($result);
        
 	}	
 	

       

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
                // $info['name']     =  $this->input->post('gud_name');
                // $info['phone'] = $this->input->post('gud_phone'); 
                // $info['email'] = $this->input->post('gud_email'); 
                $info['username'] = $this->input->post('gud_username'); 
                $info['password'] ="password";

                // now creating guardian user
                // $guardian['user_id'] = $this->student->create_custom_user($info);
                // echo($guardian['user_id']);
                // create guardian....     
                  $data=$this->db->insert('users',$info);
                // $this->db->insert_data($data);
                 print_r($data);
                 die();

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
               //  $student['user_id'] = $this->student->create_custom_user($student_info);
                    $this->db->insert('users',$student);

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
} catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
         }

     echo json_encode($result);

 }

/// Api For Get All Class  By Teacher Id
    public function get_all_steram()
        {   
            $result=array();
            try{
         $school_id= $this->input->post('school_id');    
         $user_id= $this->input->post('user_id');
         $teacher_id= $this->input->post('teacher_id');

         $data=$this->db->query("SELECT classes.name as class_name,classes.id as class_id,enrollments.academic_year_id as academic_year FROM `classes` INNER JOIN enrollments on enrollments.class_id=classes.id  INNER JOIN  subjects ON classes.id=subjects.class_id   where classes.teacher_id='".$teacher_id."' group by class_id")->result_array();

            if (!empty($data)) {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully";
                  $result['data']=$data;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found";
                  $result['data']=[];
              } 
        }
        catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
            
        }
            echo json_encode($result);
        }


/// Api For Get Subject By Class ID And Teacher IDs
    public function get_subject_classID(){
        $result=array();
        try{
        $school_id= $this->input->post('school_id');  
        $class_id= $this->input->post('class_id');   
        $user_id= $this->input->post('teacher_id');
        $query_teacher="select *,id as teacher_id from teachers where user_id=".$user_id;
        $teacher_data=$this->db->query($query_teacher)->result_array();
        $teacher_id=$teacher_data[0]['teacher_id']; 
        $record=$this->db->query("SELECT *,classes.name as class_name,subjects.id as subject_id FROM `classes`  INNER JOIN subjects ON classes.id=subjects.class_id   WHERE subjects.class_id='".$class_id."' and subjects.teacher_id='".$teacher_id."'")->result_array();
            if(!empty($record))
              {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully";
                  $result['data']=$record;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found";
                  $result['data']=[];
              }
     }catch(Exception $e){
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
        }

            echo json_encode($result);
}


//Api For Get Section By Class Id
    public function get_section_classId(){
        $result=array();
        try{
            $class_id=$this->input->post('class_id');
            $teacher_id=$this->input->post('teacher_id');
            $section_data=$this->db->query("SELECT sections.name as section_name,sections.id as section_id from `sections` where class_id='".$class_id."' and teacher_id='".$teacher_id."' ")->result_array();
            if(!empty($section_data))
                {
                  $result['status']=true;
                  $result['message']="Get All Section Successfully";
                  $result['data']=$section_data;
              }else{
                  $result['status']=false;
                  $result['message']="Section Not Found";
                  $result['data']=[];
              }    
              echo json_encode($result);


        }catch(Exception $e){
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
        }

    }   

// //Api For Student Attendance
//     public function student_attendance() {

//           $result=array();
//        try{
       
//         if ($_POST) {
//             $insert_record=false;
//             $school_id  = $this->input->post('school_id');
//             $class_id = $this->input->post('class_id');
//             $section_id = $this->input->post('section_id');
//             $date = $this->input->post('date');
//             $students = $this->input->post('students');
//             $subject_id= $this->input->post('subject_id');
//             $month = date('m', strtotime($this->input->post('date')));
//             $year = date('Y', strtotime($this->input->post('date')));
//             $school = $this->student->get_school_by_id($school_id);        
//             $condition = array(
//                 'school_id' => $school_id,
//                 'class_id' => $class_id,
//                 'academic_year_id' => $school->academic_year_id,
//                 'subject_id' => $subject_id,
//                 'month' => $month,
//                 'year' => $year
//             );
            
//             if($section_id){
//                 $condition['section_id'] = $section_id;
//             }

//             $data = $condition;
//             // echo $students ;
//             // echo date('d', strtotime($this->input->post('date'))) ;
            
//                 foreach (json_decode($students) as $obj) {
//                     $condition['student_id'] = $obj->id;
//                     $attendance = $this->student->get_single('student_attendances', $condition);
//                     $data['student_id'] = $obj->id;
//                         $data['status'] = $obj->status;
                          
//                     if (empty($attendance)) {                          
//                         $data['created_at'] = date('Y-m-d H:i:s');
//                         $data['created_by'] = logged_in_user_id();
                        
//                         $data["day_".abs(date('d', strtotime($this->input->post('date'))))] =$obj->attendance ;
                        
//                         // print_r($data);die;
//                      $insert_record=   $this->student->insert('student_attendances', $data);


//                     }
//                     else{
//                      $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
//                         $insert_record=$this->student->update('student_attendances', array($field => $obj->attendance , 'modified_at'=>date('Y-m-d H:i:s')), $data); 

//                     }

//             }

//             $this->data['academic_year_id'] = $school->academic_year_id;
//             $this->data['day'] = date('d', strtotime($this->input->post('date')));
//             $this->data['month'] = date('m', strtotime($this->input->post('date')));
//             $this->data['year'] = date('Y', strtotime($this->input->post('date')));
//             $this->data['school_id'] = $school_id;
//             $this->data['class_id'] = $class_id;
//             $this->data['section_id'] = $section_id;
//             $this->data['subject_id'] = $subject_id;
//             $this->data['date'] = $date;
        
//         if($insert_record){

//               $result['status']=true;
//               $result['message']='attendance Successfully';
//               $result['data']=$students;    
            
//         }else{

//               $result['status']=false;
//               $result['message']='attendance Unsuccessfully';
//               $result['data']=$students;    
            
//         }
//             create_log('Has been process student attendance'); 


//         }

        
//        }catch(Exception $e){
//               $result['status']=false;
//               $result['message']=$e;
//               $result['data']=[];
//         }
//          echo json_encode($result);

//     }


    /// Api For Find Student By School Or Teacher Id
        public function Find_Student_By_class_section()
    {

           $result=array();
        try {

                $school_id= $this->input->post('school_id');         
                $class_id= $this->input->post('class_id');         
                $section_id= $this->input->post('section_id');
            
                $AllStudent=$this->db->query("SELECT *, students.id as studentId,enrollments.id as EnrollId FROM `enrollments` INNER JOIN students on enrollments.student_id=students.id where enrollments.school_id='".$school_id."'and   -enrollments.class_id='".$class_id."' and enrollments.section_id ='".$section_id."'")-> result_array();

            if (!empty($AllStudent)) {
              $result['status']=true;
              $result['message']="Data Find Successfully";
              $result['data']=$AllStudent;
              }else{
              $result['status']=false;
              $result['message']="Data Not Found";
              $result['data']=[];
              }     

         } catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
            
        }
            echo json_encode($result);
        
    }   


// Api For School All Gallery Images By School_id
    public function get_school_gallery(){
        try{
            $school_id= $this->input->post('school_id');

            $school_gallery=$this->db->query("SELECT * from gallery_images WHERE school_id='".$school_id."'")->result_array();
         
             if (!empty($school_gallery)) {
              $result['status']=true;
              $result['message']="These Are School Gallery's";
              $result['data']=$school_gallery;
              }else{
              $result['status']=false;
              $result['message']="Data Not Found";
              $result['data']=[];
              } 

        }catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
            
        }
             echo json_encode($result);
    }





//Api Add Event
      public function event_data() {

        $data = array();
        $data['school_id'] = $this->input->post('school_id');;
        $data['role_id'] = $this->input->post('role_id');
        $data['title'] = $this->input->post('title');
        $data['event_place'] =$this->input->post('event_place');
        $data['note'] = $this->input->post('note');
        $data['event_from'] = date('Y-m-d', strtotime($this->input->post('event_from')));
        $data['event_to'] = date('Y-m-d', strtotime($this->input->post('event_to')));

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        if (isset($_FILES['image']['name'])) {
            $data['image'] = $this->_upload_image();
        }

             $insert_record=$this->event->insert('events', $data);
            
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));        
            
    }



    private function _upload_image() {
        $prev_image = $this->input->post('prev_image');
        $image = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $return_image = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                $destination = 'assets/uploads/event/';

                $file_type = explode(".", $image);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $image_path = 'event-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['image']['tmp_name'], $destination . $image_path);

                // need to unlink previous image
                if ($prev_image != "") {
                    if (file_exists($destination . $prev_image)) {
                        @unlink($destination . $prev_image);
                    }
                }

                $return_image = $image_path;
            }
        } else {
            $return_image = $prev_image;
        }

        return $return_image;
    }




// //Api For Add Complain
//      public function complain_data() {
//         // $items = array();
//         $data['school_id'] = $this->input->post('school_id');
//         $data['role_id'] = $this->input->post('role_id');
//         $data['class_id'] = $this->input->post('class_id');
//         $data['user_id'] = $this->input->post('user_id');
//         $data['type_id'] = $this->input->post('type_id');
//         $data['description'] = $this->input->post('description');
//         $data['action_note'] = $this->input->post('action_note');   
//         $data['complain_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('complain_date')));
   

//         if ($this->input->post('id')) {
            
//             $data['action_date'] = date('Y-m-d H:i:s');
//             $data['modified_at'] = date('Y-m-d H:i:s');
//             $data['modified_by'] = logged_in_user_id();
            
//         } else {
            
//             $data['status'] = 1;
//             $data['created_at'] = date('Y-m-d H:i:s');
//             $data['created_by'] = logged_in_user_id();
            
//             $school = $this->complain->get_school_by_id($data['school_id']);
            
//             if(!$school->academic_year_id){
//                 error($this->lang->line('set_academic_year_for_school'));
            
//             }            
//             $data['academic_year_id'] = $school->academic_year_id;
           
//             $insert_record=$this->complain->insert('complains', $data);
            
//             return $this->output
//             ->set_content_type('application/json')
//             ->set_status_header(200)
//             ->set_output(json_encode($data));        
            

//         }
//         // echo json_encode($data);
//     }

// // Api For Add Notice
//     public function add_notice(){

//         // $items = array();
//         $data['school_id'] = $this->input->post('school_id');
//         $data['role_id'] = $this->input->post('role_id');
//         $data['title'] = $this->input->post('title');
//         $data['notice'] = $this->input->post('notice');
        
//         $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));

//         if ($this->input->post('id')) {
//             $data['modified_at'] = date('Y-m-d H:i:s');
//             $data['modified_by'] = logged_in_user_id();
//         } else {
//             $data['status'] = 1;
//             $data['created_at'] = date('Y-m-d H:i:s');
//             $data['created_by'] = logged_in_user_id();
//         }

//         $notice_insert=$this->notice->insert('notices',$data);

//            return $this->output
//             ->set_content_type('application/json')
//             ->set_status_header(200)
//             ->set_output(json_encode($data));  

//     }







}




// public function student_history(){
//     $school_id = $this->input->post('school_id');
//     $class_id = $this->input->post('class_id');
//     $status_type = $this->input->post('status_type');
//     $section_id = $this->input->post('section_id');
//     $subject_id = $this->input->post('subject_id');
//     $student_id = $this->input->post('student_id');
//     $date = $this->input->post('date');
//     // $student_id = $this->input->post('student_id');
//     $month = date('m', strtotime($this->input->post('date')));
//     $year = date('Y', strtotime($this->input->post('date')));
//     $school = $this->student_att->get_school_by_id($school_id);
//     $end_date = $this->input->post('end_date');


//     $condition = array(
//         'school_id' => $school_id,
//         'class_id' => $class_id,
//         'academic_year_id' => $school->academic_year_id,
//         'month' => $month,
//         'year' => $year,
//         'student_id' => $student_id
//     );
    
//     if($section_id){
//         $condition['section_id'] = $section_id;
//         $condition['subject_id'] = $subject_id;
//     }

//     $data = $condition;
    
//     $this->db->select('S.*, E.roll_no, E.class_id, E.section_id, U.username, U.role_id,  C.name AS class_name, SE.name AS section');
//     $this->db->from('enrollments AS E');
//     $this->db->join('students AS S', 'S.id = E.student_id', 'left');
//     $this->db->join('users AS U', 'U.id = S.user_id', 'left');
//     $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
//     $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
//     $this->db->where('E.academic_year_id', $school->academic_year_id);       
//     $this->db->where('E.class_id', $class_id);

// if($section_id){
//     $this->db->where('E.section_id', $section_id);
// }
// if($status_type){
//     $this->db->where('S.status_type', 'regular');
// }

// //
// if($student_id){
//     $this->db->where('E.student_id',$student_id);
// }

// $this->db->where('S.school_id', $school_id);

// $this->data['students']= $this->db->get()->result();
// $student_info=$this->data['students'];

//     if (!empty($this->data['students'])) {

//     $student_attendance=array();
//     $i=0;
//     foreach ($this->data['students'] as $obj) {
        
//     $condition['student_id'] = $obj->id;
//     $attendance = $this->student_att->get_single('student_attendances', $condition);
//     $this->data['day'] = date('d', strtotime($this->input->post('date')));
//     $this->data['month'] = date('m', strtotime($this->input->post('date')));
//     $this->data['year'] = date('Y', strtotime($this->input->post('date')));
    
//             if (empty($attendance)) {  
//                 $data['section_id'] = $obj->section_id;
//                 $data['student_id'] = $obj->id;
//                 $data['status'] = 1;
//                 $data['created_at'] = date('Y-m-d H:i:s');
//                 $data['created_by'] = logged_in_user_id();
//                 $this->student_att->insert('student_attendances', $data);
//             }

//     $attendance_data= get_student_attendance_subject($obj->id, $school_id, $school->academic_year_id, $class_id, $section_id, $this->data['year'], $this->data['month'], $this->data['day'],$subject_id );
//     $student_attendance[$i]=array(
//     'id'=>$obj->id,
//     'attendance'=>$attendance_data
// );
// $i++;
//         }
//     }

//     $this->data['academic_year_id'] = $school->academic_year_id;
//     $this->data['day'] = date('d', strtotime($this->input->post('date')));
//     $this->data['month'] = date('m', strtotime($this->input->post('date')));
//     $this->data['year'] = date('Y', strtotime($this->input->post('date')));
//     $this->data['school_id'] = $school_id;
//     $this->data['class_id'] = $class_id;
//     $this->data['section_id'] = $section_id;
//     $this->data['subject_id'] = $subject_id;
//     $this->data['date'] = $date;
//     $json_data=$data;
//     $json_data['students_detail']=$student_attendance;
         
//     return $this->output
//     ->set_content_type('application/json')
//     ->set_status_header(200)
//     ->set_output(json_encode($json_data));        
    

// }


?> 






