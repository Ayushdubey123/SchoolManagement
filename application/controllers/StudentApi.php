    
 <?php 
    // defined('BASEPATH') OR exit('No direct script access allowed');

     class StudentApi extends CI_Controller
    {   

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('report');
		$this->load->model('../modules/student/models/Student_Model', 'student', true);
          $this->load->model('../modules/attendance/models/Student_Model', 'student_att', true);
        $this->load->model('../modules/announcement/models/Notice_Model', 'notice', true);
          $this->load->model('../modules/accounting/models/Receipt_Model', 'receipt', true);
         $this->load->model('../modules/accounting/models/Payment_Model', 'payment', true); 
         $this->load->model('../modules/library/models/Book_Model', 'book', true);
          $this->load->model('../modules/gallery/models/Image_Model', 'image', true);
            $this->load->model('../modules/exam/models/Exam_Model', 'exam', true);
        $this->load->model('../modules/academic/models/Routine_Model', 'routine', true);
        $this->load->model('../modules/exam/models/Resultcard_Model', 'resultcard', true);
        $this->load->model('../modules/exam/models/Meritlist_Model', 'merit', true);
		$this->load->model('../modules/exam/models/Schedule_Model', 'schedule', true);
        // $this->load->model('../modules/gallery/models/Gallery_Model', 'notice', true);
        $this->load->model('../modules/gallery/models/Image_Model', 'image', true);
        $this->load->model('../modules/announcement/models/Notice_Model', 'notice', true);
        $this->load->model('../modules/complain/models/Complain_Model', 'complain', true);
        $this->load->model('../modules/leave/models/Application_Model', 'application', true);
        $this->load->model('../modules/announcement/models/Holiday_Model', 'holiday', true);
         $this->load->model('../modules/exam/models/Marksheet_Model', 'mark', true);
         $this->load->model('../modules/event/models/Event_Model', 'event', true);
         $this->load->model('../modules/report/models/Report_Model', 'report', true);
         $this->load->model('../modules/exam/models/Attendance_Model', 'attendance', true); 
        $this->load->model('Auth_Model', 'auth', true);        
    }

//1.Api For Student Login

public function student_login()
    {
         $result=array();
   try {

         $data['username'] = $this->input->post('username'); 
         $data['password'] = md5($this->input->post('password'));

            $login = $this->auth->get_single('users', $data);
            if (!empty($login)) {
            $student_data=$this->get_student_info($login->id);
              $result['status']=true;
              $result['message']="Login Successfully👩‍🎓👨‍🎓";
              $result['data']=array("Student_data"=>$student_data,
                "login_auth"=>$login);
              }
              else{
              $result['status']=false;
              $result['message']="Login Faileds👶";
              $result['data']=[];
              }
      } catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
      }
         echo json_encode($result);
            
    }

	

    public function get_student_info($id)
{ 
          $query_student="select *, students.id as student_id,
          students.email as student_email, students.name
           as student_name,students.admission_no as school_no,
           \teachers.name as teacher_name, classes.name as class_name,
           academic_years.session_year as academic_year, sections.name as section_name
             from students INNER JOIN enrollments ON students.id=enrollments.student_id
              INNER JOIN academic_years ON academic_years.id=enrollments.academic_year_id
               INNER JOIN classes ON classes.id=enrollments.class_id INNER JOIN teachers 
               ON teachers.id=classes.teacher_id INNER JOIN sections ON 
               sections.id=enrollments.section_id  where students.user_id=".$id;
           $student_data=$this->db->query($query_student)->result_array();
           return $student_data;
}
 	


//2.Api For Update Student
    public function update_student(){
        $school_id =$this->input->post('school_id');
        $student_id =$this->input->post('student_id');
        $user_id =$this->input->post('user_id');
        $email =$this->input->post('email');
        $present_address=$this->input->post('present_address');
        $data=array('email'=>$email,'present_address'=>$present_address);  
        $where=array('id'=>$student_id,'user_id'=>$user_id);
        $this->db->where($where);
        $this->db->update('students', $data);        
         return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));

    }


