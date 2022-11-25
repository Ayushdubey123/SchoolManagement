
 <?php 
    // defined('BASEPATH') OR exit('No direct script access allowed');

     class Teacher_Api extends CI_Controller
    {   
    function __construct() {
        parent::__construct();
    $this->load->database();
    $this->load->helper('report');

    $this->load->model('../modules/teacher/models/Teacher_Model', 'teacher', true);
    ////
    $this->load->model('../modules/student/models/Student_Model', 'student', true);
    $this->load->model('../modules/attendance/models/Student_Model', 'student_att', true);
    $this->load->model('../modules/exam/models/Attendance_Model', 'attendance', true); 
    ///
    $this->load->model('../modules/event/models/Event_Model','event',true);
    $this->load->model('../modules/library/models/Book_Model', 'book', true);
    $this->load->model('../modules/complain/models/Complain_Model','complain',true);
    $this->load->model('../modules/gallery/models/Image_Model', 'image', true);
    $this->load->model('../modules/announcement/models/Notice_Model','notice',true);
    

    //
    $this->load->model('../modules/report/models/Report_Model', 'report', true);
    $this->load->helper('report');
    $this->load->model('../modules/academic/models/Liveclass_Model', 'liveclass', true);
    $this->load->model('Auth_Model', 'auth', true);        

    }

   
/// Api For Teacher Login
    public function teacher_login_id()
    {
            $result=array();

    try {
            $data['username'] = $this->input->post('username');           
            $data['password'] = md5($this->input->post('password'));
            $login = $this->auth->get_single('users', $data);
            if (!empty($login)) {
            $teacher_data=$this->get_teacher_info($login->id);
              $result['status']=true;
              $result['message']="Login Successfully";
              $result['data']=array("teacher_data"=>$teacher_data,
                "login_auth"=>$login);

        }
    else{
              $result['status']=false;
              $result['message']="Login Faileds";
              $result['data']=[];
        }

        } catch (Exception $e) {
              $result['status']=false;
              $result['message']=$e;
              $result['data']=[];
            
        }
            echo json_encode($result);
            
    }


    //get student list by class teacher
    // SELECT *, students.id as studentId,enrollments.id as EnrollId FROM `enrollments` INNER JOIN students on enrollments.student_id=students.id where students.school_id="5" and class_id=(select id from classes where teacher_id="2")

public function get_teacher_info($id)
{
    // $query_teacher="select *, id as teacher_id from teachers  where user_id=".$id;
    $query_teacher="select *, teachers.id as teacher_id,academic_years.id as academic_year_id from teachers INNER JOIN academic_years ON academic_years.school_id=teachers.school_id  where user_id='".$id."' and academic_years.is_running=1";
    $teache_data=$this->db->query($query_teacher)->result_array();
    return $teache_data;

}

//1. Api For Find Student By School Or Teacher Id
        public function Find_Student_teacher_id()
    {

           $result=array();
        try {

                $school_id= $this->input->post('school_id');         
                $user_id= $this->input->post('teacher_id');
                $query_teacher="select *, id as teacher_id from teachers where user_id=".$user_id;
                $teache_data=$this->db->query($query_teacher)->result_array();
                $teacher_id=$teache_data[0]['teacher_id'];
             
                $Alldata=$this->db->query("SELECT *, students.id as studentId,students.name as
                 student_name, enrollments.id as EnrollId, classes.name as
                  class_name FROM `enrollments` INNER JOIN students on
                   enrollments.student_id=students.id INNER JOIN classes
                    ON enrollments.class_id=classes.id where 
                    students.school_id='".$school_id."' 
                    and enrollments.class_id =(SELECT id FROM classes where
                     teacher_id='".$teacher_id."' limit 1 )")-> result_array();

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
 
///2. Api For Get All Class  By Teacher Id
    public function get_all_stream()
        {   
            $result=array();
            // try{
         $school_id= $this->input->post('school_id');    
         $user_id= $this->input->post('user_id');
         $teacher_id= $this->input->post('teacher_id');
               
    //      $data=$this->db->query("SELECT  *,classes.name as class_name,classes.id as
    //     class_id,enrollments.academic_year_id as academic_year
    //      FROM `classes`
    //  INNER JOIN enrollments on enrollments.class_id=classes.id
    //        INNER JOIN  subjects ON classes.id=subjects.class_id where
    //         classes.teacher_id='".$teacher_id."' group by class_id")->result_array();
          
    $data=$this->db->query("SELECT  *,classes.name as class_name,classes.id as class_id
      FROM `classes`
     
      where
      classes.teacher_id='".$teacher_id."'group by classes.class_id")->result_array();
 

            if (!empty($data)) {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully";
                  $result['data']=$data;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found";
                  $result['data']=[];
              } 
         
        // }
        // catch (Exception $e) {
        //       $result['status']=false;
        //       $result['message']=$e;
        //       $result['data']=[];
            
        // }
            echo json_encode($result);
}


//3.Api for List All book By Stream Id
public function all_book_stream_id(){
    
    $school_id=$this->input->post('school_id');
    $class_id=$this->input->post('class_id');
    $query_book="select *,books.id as book_id from books where class_id= ".$class_id;
    $book_data=$this->db->query($query_book)->result_array();

     return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($book_data)); 
}

public function list_member(){
    $result=array();
     $school_id=$this->input->post('school_id');
      $user_id=$this->input->post('user_id');
     if($school_id!='' && $user_id!='')
     {
    $query_user="select *,users.id as userid, library_members.id as member_id from library_members INNER JOIN users ON users.id=library_members.user_id where  library_members.school_id='".$school_id."' and library_members.user_id=".$user_id;
    $member_data=$this->db->query($query_user)->result_array();

        if (!empty($member_data)) {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully";
                  $result['data']=$member_data;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found";
                  $result['data']=[];
              }
    }
    else{
                  $result['status']=false;
                  $result['message']="Data Not Null";
                  $result['data']=[];
    }            
        echo json_encode($result);
}   


//4.Assign Book
public function library_assign_book(){

        $data = array();
        $result = array();
        $data['school_id'] =$this->input->post('school_id');
       $data['teacher_id'] =$this->input->post('teacher_id');
        $data['library_member_id'] =$this->input->post('library_member_id');
        $data['book_id'] =$this->input->post('book_id');
        $data['class_id'] =$this->input->post('class_id');
        $data['due_date'] = date('Y-m-d', strtotime($this->input->post('due_date')));

        if($data['school_id']!='' && $data['teacher_id']!='' && $data['library_member_id']!='' && $data['book_id']!='' && $data['class_id']!='' && $data['due_date']!='')
        {
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            
            $school = $this->book->get_school_by_id($data['school_id']);
            
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
      
            }
        
            $data['academic_year_id'] = $school->academic_year_id;
        
            $data['is_returned'] = 0;
            $data['status'] = 1;
            $data['issue_date'] = date('Y-m-d');

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }
        $insert_data = $this->book->insert('book_issues', $data);

        if (!empty($insert_data)) {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully";
                  $result['data']=$data;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found";
                  $result['data']=[];
              }
          }else{
            $result['status']=false;
                  $result['message']="Data Not Null";
                  $result['data']=[];
          }

               echo json_encode($result);
}

public function library_student_list(){
  
    $result=array();
    $school_id= $this->input->post('school_id');
    $user_id= $this->input->post('teacher_id');
    if($user_id!='' && $school_id!=''){
    $query_teacher="select *, id as teacher_id from teachers where user_id=".$user_id;
    $teacher_data=$this->db->query($query_teacher)->result_array();
                $teacher_id=$teacher_data[0]['teacher_id'];
        $student_data="SELECT *,classes.name as class_name,books.title as book_name,book_issues.id as issueid, book_issues.due_date as duedate,book_issues.issue_date as issuedate from library_members INNER JOIN users ON users.id=library_members.user_id INNER JOIN book_issues ON book_issues.library_member_id=library_members.id INNER JOIN books ON books.id=book_issues.book_id INNER JOIN students ON students.user_id=users.id INNER JOIN enrollments ON students.id=enrollments.student_id INNER JOIN classes ON classes.id=enrollments.class_id where students.school_id='".$school_id."' and enrollments.class_id =(SELECT id FROM classes where teacher_id='".$teacher_id."' limit 1 )";

        // $student_data="SELECT * from book_issues INNER JOIN users ON users.id=library_members.user_id INNER JOIN book_issues ON book_issues.library_member_id=library_members.id INNER JOIN students ON students.user_id=users.id INNER JOIN enrollments ON students.id=enrollments.student_id INNER JOIN classes ON classes.id=enrollments.class_id where students.school_id='".$school_id."' and enrollments.class_id =(SELECT id FROM classes where teacher_id='".$teacher_id."' limit 1 )";


        $all_data=$this->db->query($student_data)->result_array();
         if (!empty($all_data)) {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully";
                  $result['data']=$all_data;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found";
                  $result['data']=[];
              }     
      }else{
                  $result['status']=false;
                  $result['message']="Data Not Null";
                  $result['data']=[];       
      }

              echo json_encode($result);
}

//Api For All record By CollectionId
public function all_record_by_collection(){

    $result=array();
    $school_id=$this->input->post('school_id');
    $teacher_id=$this->input->post('teacher_id');

    if($teacher_id!='' && $school_id!=''){

    $record="select *,book_issues.id as issue_id, books.id as bookid, books.title as book_name from book_issues INNER JOIN books ON books.id=book_issues.book_id where book_issues.school_id='".$school_id."' and book_issues.teacher_id='".$teacher_id."' ORDER BY book_issues.id DESC";
    $total_data=$this->db->query($record)->result_array();
        
         if (!empty($total_data)) {
                  $result['status']=true;
                  $result['message']=" Data Find Successfully";
                  $result['data']=$total_data;
              }else{
                  $result['status']=false;
                  $result['message']="Data Not Found";
                  $result['data']=[];
              } 
    }
        else{
                $result['status']=false;
                  $result['message']="Data Not Null";
                  $result['data']=[];
            }
            echo json_encode($result);
}

//Api for Update status
public function update_book_status(){
        $result=array();
        $school_id =$this->input->post('school_id');
        $issueid =$this->input->post('issueid');
        $return_date =$this->input->post('return_date');
        $library_member_id =$this->input->post('library_member_id');

        $is_returned =$this->input->post('is_returned');
        if($school_id!='' && $issueid!='' && $return_date!='' && $library_member_id!='' && $is_returned!='')
        {
        $data=array('return_date'=>$return_date,'is_returned'=>$is_returned);  
        $where=array('id'=>$issueid,'library_member_id'=>$library_member_id);
        $this->db->where($where);
        $status_update=$this->db->update('book_issues', $data); 

        if (!empty($status_update)) {
                  $result['status']=true;
                  $result['message']=" Status Updated Successfully";
                  $result['data']=$data;
              }else{
                  $result['status']=false;
                  $result['message']="Status Not Update";
                  $result['data']=[];
              }
          }else{
            $result['status']=false;
                  $result['message']="Data Not Null";
                  $result['data']=[];

          }
                echo json_encode($result);
          

}

//Api For Display Leave of Student by class-teacher Id
public function leave_list_application_by_teacherId(){
     $result=array();
    $school_id= $this->input->post('school_id');
    $user_id= $this->input->post('teacher_id');
    if($user_id!='' && $school_id!=''){
    $query_teacher="select *, id as teacher_id from teachers where user_id=".$user_id;
    $teacher_data=$this->db->query($query_teacher)->result_array();
    $teacher_id=$teacher_data[0]['teacher_id'];

    $leave_data="SELECT leave_applications.id as leaveid,
    users.id as userid,students.id as studentid,students.name
     as student_name,enrollments.id as enroll_id, classes.id
      as classid,classes.name as class_name,
      leave_applications.role_id,leave_applications.role_id,
      leave_applications.user_id,leave_applications.class_id,
      leave_applications.title,leave_applications.leave_from,
      leave_applications.leave_to,leave_applications.leave_day,
      leave_applications.leave_reason,leave_applications.leave_note,
      leave_applications.leave_date,leave_applications.leave_status,
      leave_applications.attachment,leave_applications.status   
       From leave_applications INNER JOIN users ON users.id=leave_applications.user_id
        INNER JOIN students ON students.user_id=users.id INNER JOIN enrollments
         ON students.id=enrollments.student_id INNER JOIN classes ON 
         classes.id=enrollments.class_id where
          students.school_id='".$school_id."' and enrollments.class_id
           =(SELECT id FROM classes where teacher_id='".$teacher_id."' limit 1 )";

     $all_data=$this->db->query($leave_data)->result_array();
     if($all_data)
        {
        $result['status']=true;
        $result['message']="Application Find Successfully";
        $result['data']=$all_data;
        }
        else
        {
        $result['status']=false;
        $result['message']="Application Not Found";
        $result['data']=[];
        }
    }
    else{
        $result['status']=false;
        $result['message']="Data Not Null";
        $result['data']=[];
        }
        echo json_encode($result);
}

//Api for Update Status
    public function update_leave_status()
    {
        $result=array();
        $school_id =$this->input->post('school_id');
        $leave_status  =$this->input->post('leave_status');
        $leaveid =$this->input->post('leaveid');
        $student_id =$this->input->post('student_id');
        $leave_note =$this->input->post('leave_note');
        
        if($school_id!='' && $leave_note!='' && $student_id!='' && $leave_note!='' && $leaveid!='   ')
        {
              
            $data=array('leave_note'=>$leave_note,'leave_status'=>$leave_status);  
            $where=array('id'=>$leaveid,'user_id'=>$student_id);
            $this->db->where($where);
            $status_update=$this->db->update('leave_applications', $data);
            if($status_update)
            {
            $result['status']=true;
            $result['message']="Status Update Successfully";
            $result['data']=$data;
            }
            else
            {
            $result['status']=false;
            $result['message']="Status Not Updated";
            $result['data']=[];
                }
        }else
        {
        $result['status']=false;
        $result['message']="Date Not Null";
        $result['data']=[];
        }
        echo json_encode($result);

    }

//Ye status wala hai ismai dought hai to comment mai hai

// public function status_not_null(){

//      $result=array();
//     $school_id= $this->input->post('school_id');
//     $user_id= $this->input->post('teacher_id');
//     if($user_id!='' && $school_id!=''){
//     $query_teacher="select *, id as teacher_id from teachers where user_id=".$user_id;
//     $teacher_data=$this->db->query($query_teacher)->result_array();
//     $teacher_id=$teacher_data[0]['teacher_id'];

//     $status="SELECT * FROM leave_applications INNER JOIN clesses ON classes.id=leave_applications.class_id"

// }




// Api For Add PTM
public function insert_ptm(){

        $result=array();
        $data = array();
        $data['school_id'] =$this->input->post('school_id');
        $data['class_id'] =$this->input->post('class_id');
        $data['teacher_id'] =$this->input->post('teacher_id');
        $data['title'] =$this->input->post('title');
        $data['student_id'] =$this->input->post('student_id');        
        $data['ptm_date'] =$this->input->post('ptm_date');
        $data['ptm_time'] =$this->input->post('ptm_time');
        $data['end_time'] =$this->input->post('end_time');
        $data['mode'] =$this->input->post('mode');
        
    
    if($data['school_id']!='' && $data['class_id']!='' && $data['teacher_id']!='' && $data['title']!='' && $data['ptm_date']!='' && $data['ptm_time']!='' && $data['title']!='' && $data['end_time']!='' && $data['mode']!='')
    {
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            
            $school = $this->book->get_school_by_id($data['school_id']);
            
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
      
            }
        
            $data['academic_year_id'] = $school->academic_year_id;
        
            // $data['is_returned'] = 0;
            // $data['status'] = 1;
            // $data['issue_date'] = date('Y-m-d');

            $data['created_date'] = date('Y-m-d H:i:s');
            // $data['created_by'] = logged_in_user_id();
        }
        $insert_data = $this->db->insert('ptm', $data);

       if (!empty($insert_data)) {
                  $result['status']=true;
                  $result['message']=" Meeting Created Successfully";
                  $result['data']=$data;
              }else{
                  $result['status']=false;
                  $result['message']="Meeting Not Created";
                  $result['data']=[];
              }
    }
      else{
                $result['status']=false;
                  $result['message']="Data Not Null";
                  $result['data']=[];
      }         
               echo json_encode($result);
}

