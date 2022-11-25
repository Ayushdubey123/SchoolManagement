
 <?php 
    // defined('BASEPATH') OR exit('No direct script access allowed');

     class GuardianApi extends CI_Controller
    {   

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('report');
		$this->load->model('../modules/guardian/models/Guardian_Model', 'guardian', true);
		
        $this->load->model('Auth_Model', 'auth', true);        
    }

//Api For Guardian Login

public function guardian_login()
    {
         $result=array();

   try {


         $data['username'] = $this->input->post('username');           
            $data['password'] = md5($this->input->post('password'));

            // echo($data['username']);
            // echo($data['password']);
            // die();

            $login = $this->auth->get_single('users', $data);
            if (!empty($login)) {
            $guardian_data=$this->get_guardian_info($login->id);
              $result['status']=true;
              $result['message']="Login Successfully";
              $result['data']=array("Guardian_data"=>$guardian_data,
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

	

    public function get_guardian_info($id)
{
          $query_guardian="select *, id as guardian_id from guardians where user_id=".$id;
           $guradian_data=$this->db->query($query_guardian)->result_array();
           return $guradian_data;

}
 	


}




?> 