public function update_student_image(){

        $result=array();
        $school_id =$this->input->post('school_id');
        $student_id =$this->input->post('student_id');
        $user_id  =$this->input->post('user_id');
        // $photo['photo'] = $this->input->_upload_photo();
       if($school_id!=''&&$student_id!=''&&$user_id!=''&&$_FILES['photo']['name']!=''){
         if ($_FILES['photo']['name']) {
            $photo['photo'] = $this->_upload_photo();
        }
       
        $data=array('photo'=>$photo['photo']);  
       $where=array('id'=>$student_id,'user_id'=>$user_id);
        $this->db->where($where);
        $profile=$this->db->update('students', $data);  
        if ($profile) {
           $result['status']=true;
              $result['message']="Profile Image Update Successfully👍";
              $result['data']=$data;
              }

              else{
              $result['status']=false;
              $result['message']="Image Not Update🤷‍";
              $result['data']=[];
              }
        }else{
              $result['status']=false;
              $result['message']="Data Not Null🤦‍";
              $result['data']=[];

                }
    
              echo json_encode($result);
}


//Upload Image
 private function _upload_photo() {

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/student-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }
    



//3.Api For List  All Exam By School Id
    public function list_exam()
{

        $school_id = $this->input->post('school_id');
        $class_id  = $this->input->post('class_id');           

        $this->data['class_id'] = $class_id;
        $this->data['filter_class_id'] = $class_id;
        $this->data['filter_school_id'] = $school_id;       
        
        $school = $this->schedule->get_school_by_id($school_id);  
            
        $this->data['schedules'] = 
        $data_exam=$this->schedule->get_schedule_list_api($class_id,$school_id, 
            $school->academic_year_id);
        // $this->data['list'] = TRUE;
            if (!empty($data_exam)) {
           $result['status']=true;
              $result['message']="List Of Exam✍";
              $result['data']=$data_exam;
              }
              else{
              $result['status']=false;
              $result['message']="Data Not Found🥺";
              $result['data']=[];
              }

              echo json_encode($result);

}


//4.Api For List Exam Term

//     public function exam_term(){
//         $school = $this->exam->get_school_by_id($school_id);
        
//         $this->data['exams'] = $this->exam->get_exam_list($school_id, @$school->academic_year_id);
        
//         $this->data['filter_school_id'] = $school_id;        
//         $this->data['schools'] = $this->schools;
        
//            return $this->output
//             ->set_content_type('application/json')
//             ->set_status_header(200)
//             ->set_output(json_encode($this->data));

//  }

 //5. Api For Day Wise Time Table
    public function day_by_timetable(){

    $result=array();
    $school_id=$this->input->post('school_id');
     $class_id=$this->input->post('class_id');
     $section_id=$this->input->post('section_id');
    $day=$this->input->post('day');

        $routine="select *from routines INNER JOIN subjects ON subjects.id=routines.subject_id where routines.school_id='".$school_id."'and routines.class_id='".$class_id."'and routines.section_id='".$section_id."' and routines.day='".$day."'";
        $routine_data=$this->db->query($routine)->result_array();

           // return $this->output
           //  ->set_content_type('application/json')
           //  ->set_status_header(200)
           //  ->set_output(json_encode($routine_data));

            if (!empty($routine_data)) {
           $result['status']=true;
              $result['message']="Data Find Successfully👍";
              $result['data']=$routine_data;
              }
              else{
              $result['status']=false;
              $result['message']="Data Not Found🥺";
              $result['data']=[];
              }

              echo json_encode($result);

        }

//6. Api For List All Result
         public function result_card(){
        if ($_POST) {
           

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
        

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['class_id'] = $class_id;         
            $this->data['section_id'] = $section_id; 
            
            $school = $this->merit->get_school_by_id($school_id);

            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
                // redirect('exam/meritlist');
            }
            

            $this->data['class'] = $this->db->get_where('classes', array('id'=>$class_id))->row()->name;

            if($section_id){
                $this->data['section'] = $this->db->get_where('sections', array('id'=>$section_id))->row()->name;
            }
            
            $this->data['academic_year'] = $this->db->get_where('academic_years', array('id'=>$academic_year_id))->row()->session_year;
            $this->data['examresult'] = $this->merit->get_merit_list($school_id, $academic_year_id, $class_id, $section_id);

            $this->data['school'] = $this->merit->get_school_by_id($school_id);
            

        }

            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($this->data));

        
    }