// Api for Make History which match by date
public function ptm_history(){  

      $result=array();
      $school_id=$this->input->post('school_id');
      $ptm_date=$this->input->post('ptm_date');
       $t = $this->input->date('d-M-y');
        // list($day,$month,$year) = explode("-",$t);
        // $dm = $day.'-'.$month;
      $my_result="SELECT * FROM ptm WHERE ptm.ptm_date=".$t;
      print_r($my_result);
      die;
      $ptm_data=$this->db->query($my_result)->result_array();

             if (!empty($ptm_data)) {
                  $result['status']=true;   
                  $result['message']="Meeting Find Successfully";
                  $result['data']=$ptm_data;
              }else{
                  $result['status']=false;
                  $result['message']="Meeting Not Found";
                  $result['data']=[];
              }
    // }
    // else{
    //     $result['status']=false;
    //     $result['message']="Data Not Null";
    //     $result['data']=[];
    // }

    echo json_encode($result);
}


//API for Ptm Upcoming Date
// public function upcoming_by_date(){

//     $result=array();
//      $school_id = $this->input->post('school_id');   
//      $date = $this->input->post('date');
//      $up_date="SELECT * FROM ptm WHERE ptm.school_id='".$school_id."' and ptm.ptm_date=".$date;
//      $data=$this->db->query($up_date)->result_array();

