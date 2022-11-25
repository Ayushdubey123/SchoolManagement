    
 <?php 
    // defined('BASEPATH') OR exit('No direct script access allowed');

     class ExamApi extends CI_Controller
    {   
    public $data = array();


    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('report');
		$this->load->model('../modules/exam/models/Exam_Model', 'exam', true);
        $this->load->model('../modules/academic/models/Routine_Model', 'routine', true);
		$this->load->model('../modules/exam/models/Resultcard_Model', 'resultcard', true);
        $this->load->model('../modules/exam/models/Meritlist_Model', 'merit', true);

        $this->load->model('Auth_Model', 'auth', true);        
                $this->load->model('../modules/exam/models/Schedule_Model', 'schedule', true);

    }


//Api For List  All Exam By School Id
    public function list_exam()
{
        $school_id = $this->input->post('school_id');
        $class_id  = $this->input->post('class_id');           
       
        $this->data['class_id'] = $class_id;
        $this->data['filter_class_id'] = $class_id;
        $this->data['filter_school_id'] = $school_id;       
        
        $school = $this->schedule->get_school_by_id($school_id);  

        $this->data['schedules'] = 
        $this->schedule->get_schedule_list_api($class_id,$school_id, 
            $school->academic_year_id);
        $this->data['list'] = TRUE;
          return $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($this->data));
}


//Api For List Exam Term

    public function exam_term(){
        $school = $this->exam->get_school_by_id($school_id);
        
        $this->data['exams'] = $this->exam->get_exam_list($school_id, @$school->academic_year_id);
        
        $this->data['filter_school_id'] = $school_id;        
        $this->data['schools'] = $this->schools;
        
           return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($this->data));

 } 

// Api For Day Wise Time Table
public function day_timetable(){
    $school_id=$this->input->post('school_id');
     $class_id=$this->input->post('class_id');
     $section_id=$this->input->post('section_id');
    $day=$this->input->post('day');

        $routine="select *from routines INNER JOIN subjects ON subjects.id=routines.subject_id where routines.school_id='".$school_id."'and routines.class_id='".$class_id."'and routines.section_id='".$section_id."' and routines.day='".$day."'";
        $routine_data=$this->db->query($routine)->result_array();

           return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($routine_data));

}


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

            // $this->data['school'] = $this->merit->get_school_by_id($school_id);
            

        }

            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($this->data['examresult']));

        
    }




}




?> 