//7. Api For Issued Book
    public function issue_book(){

        $school_id=$this->input->post('school_id');
        $user_id= $this->input->post('student_id');

        $query_student="select *, id as student_id from students where user_id=".$user_id;

        $student=$this->db->query($query_student)->result_array();
       
        $student_id=$student[0]['student_id']; 


        $issue_book="select * from book_issues INNER JOIN books ON books.id=book_issues.book_id INNER JOIN library_members ON library_members.id=book_issues.library_member_id  where book_issues.school_id='".$school_id."' and library_members.user_id=".$student_id;

           $my_book=$this->db->query($issue_book)->result_array();
           

            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($my_book));
         
    }  

//8. Api For School All Gallery Images By School_id
    public function get_school_gallery(){
        try{
            $school_id= $this->input->post('school_id');

            $school_gallery=$this->db->query("SELECT * from gallery_images WHERE school_id='".$school_id."'")->result_array();
         
             if (!empty($school_gallery)) {
              $result['status']=true;
              $result['message']="These Are School Gallery's🏤";
              $result['data']=$school_gallery;
              }else{
              $result['status']=false;
              $result['message']="Data Not Found🤷‍";
              $result['data']=[];
              } 

        }catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
            
        }
             echo json_encode($result);
    }

//9.Api For List Notice By School Id
    public function school_notice()
{
          $school_id =$this->input->post('school_id');
          $notice="select *from notices where school_id=".$school_id;
          $notice_data=$this->db->query($notice)->result_array();
           
           
             if (!empty($notice_data)) {
              $result['status']=true;
              $result['message']="Notice List 🎫";
              $result['data']=$notice_data;
              }else{
              $result['status']=false;
              $result['message']="Data Not Found🥺";
              $result['data']=[];
              } 

              echo json_encode($result);
  }
//10. Api For List Complain By Student Id
    public function list_complain_studentId()
{
             $result=array();

            $school_id =$this->input->post('school_id');
            $user_id =$this->input->post('student_id');
             $query_student="select *, id as student_id from students where user_id=".$user_id;
                $student_data=$this->db->query($query_student)->result_array();
                $student_id=$student_data[0]['student_id'];

          $complain="select *from complains where school_id='".$school_id."' and complains.user_id='".$user_id."'";
           $complain_data=$this->db->query($complain)->result_array();

           if (!empty($complain_data)) {
           $result['status']=true;
              $result['message']="Complain Find Successfully";
              $result['data']=$complain_data;
              }
              else{
              $result['status']=false;
              $result['message']="Data Not Found";
              $result['data']=[];
              }

              echo json_encode($result);
  }


//11.Api For Add Leave
      public function add_leave()
{
         $data = array();         
        $data['school_id'] = $this->input->post('school_id');
        $data['role_id'] = $this->input->post('role_id');
        $data['user_id'] = $this->input->post('user_id');
        $data['class_id'] = $this->input->post('class_id');
        $data['type_id'] = $this->input->post('type_id');
        $data['title'] = $this->input->post('title');
        $data['leave_reason'] = $this->input->post('leave_reason');

        
        $data['leave_date'] = date('Y-m-d', strtotime($this->input->post('leave_date')));
        $data['leave_from'] = date('Y-m-d', strtotime($this->input->post('leave_from')));
        $data['leave_to']   = date('Y-m-d', strtotime($this->input->post('leave_to')));
        
        $start = strtotime($data['leave_from']);
        $end   = strtotime($data['leave_to']);
        $days = ceil(abs($end - $start) / 86400);
        $data['leave_day'] = $days+1;
        
        if ($this->input->post('id')) {
            
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();            
            
        } else {
            
            $data['leave_status'] = 0;
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            
            $school = $this->application->get_school_by_id($data['school_id']);            
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
                
            }            
            $data['academic_year_id'] = $school->academic_year_id;
            
        }
        

        if (isset($_FILES['attachment']['name'])) {
            $data['attachment'] = $this->_upload_attachment();
        }
        
         $insert_record=$this->application->insert('leave_applications', $data);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data)); 

  }