// SELECT * 
//  FROM abc WHERE datetime BETWEEN 
//         $P{fromdate} AND $P{todate}

//              if (!empty($data)) {
//                   $result['status']=true;
//                   $result['message']="Meeting Find Successfully";
//                   $result['data']=$data;
//               }else{
//                   $result['status']=false;
//                   $result['message']="Meeting Not Found";
//                   $result['data']=[];
//               }
     
//         echo json_encode($result);
// }

//Api Student Attandence
public function student_attendance() {
  
    $result=array();
 try{   
 
  if ($_POST) {
      $insert_record=false;
      $school_id  = $this->input->post('school_id');
      $class_id = $this->input->post('class_id');
      $section_id = $this->input->post('section_id');
      $date = $this->input->post('date');
      $students = $this->input->post('students');
      $subject_id= $this->input->post('subject_id');
      $month = date('m', strtotime($this->input->post('date')));
      $year = date('Y', strtotime($this->input->post('date')));
      $school = $this->student->get_school_by_id($school_id);

      $condition = array(
          'school_id' => $school_id,
          'class_id' => $class_id, 
          'academic_year_id' => $school->academic_year_id,
          'subject_id' => $subject_id,
          'month' => $month,
          'year' => $year
      );
      
      if($section_id){
          $condition['section_id'] = $section_id;
      }

      $data = $condition;

          foreach (json_decode($students) as $obj) {
              $condition['student_id'] = $obj->id;
              $attendance = $this->student->get_single('student_attendances', $condition);
              $data['student_id'] = $obj->id;
                  $data['status'] = $obj->status;
                    
              if (empty($attendance)) {                          
                  $data['created_at'] = date('Y-m-d H:i:s');
                  $data['created_by'] = logged_in_user_id();
                  
                  $data["day_".abs(date('d', strtotime($this->input->post('date'))))] =$obj->attendance ;

               $insert_record=   $this->student->insert('student_attendances', $data);
              }
              else{
               $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
                  $insert_record=$this->student->update('student_attendances', array($field => $obj->attendance , 'modified_at'=>date('Y-m-d H:i:s')), $data); 
              }

      }

      $this->data['academic_year_id'] = $school->academic_year_id;
      $this->data['day'] = date('d', strtotime($this->input->post('date')));
      $this->data['month'] = date('m', strtotime($this->input->post('date')));
      $this->data['year'] = date('Y', strtotime($this->input->post('date')));
      $this->data['school_id'] = $school_id;
      $this->data['class_id'] = $class_id;
      $this->data['section_id'] = $section_id;
      $this->data['subject_id'] = $subject_id;
      $this->data['date'] = $date;
  
  if($insert_record){

        $result['status']=true;
        $result['message']='attendance Successfully';
        $result['data']=$students;    
      
  }else{

        $result['status']=false;
        $result['message']='attendance Unsuccessfully';
        $result['data']=$students;    
      
  }
      create_log('Has been process student xattendance'); 
  }
  
 }catch(Exception $e){
        $result['status']=false;
        $result['message']=$e;
        $result['data']=[];
  }
   echo json_encode($result);

}