public function _upload_attachment() {

        $prev_attachment = $this->input->post('prev_attachment');
        $attachment = $_FILES['attachment']['name'];
        $return_attachment = '';
        if ($attachment != "") {

                $destination = 'assets/uploads/leave/';

                $file_type = explode(".", $attachment);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $attachment_path = 'leave-attachment-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['attachment']['tmp_name'], $destination . $attachment_path);
                // need to unlink previous image
                if ($prev_attachment != "") {
                    if (file_exists($destination . $prev_attachment)) {
                        @unlink($destination . $prev_attachment);
                    }
                }

                $return_attachment = $attachment_path;
          
        } else {
            $return_attachment = $prev_attachment;
        }

        return $return_attachment;
    }


//12.Api For Leave Application By Student Id

    public function list_Leave_Appliacation_studentId()
{ 
            $school_id =$this->input->post('school_id');
            $user_id =$this->input->post('user_id');
          $leave="select *from leave_applications where school_id='".$school_id."' and leave_applications.user_id='".$user_id."'";
           $leave_data=$this->db->query($leave)->result_array();
           
           return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($leave_data));

  }


//13.Api For Student Attendance
    // public function student_attendance() {

    //       $result=array();
    //    try{
       
    //     if ($_POST) {
    //         $insert_record=false;
    //         $school_id  = $this->input->post('school_id');
    //         $class_id = $this->input->post('class_id');
    //         $section_id = $this->input->post('section_id');
    //         $date = $this->input->post('date');
    //         $students = $this->input->post('students');
    //         $subject_id= $this->input->post('subject_id');
    //         $month = date('m', strtotime($this->input->post('date')));
    //         $year = date('Y', strtotime($this->input->post('date')));
    //         $school = $this->student->get_school_by_id($school_id);        
    //         $condition = array(
    //             'school_id' => $school_id,
    //             'class_id' => $class_id,
    //             'academic_year_id' => $school->academic_year_id,
    //             'subject_id' => $subject_id,
    //             'month' => $month,
    //             'year' => $year
    //         );
            
    //         if($section_id){
    //             $condition['section_id'] = $section_id;
    //         }

    //         $data = $condition;
    //         // echo $students ;
    //         // echo date('d', strtotime($this->input->post('date'))) ;
            
    //             foreach (json_decode($students) as $obj) {
    //                 $condition['student_id'] = $obj->id;
    //                 $attendance = $this->student->get_single('student_attendances', $condition);
    //                 $data['student_id'] = $obj->id;
    //                     $data['status'] = $obj->status;
                          
    //                 if (empty($attendance)) {                          
    //                     $data['created_at'] = date('Y-m-d H:i:s');
    //                     $data['created_by'] = logged_in_user_id();
                        
    //                     $data["day_".abs(date('d', strtotime($this->input->post('date'))))] =$obj->attendance ;
                        
    //                     // print_r($data);die;
    //                  $insert_record=   $this->student->insert('student_attendances', $data);


    //                 }
    //                 else{
    //                  $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
    //                     $insert_record=$this->student->update('student_attendances', array($field => $obj->attendance , 'modified_at'=>date('Y-m-d H:i:s')), $data); 

    //                 }

    //         }

    //         $this->data['academic_year_id'] = $school->academic_year_id;
    //         $this->data['day'] = date('d', strtotime($this->input->post('date')));
    //         $this->data['month'] = date('m', strtotime($this->input->post('date')));
    //         $this->data['year'] = date('Y', strtotime($this->input->post('date')));
    //         $this->data['school_id'] = $school_id;
    //         $this->data['class_id'] = $class_id;
    //         $this->data['section_id'] = $section_id;
    //         $this->data['subject_id'] = $subject_id;
    //         $this->data['date'] = $date;
        
    //     if($insert_record){

    //           $result['status']=true;
    //           $result['message']='attendance Successfully';
    //           $result['data']=$students;    
            
    //     }else{

    //           $result['status']=false;
    //           $result['message']='attendance Unsuccessfully';
    //           $result['data']=$students;    
            
    //     }
    //         create_log('Has been process student attendance'); 


    //     }

        
    //    }catch(Exception $e){
    //           $result['status']=false;
    //           $result['message']=$e;
    //           $result['data']=[];
    //     }
    //      echo json_encode($result);

    // }

//14. Api For List Holiday By School Id
    public function holiday_by_school_id()
{
          $school_id =$this->input->post('school_id');
          
          $holiday="select *from holidays where school_id=".$school_id;
           $result=$this->db->query($holiday)->result_array();
           
           return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));

  }


//15. Api For Fees Recipt By Student Id
    public function fees_recipt(){
         
        // if ($_POST) {

         //    $school_id = $this->input->post('school_id'); 
         //    $class_id = $this->input->post('class_id'); 
         //    $section_id = $this->input->post('section_id'); 
         //    $student_id = $this->input->post('student_id');

         //    $school= $this->receipt->get_school_by_id($school_id);  
               
         //    $receipt= get_paid_receipt_list_api($school_id, $class_id, $section_id, $student_id, $this->data['school']->academic_year_id);
                 
         //    $this->data['school_id'] = $school_id;
         //    $this->data['class_id'] = $class_id;
         //    $this->data['section_id'] = $section_id;
         //    $this->data['student_id'] = $student_id;
        
         // }
         // return $this->output
         //    ->set_content_type('application/json')
         //    ->set_status_header(200)
         //    ->set_output(json_encode($this->data));
        $school_id=$this->input->post('school_id');
        $student_id=$this->input->post('student_id');

        $issue_book="select *from transactions INNER JOIN invoices ON invoices.id=transactions.invoice_id  where invoices.school_id='".$school_id."' and invoices.student_id=".$student_id;

           $my_book=$this->db->query($issue_book)->result_array();

         return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($my_book));

    }


 

// //16. Api For Add School Gallery By School ID
//     public function add_school_gallery(){

//         $data = array();
//         $data['school_id'] =$this->input->post('school_id');
//         $data['gallery_id'] =$this->input->post('gallery_id');
//         $data['caption'] =$this->input->post('caption');

//         if ($this->input->post('id')) {
//             $data['modified_at'] = date('Y-m-d H:i:s');
//             $data['modified_by'] = logged_in_user_id();
//         } else {
//             $data['status'] = 1;
//             $data['created_at'] = date('Y-m-d H:i:s');
//             $data['created_by'] = logged_in_user_id();
//         }

//         if (isset($_FILES['image']['name'])) {
//             $data['image'] = $this->_upload_image();
//         }

//         $insert_data = $this->image->insert('gallery_images', $data);
       
//          return $this->output
//             ->set_content_type('application/json')
//             ->set_status_header(200)
//             ->set_output(json_encode($data));

//         } 



// // Function For Gallery Upload Image
//     public function _upload_image() {

//         $prev_image = $this->input->post('prev_image');
//         $image = $_FILES['image']['name'];
//         $image_type = $_FILES['image']['type'];
//         $return_image = '';
//         if ($image != "") {
//             if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
//                     $image_type == 'image/jpg' || $image_type == 'image/png' ||
//                     $image_type == 'image/x-png' || $image_type == 'image/gif') {

//                 $destination = 'assets/uploads/gallery/';

//                 $file_type = explode(".", $image);
//                 $extension = strtolower($file_type[count($file_type) - 1]);
//                 $image_path = $this->input->post('gallery_id').'-image-' . time() . '-sms.' . $extension;

//                 move_uploaded_file($_FILES['image']['tmp_name'], $destination . $image_path);

//                 // need to unlink previous image
//                 if ($prev_image != "") {
//                     if (file_exists($destination . $prev_image)) {
//                         @unlink($destination . $prev_image);
//                     }
//                 }

//                 $return_image = $image_path;
//             }
//         } else {
//             $return_image = $prev_image;
//         }

//         return $return_image;
//     }