//Api Add Event
public function teacher_event_add() {
        $result=array();
        $data['school_id'] = $this->input->post('school_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        // $data['role_id'] = $this->input->post('role_id');
        $data['title'] = $this->input->post('title');
        // $data['event_place'] =$this->input->post('event_place');
        $data['note'] = $this->input->post('description');
        $data['event_from'] = date('Y-m-d', strtotime($this->input->post('event_from')));
        $data['event_to'] = date('Y-m-d', strtotime($this->input->post('event_to')));
        if($data['school_id']!='' && $data['teacher_id']!='' && $data['title']!='' && $data['note']!='' && $data['event_from']!='' && $data['event_to']!='')
        {
            if ($this->input->post('id')) {
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = logged_in_user_id();
            } else {
                $data['status'] = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();
            }

        if (isset($_FILES['image']['name'])) {
            $data['image'] = $this->_upload_event_image();
        }

             $insert_record=$this->event->insert('events', $data);
             
             if (!empty($insert_record)) {
                $result['status']=true;
                $result['message']="Data Inserted Successfully👍";
                $result['data']=$data ;
            }
            else{
                $result['status']=false;
                $result['message']="Data Not Inserted🥺";
                $result['data']=[];
            }       
        }else{
                $result['status']=false;
                $result['message']="Data Not Null🥺";
                $result['data']=[];
        }   
        echo json_encode($result);
    }



private function _upload_event_image() {
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


public function complain_by_teacher(){

        $result=array();
        $data = array();
        $data['school_id'] =$this->input->post('school_id');
        // Add Teacher Id External(sir);
        $data['teacher_id'] = $this->input->post('teacher_id');
        // $data['role_id'] = $this->input->post('role_id');
        $data['class_id'] = $this->input->post('class_id');
        $data['user_id'] = $this->input->post('student_id');
        // $data['type_id'] = $this->input->post('type_id');
        $data['title'] = $this->input->post('title');
        //$data['student_id'] = $this->input->post('student_id');
        $data['description'] = $this->input->post('description');
        // $data['action_note'] = $this->input->post('action_note');
        $data['complain_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('complain_date')));

        if ($this->input->post('id')) {
            
            $data['action_date'] = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            
        } else {
            
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            
            $school = $this->complain->get_school_by_id($data['school_id']);
           
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
               
            }            
            $data['academic_year_id'] = $school->academic_year_id;
        }   

         $insert_id = $this->complain->insert('complains', $data);

         if($insert_id){
            $result['status']=true;
            $result['message']="Complain inserted Successfully";
            $result['data']=$data;
         }
         else{
            $result['status']=false;
            $result['message']="Complain Not Inserted";
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

            $section_data=$this->db->query("SELECT sections.name as section_name,sections.id as section_id from `sections`
             where class_id='".$class_id."' and teacher_id='".$teacher_id."' ")->result_array();

         
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


//16. Api For Add School Gallery By School ID
    public function add_school_gallery(){
        $result=array();
        $data = array();
        $data['school_id'] =$this->input->post('school_id');
        $data['title'] =$this->input->post('title');
        $data['gallery_id'] =$this->input->post('gallery_id');
        $data['caption'] =$this->input->post('caption');
        if($data['school_id']=='')
      {      
          echo"School Id Not Be Null";      
      }elseif ($data['title']=='') {
          echo"Title Not Be Null";
      }elseif ($data['caption']=='') {
          echo"Caption Not Be Null";
      }elseif ($_FILES['image']['name']=='') {
          echo"Image Not Be Null";
      }

      else{
       if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        if (isset($_FILES['image']['name'])) {
            $data['image'] = $this->_upload_school_image();
        }

        $insert_data = $this->image->insert('gallery_images', $data);
       
         // return $this->output
         //    ->set_content_type('application/json')
         //    ->set_status_header(200)
         //    ->set_output(json_encode($data));
        if($insert_data){
            $result['status']=true;
            $result['message']="Data inserted Successfully";
            $result['data']=$data;
         }
         else{
            $result['status']=false;
            $result['message']="Data Not Inserted";
            $result['data']=[];
         }
     

         echo json_encode($result);
      }

        } 

/// Api For Find Student By School Or Teacher Id
        public function Find_Student_By_class_section()
    {

           $result=array();
        try {

                $school_id= $this->input->post('school_id');         
                $class_id= $this->input->post('class_id');         
                $section_id= $this->input->post('section_id');
            
                $AllStudent=$this->db->query("SELECT *, students.id as studentId,enrollments.id as EnrollId FROM `enrollments` INNER JOIN students on enrollments.student_id=students.id where enrollments.school_id='".$school_id."'and enrollments.class_id='".$class_id."' and enrollments.section_id ='".$section_id."'")-> result_array();

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
        $record=$this->db->query("SELECT *,classes.name as class_name,
        subjects.id as subject_id FROM `classes`  INNER JOIN subjects 
        ON classes.id=subjects.class_id   WHERE subjects.class_id='".$class_id."'
         and subjects.teacher_id='".$teacher_id."'")->result_array();

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


// Api For School All Gallery Images By School_id
    public function list_school_gallery(){
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



// Function For Gallery Upload Image
    public function _upload_school_image() {

        $prev_image = $this->input->post('prev_image');
        $image = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $return_image = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                $destination = 'assets/uploads/gallery/';

                $file_type = explode(".", $image);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $image_path = $this->input->post('gallery_id').'-image-' . time() . '-sms.' . $extension;

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


 //2.Api For chanege password
    public function change_password(){
    
        $result=array();
        $school_id =$this->input->post('school_id');
        $role_id =$this->input->post('role_id');
        $user_id =$this->input->post('user_id');
        $old_password =md5($this->input->post('old_password'));
        $new_password=md5($this->input->post('new_password'));
        $query="select * from users where id=".$user_id;
        $data=$this->db->query($query)->result_array();
    if($data[0]['password']==$old_password){
           
        $update_data=array('password'=>$new_password);  
        $where=array('id'=>$user_id,'role_id'=>$role_id);
        $this->db->where($where);
        $this->db->update('users', $update_data);        
         if ($update_data) {
           $result['status']=true;
           $result['message']="Change Password Successfully👍";
           $result['data']=$update_data;
           }
           else{
           $result['status']=false;
           $result['message']="Password Not Change🤷‍";
           $result['data']=[];
           }

        }else{
           
            $result['status']=false;
            $result['message']="Old Password Not Match 🤷‍";
            $result['data']=[];
        }
 
    
    echo json_encode($result);
    }


    // Api For Add Notice
    public function add_notice(){
        // $items = array();
        $data['school_id'] = $this->input->post('school_id');
        $data['role_id'] = $this->input->post('role_id');
        $data['title'] = $this->input->post('title');
        $data['notice'] = $this->input->post('notice');
        
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        
        // $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }
        if (isset($_FILES['image']['name'])) {
            $data['image'] = $this->_upload_notice_image();
        }

        // if($_FILES['image']['name']!=''){
        //     $notice_insert=$this->notice->insert('notices',$data);
        // }
        $notice_insert=$this->notice->insert('notices',$data);

           return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));  

    }


    private function _upload_notice_image() {
        $prev_image = $this->input->post('prev_image');
        $image = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $return_image = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                $destination = 'assets/uploads/notice/';

                $file_type = explode(".", $image);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $image_path = 'notice-' . time() . '-sms.' . $extension;

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


    //Api For Add Complain
    public function complain() {
        // $items = array();
        $data['school_id'] = $this->input->post('school_id');
        $data['role_id'] = $this->input->post('role_id');
        $data['class_id'] = $this->input->post('class_id');
        $data['user_id'] = $this->input->post('user_id');
        // $data['type_id'] = $this->input->post('type_id');
        $data['description'] = $this->input->post('description');
        // $data['action_note'] = $this->input->post('action_note');   
        $data['complain_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('complain_date')));
   
        if ($this->input->post('id')) {       
            $data['action_date'] = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();  
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $school = $this->complain->get_school_by_id($data['school_id']);        
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
            }            
            $data['academic_year_id'] = $school->academic_year_id;
            $insert_record=$this->complain->insert('complains', $data);
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));        
        }
        // echo json_encode($data);
    }


    //Api For Student History
    public function student_history(){
        $school_id = $this->input->post('school_id');
        $class_id = $this->input->post('class_id');
        $status_type = $this->input->post('status_type');
        $section_id = $this->input->post('section_id');
        $subject_id = $this->input->post('subject_id');
        $student_id = $this->input->post('student_id');
        $date = $this->input->post('date');
        // $student_id = $this->input->post('student_id');
        $month = date('m', strtotime($this->input->post('date')));
        $year = date('Y', strtotime($this->input->post('date')));
        $school = $this->student_att->get_school_by_id($school_id);
        $end_date = $this->input->post('end_date');


        $condition = array(
            'school_id' => $school_id,
            'class_id' => $class_id,
            'academic_year_id' => $school->academic_year_id,
            'month' => $month,
            'year' => $year,
            'student_id' => $student_id
        );
        
        if($section_id){
            $condition['section_id'] = $section_id;
            $condition['subject_id'] = $subject_id;
        }

        $data = $condition;
        
        $this->db->select('S.*, E.roll_no, E.class_id, E.section_id, U.username, U.role_id,  C.name AS class_name, SE.name AS section');
        $this->db->from('enrollments AS E');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
        $this->db->where('E.academic_year_id', $school->academic_year_id);       
        $this->db->where('E.class_id', $class_id);
    
    if($section_id){
        $this->db->where('E.section_id', $section_id);
    }
    if($status_type){
        $this->db->where('S.status_type', 'regular');
    }

    // //
    // if($student_id){
    //     $this->db->where('E.student_id',$student_id);
    // }
  
    $this->db->where('S.school_id', $school_id);
   
    $this->data['students']= $this->db->get()->result();
    $student_info=$this->data['students'];

        if (!empty($this->data['students'])) {

        $student_attendance=array();
        $i=0;
        foreach ($this->data['students'] as $obj) {
        $condition['student_id'] = $obj->id;
        $attendance = $this->student_att->get_single('student_attendances', $condition);
        $this->data['day'] = date('d', strtotime($this->input->post('date')));
        $this->data['month'] = date('m', strtotime($this->input->post('date')));
        $this->data['year'] = date('Y', strtotime($this->input->post('date')));
        
                if (empty($attendance))
                {  
                    $data['section_id'] = $obj->section_id;
                    $data['student_id'] = $obj->id;
                    $data['status'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $this->student_att->insert('student_attendances', $data);
                }

        $attendance_data= get_student_attendance_subject($obj->id, $school_id, $school->academic_year_id, $class_id, $section_id, $this->data['year'], $this->data['month'], $this->data['day'],$subject_id );
        $student_attendance[$i]=array(
        'id'=>$obj->id,
        'attendance'=>$attendance_data
    );
    $i++;
            }
        }

        $this->data['academic_year_id'] = $school->academic_year_id;
        $this->data['day'] = date('d', strtotime($this->input->post('date')));
        $this->data['month'] = date('m', strtotime($this->input->post('date')));
        $this->data['year'] = date('Y', strtotime($this->input->post('date')));
        $this->data['school_id'] = $school_id;
        $this->data['class_id'] = $class_id;
        $this->data['section_id'] = $section_id;
        $this->data['subject_id'] = $subject_id;
        $this->data['date'] = $date;
        $json_data=$data;
        $json_data['students_detail']=$student_attendance;
             
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($json_data));        
        

}


    //Api for Update School Gallery
    public function update_school_gellery()
    {
        $result=array();
        $school_id =$this->input->post('school_id');
        $leave_status  =$this->input->post('leave_status');
        $leaveid =$this->input->post('leaveid');
        $student_id =$this->input->post('student_id');
        $leave_note =$this->input->post('leave_note');
        
        if($school_id!='' && $leave_note!='' && $student_id!='' && $leave_note!='' && $leaveid!='   ')
        {
              
            $data=array('leave_note'=>$leave_note,'leave_status'=>$leave_status);  
            $where=array('id'=>$leaveid,'user_id'=>$student_id);
            $this->db->where($where);
            $status_update=$this->db->update('leave_applications', $data);
            if($status_update)
            {
            $result['status']=true;
            $result['message']="Status Update Successfully";
            $result['data']=$data;
            }
            else
            {
            $result['status']=false;
            $result['message']="Status Not Updated";
            $result['data']=[];
                }
        }else
        {
        $result['status']=false;
        $result['message']="Date Not Null";
        $result['data']=[];
        }
        echo json_encode($result);

    }

    //Api For Update Student Deatils    
        public function update_student_details(){
        $result=array();
        $school_id =$this->input->post('school_id');
        $student_id =$this->input->post('student_id');
        $user_id  =$this->input->post('user_id');
        $name =$this->input->post('name');
        $phone=$this->input->post('phone');
        $email =$this->input->post('email');
        $gender=$this->input->post('gender');
        $dob=$this->input->post('dob');
        // $dob= date('Y-m-d H:i:s', strtotime($this->input->post('dob')));
        $aadharcard_no=$this->input->post('aadharcard_no');
        $father_name =$this->input->post('father_name');
        $father_phone=$this->input->post('father_phone');
        $father_email=$this->input->post('father_email');
        $mother_name =$this->input->post('mother_name');
        $mother_phone=$this->input->post('mother_phone');
        $mother_email=$this->input->post('mother_email');
        $permanent_address=$this->input->post('permanent_address');
        // $photo['photo'] = $this->input->_upload_photo();
    //  if($school_id!=''&&$student_id!=''&&$user_id!=''&&$_FILES['photo']['name']!=''){
        if ($_FILES['photo']['name']) {
            $photo['photo'] = $this->_upload_photo();
        }
        if($_FILES['photo']['name']!=''){

        $data=array('name'=>$name,'phone'=>$phone,'email'
        =>$email,'gender'=>$gender,'dob'=>
        $dob,'aadharcard_no'=>$aadharcard_no,'father_name'=>$father_name,'father_phone'=>$father_phone,
        'mother_name'=>$mother_name,'mother_phone'=>$mother_phone,
        'permanent_address'=>$permanent_address,'photo'=>$photo['photo']);  
        $where=array('id'=>$student_id,'user_id'=>$user_id);
        $this->db->where($where);
        $profile=$this->db->update('students', $data);  
        if ($profile) {
           $result['status']=true;
              $result['message']="Data Update Successfully👍";
              $result['data']=$data;
              }
              else{
              $result['status']=false;
              $result['message']="Data Not Update🤷‍";
              $result['data']=[];
              }

         }else{
                
        $data=array('name'=>$name,'phone'=>$phone,'email'
        =>$email,'gender'=>$gender,'dob'=>
        $dob,'aadharcard_no'=>$aadharcard_no,'father_name'=>$father_name,'father_phone'=>$father_phone,
        'mother_name'=>$mother_name,'mother_phone'=>$mother_phone,
        'permanent_address'=>$permanent_address);  
        $where=array('id'=>$student_id,'user_id'=>$user_id);

        $this->db->where($where);
        $profile=$this->db->update('students', $data);  

        if ($profile) {
           $result['status']=true;
              $result['message']="Data Update Successfully👍";
              $result['data']=$data;
              }
              else{
              $result['status']=false;
              $result['message']="Data Not Update🤷‍";
              $result['data']=[];
              }   
         }
        // }else{
        //       $result['status']=false;
        //       $result['message']="Data Not Null🤦‍";
        //       $result['data']=[];
        //         }
              echo json_encode($result);
}

//Api For List Notice 
public function list_notice()
{
    $school_id =$this->input->post('school_id');
    if($school_id!=''){
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
        }else{
          $result['status']=false;
          $result['message']="Some Error Occure 🥺";
          $result['data']=[];
        }
          echo json_encode($result);
}


//Api For List Complain By User Id
    public function teacher_complain()
    {
        $school_id =$this->input->post('school_id');
        $teacher_id =$this->input->post('teacher_id');
        if($school_id!='' && $teacher_id!='')
        {
        $complain="select students.name  as student_name,classes.name  as class_name,complains.id as complains_id,complains.school_id,complains.academic_year_id,complains.teacher_id,complains.user_id,complains.class_id,complains.title,complains.description,complains.action_note,complains.complain_date,complains.action_date,complains.created_at from complains INNER JOIN users ON users.id=complains.user_id INNER JOIN students ON students.id=complains.user_id INNER JOIN  classes ON classes.id=complains.class_id where complains.school_id='".$school_id."' and complains.teacher_id=".$teacher_id ;
        $complain_data=$this->db->query($complain)->result_array();
           
             if (!empty($complain_data)) {
              $result['status']=true;
              $result['message']="Complain List 🎫";
              $result['data']=$complain_data;
              }else{
              $result['status']=false;
              $result['message']="Data Not Found🥺";
              $result['data']=[];
              } 
        }else{
              $result['status']=false;
              $result['message']="You Have Provide Invalid credentials 🥺";
              $result['data']=[];
        }
              echo json_encode($result);
  }


//Upload Image
    private function _upload_photo() 
    {

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


 
  //Api For List Event
  public function event_by_teacher()
     {
      $school_id =$this->input->post('school_id');
      $teacher_id =$this->input->post('teacher_id');
      $event="select *from events where school_id='".$school_id."'and teacher_id=".$teacher_id;
      $event_data=$this->db->query($event)->result_array();
        
           if (!empty($event_data)) {
            $result['status']=true;
            $result['message']="Event List 🎫";
            $result['data']=$event_data;
            }else{
            $result['status']=false;
            $result['message']="Data Not Found🥺";
            $result['data']=[];
            } 

            echo json_encode($result);
    }

    
//Api For Fees By Student Id
  public function fees_by_studentId()
  {
   $school_id =$this->input->post('school_id');
   $student_id =$this->input->post('student_id');
   if($school_id!='' && $student_id!='')
   {
   $event="select *from invoices where school_id='".$school_id."'and student_id=".$student_id;
   $event_data=$this->db->query($event)->result_array();
     
        if (!empty($event_data)) {
         $result['status']=true;
         $result['message']="Student Fees List 🎫";
         $result['data']=$event_data;
         }else{
         $result['status']=false;
         $result['message']="Data Not Found🥺";
         $result['data']=[];
         } 
    }else{
        $result['status']=false;
         $result['message']="You Have Provide Invalid credentials 🥺";
         $result['data']=[];
    }
         echo json_encode($result);
 }


 //Api For Time Table By Teacher Id 
    public function timetable()
       {
            $school_id =$this->input->post('school_id');
            $teacher_id =$this->input->post('teacher_id');
            $day =$this->input->post('day');
        
            if($school_id!='' && $teacher_id!='' && $day!='')
            {
            $event="select routines.class_id,routines.section_id,routines.subject_id,classes.name as class_name,sections.name as section_name,
            subjects.name as subject_name,routines.school_id,routines.mode,routines.academic_year_id,
            routines.day,routines.start_time,routines.end_time,
            routines.room_no,routines.created_at  from routines INNER JOIN
            classes ON classes.id=routines.class_id INNER JOIN
            sections ON  sections.id=routines.section_id INNER JOIN
            subjects ON subjects.id=routines.subject_id
            where routines.school_id='".$school_id."'and 
            routines.teacher_id='".$teacher_id."' and routines.day='".$day."'";
        
            $event_data=$this->db->query($event)->result_array();
          
                if (!empty($event_data)) {
                $result['status']=true;
                $result['message']="Time Table  List 🎫";
                $result['data']=$event_data;
                }else{
                $result['status']=false;
                $result['message']="Time Table Not Found🥺";
                $result['data']=[];
                } 
            }else{
                $result['status']=false;
                $result['message']="You Have Provide Invalid credentials 🥺";
                $result['data']=[];
            }
              echo json_encode($result);
      }
     

// Api For Teacher Attendance Pending
    public function teacher_attendance()
    {

    // $status = $this->input->post('status');
    $condition['school_id'] = $this->input->post('school_id');      
    $condition['teacher_id'] = $this->input->post('teacher_id');      
    $condition['month'] = date('m', strtotime($this->input->post('date')));
    $condition['year'] = date('Y', strtotime($this->input->post('date')));
    $school = $this->teacher->get_school_by_id($condition['school_id']); 
  
      
     if(!$school->academic_year_id){
       echo 'ay';
       die();
        }
    $condition['academic_year_id'] = $school->academic_year_id;

    

    $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
        if ($this->teacher->update('teacher_attendances', array('modified_at'=>date('Y-m-d H:i:s')), $condition)) {
            $result['status']=true;
            $result['message']="attendances🎫";
            
        } else {
            $result['status']=false;
            $result['message']="No attendances🎫";
            }
    }


//Api For Teacher Create Lacture
    public function teacher_create_lecture() 
    {   
        $result = array();
       
        $data['school_id'] =$this->input->post('school_id');
        $data['class_id'] =$this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['class_type'] = $this->input->post('class_type');
        $data['start_time'] = $this->input->post('start_time');
        $data['end_time'] = $this->input->post('end_time');  
        $data['title'] = $this->input->post('title');      
        $data['class_date'] = date('Y-m-d', strtotime($this->input->post('date')));

        // if($data['class_type'] == 'jitsi'){
        //     $data['meeting_id'] = '';
        //     $data['meeting_password'] = '';
        // }
        if($data['school_id']!='' && $data['class_id']!='' && $data['section_id']!='' && $data['subject_id']!='' && $data['teacher_id']!='' && $data['class_type']!='' && $data['start_time']!='' && $data['end_time']!='' && $data['title']!='' && $data['class_date']!='')
        {
            if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            $school = $this->liveclass->get_school_by_id($data['school_id']);            
            // if(!$school->academic_year_id){
            //     error($this->lang->line('set_academic_year_for_school'));
            //     redirect('academic/liveclass/index');   
            // }            
            $data['academic_year_id'] = $school->academic_year_id;
            $insert_id = $this->liveclass->insert('live_classes', $data);
            if (!empty($data)) {
                $result['status']=true;
                $result['message']="Lecture Create Successfully";
                $result['data']=$data;
                }else{
                $result['status']=false;
                $result['message']="Lecture Not Created";
                $result['data']=[];
                } 
       
            }
        }else{
            $result['status']=false;
                $result['message']="Field not Null";
                $result['data']=[];
        }      
                echo json_encode($result);
        
    }


    //Api For List Lecture By Teacher Id
    public function list_teacher_lecture()
    {
      $school_id =$this->input->post('school_id');
      $teacher_id =$this->input->post('teacher_id');
      
      
    
      if($school_id!='' && $teacher_id!='')
        {
      $lecture="select live_classes.id ,live_classes.school_id,
      live_classes.academic_year_id,live_classes.class_id,live_classes.section_id,live_classes.subject_id,live_classes.title,
      live_classes.teacher_id,live_classes.class_date,
      live_classes.start_time,live_classes.end_time,
      live_classes.class_type,live_classes.status,
      live_classes.created_at, classes.name as class_name,
      sections.name as section_name, subjects.name as subject_name
       from live_classes INNER JOIN classes ON classes.id=live_classes.class_id
        INNER JOIN sections ON sections.id=live_classes.section_id 
        INNER JOIN subjects ON subjects.id=live_classes.subject_id where 
        live_classes.school_id='".$school_id."' 
        and live_classes.teacher_id='".$teacher_id."'  ORDER BY live_classes.id DESC";
      $lecture_data=$this->db->query($lecture)->result_array();
        
           if (!empty($lecture_data)) {
            $result['status']=true;
            $result['message']="Lecture List 🎫";
            $result['data']=$lecture_data;
            }else{
            $result['status']=false;
            $result['message']="Data Not Found🥺";
            $result['data']=[];
            } 
            
        }else{
            $result['status']=false;
            $result['message']="Invalid Credentials😫";
            $result['data']=[];
        }
        echo json_encode($result);
    }


    //Api for date lecture
    public function divert_lecture()
    {
      $school_id =$this->input->post('school_id');
      $class_id =$this->input->post('class_id');
    
      if($school_id!='' && $class_id!='')
        {
      $teacher="select subjects.teacher_id,subjects.name as subject_name, teachers.name as teacher_name from subjects INNER JOIN teachers ON teachers.id=subjects.teacher_id where subjects.school_id='".$school_id."' and subjects.class_id=".$class_id;
      $teacher_data=$this->db->query($teacher)->result_array();
        
           if (!empty($teacher_data)) {
            $result['status']=true;
            $result['message']="Teacher List 🎫";
            $result['data']=$teacher_data;
            }else{
            $result['status']=false;
            $result['message']="Data Not Found🥺";
            $result['data']=[];
            } 
            
        }else{
            $result['status']=false;
            $result['message']="Invalid Credentials😫";
            $result['data']=[];
        }
        echo json_encode($result);
    }


//Api for Update Lecture status
public function update_lecture_status()
{

    $result=array();
    $school_id =$this->input->post('school_id');
    $lecture_id =$this->input->post('lecture_id');
    $teacher_id =$this->input->post('teacher_id');
    $class_id =$this->input->post('class_id');
    $section_id =$this->input->post('section_id');
    $subject_id =$this->input->post('subject_id');
    $status =$this->input->post('status');
    $note =$this->input->post('note');


        if($school_id!='' && $lecture_id!='' && $class_id!='' && $teacher_id!='' && $section_id!='' && $subject_id!='' && $status!='' && $note!='')
        {
         $data=array('status'=>$status,'note'=>$note);  
         $where=array('id'=>$lecture_id);
         $this->db->where($where);
         $status_update=$this->db->update('live_classes', $data); 

         if (!empty($status_update)) {
              $result['status']=true;
              $result['message']=" Status Updated Successfully👍";
              $result['data']=$data;
          }else{
              $result['status']=false;
              $result['message']="Status Not Update😫";
              $result['data']=[];
          }
        }else{
        $result['status']=false;
              $result['message']="Data Not Null😫";
              $result['data']=[];

             }
            echo json_encode($result);
      

}

//Api For Upcoming Lacture
public function upcomming_lacture()
    {

      $school_id =$this->input->post('school_id');
      $lecture_id =$this->input->post('lecture_id');
      $status =$this->input->post('status');

      if($school_id!='')
        {
      $teacher="select * from live_classes where  live_classes.school_id='".$school_id."' and str_to_date(live_classes.class_date, '%Y-%m-%d') >= CURDATE()";
      $teacher_data=$this->db->query($teacher)->result_array();
        
           if (!empty($teacher_data)) {
            $result['status']=true;
            $result['message']="Teacher List 🎫";
            $result['data']=$teacher_data;
            }else{
            $result['status']=false;
            $result['message']="Data Not Found🥺";
            $result['data']=[];
            } 
            
        }else{
            $result['status']=false;
            $result['message']="Invalid Credentials😫";
            $result['data']=[];
        }
        echo json_encode($result);
    }



    //Api For Student Attendance By Month
    public function student_month_attendance() {
        $this->data['month_number'] = 1;       
        $this->data['days'] = 31;
        
        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_id = $this->input->post('student_id');
            $month = $this->input->post('month');
            $days = $this->input->post('days');
            

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['month'] = $month;
            $this->data['student_id'] = $student_id;
            // $this->data['month_number'] = date('m', strtotime($this->data['month']));
            $this->data['month_number'] = $this->data['month'];
            
            $session = $this->report->get_single('academic_years', array('id' => $academic_year_id, 'school_id'=>$school_id));            

            $this->data['school'] = $this->report->get_school_by_id($school_id);
        
            if($this->input->post('student_id')>0){
             
             $this->data['students'] = $this->report->get_student_by_id($school_id,$academic_year_id,$student_id,$class_id,$section_id);
      
            }else{  
                $this->data['students'] = $this->report->get_student_list($school_id,$academic_year_id,$class_id, $section_id);      
            }
        
            $this->data['year'] = substr($session->session_year, 7);
        
            // $this->data['days'] =  @date('t', mktime(0, 0, 0, $this->data['month_number'], 1, $this->data['year']));
            // $this->data['days'] = cal_days_in_month(CAL_GREGORIAN, $this->data['month_number'], $this->data['year']);
            // $month = date('m', strtotime($this->data['month']));
            $month = $this->data['month'];

            $attendance_data=[];
            foreach($this->data['students'] as $attendance){
                $attendance_record= get_student_monthly_attendance($school_id, $attendance->id,
                $academic_year_id, $class_id, $section_id, 
                $month ,31);
                array_push($attendance_data,$attendance_record);            
            }
        }
        $this->data['attendance']=$attendance_data; 


        $condition = array();
        $condition['status'] = 1;        
        // if($this->session->userdata('role_id') != SUPER_ADMIN){ 
            
            $condition['school_id'] = $this->session->userdata('school_id');  
            $this->data['classes'] = $this->report->get_list('classes', $condition, '','', '', 'id', 'ASC');
        // }

        
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($this->data)); 

        
    }


    

}
?>