//17.Api For List Marksheet By Student Id
    public function marksheet_studentId(){
    $school_id = $this->input->post('school_id');
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    $student_id = $this->input->post('student_id');
                
    $std = $this->mark->get_single('students', array('id'=>$student_id));
    $student = get_user_by_role(STUDENT, $std->user_id);
           
    $exam_id = $this->input->post('exam_id');
    $exam = $this->mark->get_single('exams', array('id'=>$exam_id));
            
    $school = $this->mark->get_school_by_id($school_id);
            
    if(!$school->academic_year_id){
    error($this->lang->line('set_academic_year_for_school'));
                
    }

            $this->data['subjects'] = $this->mark->get_subject_list($school_id, $exam_id, $class_id, $section_id, $student_id, $school->academic_year_id);
            $this->data['grades'] = $this->mark->get_list('grades', array('status' => 1, 'school_id'=>$school_id), '', '', '', 'id', 'ASC');

            $this->data['school'] = $school;
            $this->data['exam'] = $exam;
            $this->data['student'] = $student;
            $this->data['school_id'] = $school_id;
            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['student_id'] = $student_id;
            $this->data['academic_year_id'] = $school->academic_year_id;
           

            $class = $this->mark->get_single('classes', array('id'=>$class_id));
            // create_log('Has been filter exam mark sheet for class: '. $class->name);
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($this->data));
            
    }

 

 public function attendance(){
    if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_id = $this->input->post('student_id');

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['student_id'] = $student_id;
            
            $this->data['school'] = $this->report->get_school_by_id($school_id);
        }

        $this->data['days'] = 31;

        print_r($this->data);
 }


public function exam_data(){
    $school_id = '';


        
        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            $school = $this->attendance->get_school_by_id($school_id);            
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
                // redirect('exam/attendance/index');
            }
            
            
            $this->data['students'] = $this->attendance->get_student_list($school_id, $exam_id, $class_id, $section_id, $subject_id, $school->academic_year_id);

                      
            $condition = array(
                'school_id' => $school_id,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'academic_year_id' => $school->academic_year_id,
                'subject_id' => $subject_id
            );
            
            if($section_id){
                $condition['section_id'] = $section_id;
            }

            $data = $condition;
            if (!empty($this->data['students'])) {

                foreach ($this->data['students'] as $obj) {

                    $condition['student_id'] = $obj->student_id;
                    $attendance = $this->attendance->get_single('exam_attendances', $condition);
                    
                    if (empty($attendance)) {
                        $data['section_id'] = $obj->section_id;
                        $data['student_id'] = $obj->student_id;
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['created_by'] = logged_in_user_id();
                        $this->attendance->insert('exam_attendances', $data);
                    }
                }
            }

            $this->data['school_id'] = $school_id;
            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['subject_id'] = $subject_id;
            $this->data['academic_year_id'] = $school->academic_year_id;
            
           $exam = $this->attendance->get_single('exams', array('id'=>$exam_id));
           $class = $this->attendance->get_single('classes', array('id'=>$class_id));
           $subject = $this->attendance->get_single('subjects', array('id'=>$subject_id));            
           create_log('Has been process exam attendance for : '.$exam->title. ', '. $class->name.', '. $subject->name);
        }
        
            print_r($subject);
            die();
              
}

// Api For Exam Attendance by student id
 public function demo_exam_attandence(){

            $school_id = $this->input->post('school_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');
            $student_id = $this->input->post('student_id');


             $query="select * from exam_attendances  where school_id='".$school_id."'  and exam_id='".$exam_id."' and class_id='".$class_id."' and  section_id='".$section_id."' and subject_id='".$subject_id."' and student_id='".$student_id."' and is_attend=1";
             $student_data=$this->db->query($query)->result_array();
           
                if (!empty($student_data)) {
              $result['status']=true;
              $result['message']="Data Find Successfully";
              $result['data']=$student_data;
              }else{
              $result['status']=false;
              $result['message']="Data Not Found";
              $result['data']=[];
              } 

              echo json_encode($result);


 }

 public function student_attendance_list_by_ID(){

    $result=array();

    $school_id=$this->input->post('school_id');
    $class_id=$this->input->post('class_id');
    $section_id=$this->input->post('section_id');
    $student_id=$this->input->post('student_id');
    $subject_id=$this->input->post('subject_id');
//  $students = $this->input->post('students');
    $academic_year_id = $this->input->post('academic_year_id');
    $date = $this->input->post('date');
    $month = $this->input->post('month');
    // $month = date('m', strtotime($this->input->post('date')));
    $year = date('Y', strtotime($this->input->post('date')));

    $student_attendance="select *, subjects.id as subject_id,subjects.name
     as subject_name from student_attendances INNER JOIN subjects ON subjects.id=student_attendances.subject_id where student_attendances.school_id='".$school_id."'  and student_attendances.class_id='".$class_id."' and student_attendances.section_id='".$section_id."' and student_attendances.month='".$month."' and 
         student_attendances.student_id=". $student_id;

    $result_data=$this->db->query($student_attendance)->result_array();

  if (!empty($result_data)) {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully👍";
                  $result['data']=$result_data;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found🥺";
                  $result['data']=[];
              }
              echo json_encode($result); 
  

 }


//Api for user Post
public function user_post(){
    $data=array();
    $result=array();
    $data['school_id']=$this->input->post('school_id');
    $data['academic_year_id']=$this->input->post('academic_year_id');
    $data['class_id']=$this->input->post('class_id');
    $data['section_id']=$this->input->post('section_id');
    $data['user_id']=$this->input->post('user_id');
    $data['media_type']=$this->input->post('media_type');
    $data['description']=$this->input->post('description');
    
    if($data['school_id']!='' && $data['academic_year_id']!='' && $data['class_id']!='' && $data['section_id']!='' && $data['user_id']!='' && $data['description']!=''){
        if ($_FILES['photo']['name']) {
            $data['media'] = $this->_upload_user_photo();
        }
           if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        $insert_record=$this->db->insert('user_post', $data);

        if (!empty($insert_record)) {
                  $result['status']=true;
                  $result['message']="Post Inserted Successfully👍";
                  $result['data']=$data ;
              }
              else{
                  $result['status']=false;
                  $result['message']="Post Not Inserted🥺";
                  $result['data']=[];
              }
               
              }
              else{
              $result['status']=false;
              $result['message']="Data Not Null🤦‍";
              $result['data']=[];

            }
             echo json_encode($result);
}

 private function _upload_user_photo() {        

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif' || $photo_type == 'video/mp4' || $photo_type == 'video/mov' || $photo_type == 'video/wmv' ) {

                $destination = 'assets/uploads/user_post/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }


//Api For List Post
    public function list_Allpost(){

    $result=array();
    // $school_id=$this->input->post('school_id');
    // $user_id=$this->input->post('user_id');
    // $Alldata=$this->db->query("SELECT *, students.id as studentId,enrollments.id as EnrollId FROM `enrollments` INNER JOIN students on enrollments.student_id=students.id where students.school_id='".$school_id."' and enrollments.class_id =(SELECT id FROM classes where teacher_id='".$teacher_id."' limit 1 )")-> result_array();
    
 // $post="select user_post.id, user_post.user_id,user_post.media,user_post.media_type,user_post.description,user_post.status, students.id as student_id,students.name,students.photo from user_post INNER JOIN users ON users.id=user_post.user_id INNER JOIN students ON users.id=students.user_id where user_post.status=1 ORDER BY user_post.id DESC";

      $post=$this->db->query("SELECT user_post.id, user_post.user_id, user_post.media,user_post.media_type,user_post.description,user_post.status, students.id as student_id,students.name,students.photo,post_like.id as likeid,post_like.media_id as like_media,post_like.post_like as postlike, post_like.user_id as like_userid from user_post INNER JOIN users ON users.id=user_post.user_id INNER JOIN students ON users.id=students.user_id INNER JOIN post_like ON user_post.id=post_like.media_id where  user_post.status=1 and post_like.post_like=(select COUNT(post_like) from post_like where post_like=0) ORDER BY user_post.id DESC")->result_array();

    $post_data=$this->db->query($post)->result_array();

    if(!empty($post_data)){
        $result['status']=true;
        $result['message']='Data Find Successfully👍';
        $result['data']=$post_data;
    }
    else{
        $result['status']=false;
        $result['message']='Data not Found🤷‍';
        $result['data']=[];
    }

    echo json_encode($result);

}




//Api For Delete Post

public function delete_post(){
    
    $result=array();
    $id=$this->input->post('id');
    $post="delete from user_post where id=".$id;
  
    $post_data=$this->db->query($post);

    if(!empty($post_data)){
        $result['status']=true;
        $result['message']='Data Delete Successfully👍';
        $result['data']=$post_data;
    }
    else{
        $result['status']=false;
        $result['message']='Data not Deleted🤷‍';
        $result['data']=[];
    }

    echo json_encode($result);
    
}

// Api For User Like
public function user_like(){
    $result=array();
    $data=array();
    $data['media_id']=$this->input->post('media_id');
    $data['post_like']=$this->input->post('post_like');
    $data['user_id']=$this->input->post('user_id');
    
    if($data['media_id']!='' && $data['post_like']!='' && $data['user_id']!=''){
    
          if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            // $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }
    $mylike=$this->db->insert('post_like',$data);
         if(!empty($mylike)){
        $result['status']=true;
        $result['message']='Like Inserted Successfully👍';
        $result['data']=$data;
        }
        else{
        $result['status']=false;
        $result['message']='Data not Inserted🤷‍';
        $result['data']=[];
        }
    }else{
        $result['status']=false;
        $result['message']='Data not Null🤷‍';
        $result['data']=[];
    }

    echo json_encode($result);

}
//Api For Count Like
public function total_like(){
     $result=array();
   
    $post_id=$this->input->post('post_id');
  if ($post_id!='') {
    $post="SELECT COUNT(post_like) FROM post_like where post_like=0 AND media_id=".$post_id;
    $count_data=$this->db->query($post)->result_array();
     if(!empty($count_data)){
        $result['status']=true;
        $result['message']='All Likes👍';
        $result['data']=$count_data;
        }
        else{
        $result['status']=false;
        $result['message']='Data not Inserted🤷‍';
        $result['data']=[];
        }
}
else{
    $result['status']=false;
        $result['message']='Data not Null🤷‍';
        $result['data']=[];
}    
echo json_encode($result);
}




public function user_comment(){
   
    $result=array();
    $data=array();
    $data['media_id']=$this->input->post('media_id');
    $data['comment']=$this->input->post('comment');
    $data['comment_parent_id']=$this->input->post('comment_parent_id');
    $data['user_id']=$this->input->post('user_id');


    if($data['media_id']!='' && $data['comment']!=''&& $data['comment_parent_id']!='' && $data['user_id']!=''){
    
           if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            // $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

    $mycomment=$this->db->insert('comment',$data);
         if(!empty($mycomment)){
        $result['status']=true;
        $result['message']='Comment Inserted Successfully👍';
        $result['data']=$data;
        }
        else{
        $result['status']=false;
        $result['message']='Data not Inserted🤷‍';
        $result['data']=[];
        }
    }else{
        $result['status']=false;
        $result['message']='Data not Null🤷‍';
        $result['data']=[];
    }

    echo json_encode($result);

}


// Api For List Comment Order By Desc

public function list_comment(){
      $result=array();
   
    $post_id=$this->input->post('post_id');
  if($post_id!=''){
    $post="select *,users.id as user_id from comment INNER JOIN users ON users.id=comment.user_id INNER JOIN user_post ON user_post.id=comment.media_id where user_post.status=1 and comment.media_id='".$post_id."' ORDER BY comment.id DESC";
    $post_data=$this->db->query($post)->result_array();

    if(!empty($post_data)){
        $result['status']=true;
        $result['message']='Comment List👍';
        $result['data']=$post_data;
    }
    else{
        $result['status']=false;
        $result['message']='Data not Found🤷‍';
        $result['data']=[];
    }
}else{
        $result['status']=false;
        $result['message']='Data not Null🤷‍';
        $result['data']=[];
}
    echo json_encode($result);
}






}

?> 
