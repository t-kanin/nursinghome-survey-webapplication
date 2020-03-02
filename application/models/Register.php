<?php


class Register extends CI_Model
{
    private $email_code;

    public function __construct()
    {
        parent::__construct(); // always safe to do this
        $this->load->database();
    }

    function createResident($name,$lastName,$level,$room,$birthdate,$gender,$language){
        $this->load->model('Database_data');

        $NursingHome =$this->Database_data->fetch_id_nursing_home();
        foreach($NursingHome->result() as $row)
            $IdNursingHome = $row->IdNursingHome;
        $this->session->set_userdata('Nursinghome',$IdNursingHome);
        $this->db->select('Level');
        $this->db->from('Level');
        $this->db->Where('Level',$level);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        $IdCaregiver = $this->session->userdata('User_id');
        if($rowcount == 0) {
            $updateData = array(
                'Level' => $level,
                'Value' => 1,
                'IdCaregiver'=> $IdCaregiver,
                'NursingHome' => $IdNursingHome
            );
            $this->db->insert('Level',$updateData);
        }
        $data = array(
            'Firstname' => $name,
            'Lastname' => $lastName,
            'Level'=>$level,
            'Room'=>$room,
            'Birthday'=>$birthdate,
            'Gender'=>$gender,
            'Language'=>$language,
            'NursingHome' => $IdNursingHome
        );
        $this->db->insert('Resident', $data);
        return $this->db->insert_id();
    }
    function updateResident($name,$lastName,$level,$room,$IdResident){
        $this->load->model('Database_data');
        $NursingHome =$this->Database_data->fetch_id_nursing_home();
        foreach($NursingHome->result() as $row)
            $IdNursingHome = $row->IdNursingHome;
        $this->db->set('Firstname', $name);
        $this->db->set('Lastname',$lastName);
        $this->db->set('Level',$level);
        $this->db->set('Room',$room);
        $this->db->where('IdResident', $IdResident);
        $this->db->where('NursingHome', $IdNursingHome);
        $this->db->update('Resident');
    }
    function fetch_nursing_home_id($ref_code){
        // ref_code is the code corresponding to the nursing home so that not anyone can register
        $this->db->select('*');
        $this->db->from('NursingHome');
        $this->db->where('Code',$ref_code);
        $result=$this->db->get();
        $row = $result->row();
        $nursing_home_id = $row->IdNursingHome;
        return $nursing_home_id;

    }
    function createCaregiver($name,$lastName,$email,$password,$nursingHome,$language){
        $data = array(
            'Firstname' =>$name,
            'Email' => $email,
            'Lastname' => $lastName,
            'Password' => md5($password),
            'NursingHome' => $nursingHome,
            'Language' => $language
        );
        $this->db->insert('Caregiver', $data);
        $this->set_session($name,$lastName,$email);
        $this->send_verification_email();
        return $this->db->insert_id();
    }
    private function set_session($name,$lastName, $email,$logged_in =0){
        //$sql="SELECT IdCaregiver, Reg_time FROM Caregiver WHERE email ='{$email}'";
        $this->db->select('Caregiver.IdCaregiver, Caregiver.Reg_time,NursingHome.NursingHome,Caregiver.Language');
        $this->db->from('Caregiver');
        $this->db->join('NursingHome','NursingHome.IdNursingHome = Caregiver.NursingHome');
        $this->db->where('Caregiver.email', $email);
        $result=$this->db->get();
        $row = $result->row();

        $sess_data=array(
            'User_id'=>$row->IdCaregiver,
            'Firstname'=>$name,
            'Lastname'=>$lastName,
            'Email'=>$email,
            'logged_in'=>$logged_in,
            'NursingHome'=> $row->NursingHome,
            'Language' => $row->Language
        );
        $this->email_code=md5((string)$row->Reg_time);
        $this->session->set_userdata($sess_data);
    }
    private function send_verification_email(){
        $email =$this->session->userdata('Email');
        $email_code =$this->email_code;
        $this->email->set_mailtype("html");
        $this->email->from($this->config->item('bot_email'),'Team Three Admin');
        $this->email->to($email);
        $this->email->subject('Please activate your account');
        $message= '<body><p>Dear '.$this->session->userdata('Firstname').',</p>';  //problem
        /// users/validate_email/email/md5 string
        $message.= 'Please click the link to activate your account <strong><a href="' .base_url() .'users/validate_email/'.
            $email .'/'.$email_code.'">click here </a> </strong></p>';
        $message.='<p>Thank you!</p>';
        $message.='<p>Team Three</p></body>';

        $this->email->message($message);
        $this->email->send();
    }

    public function validate_email($email, $email_code){
        $sql = "SELECT IdCaregiver,Email,Reg_time,Firstname FROM Caregiver WHERE Email='{$email}'";
        $result=$this->db->query($sql);
        $row=$result->row();
        $IdCaregiver=$result->row()->IdCaregiver;
        if($result->num_rows()==1){
            if(md5((string)$row->Reg_time)==$email_code){
                $result = $this->activate_account($email,$IdCaregiver);
                if($result)
                    return true;
                else
                    echo '  result is false';
            }
        }else
            echo $email;
    }
    private function activate_account($email,$id){
        $this->load->model('Database_data');
        $this->db->set('Activated', 1);
        $this->db->where('Email', $email);
        $this->db->where('IdCaregiver', $id);
        $this->db->update('Caregiver');
        $this->db->affected_rows();
        if($this->db->affected_rows()==1){
            $data =$this->Database_data->fetch_data_level();
            foreach($data->result() as $row){
                $data2=array(
                    'IdCaregiver' => $id,
                    'Level' => $row->Level,
                    'Value'=> 1
                );
                $this->db->insert('Level', $data2);
            }
            return true;
        }
        else{
            echo $this->db->affected_rows();
            echo $email;
            echo $id;
            return false;
        }
    }
    function loginCaregiver($email, $password){
       // $query =$this->db->query("SELECT Email,IdCaregiver,Firstname,Lastname FROM Caregiver WHERE Email='$email' AND Password=md5('$password') AND Activated =1");
        $query=$this->db->conn_id->prepare("SELECT Email,IdCaregiver,Firstname,Lastname FROM Caregiver WHERE Email=? AND Password=? AND Activated =1");
        $query->execute(array($email,$password));
        $query->fetchAll();
        $row=$query;
        if($query->rowCount() == 1){ //row_counts
            $name=$row->Firstname;
            $lastName=$row->Lastname;
            $this->set_session($name,$lastName,$email,1);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function iamgeUpdate($imageArray){
        return $this -> db -> insert('a19ux3.Image', $imageArray);
    }

    public function getImages(){
        $query="select ImageName from a19ux3.Image;";
        $result= $this->db->query($query);
        return $result->result_array();
    }

    public function getPasswordResident($firstName,$lastName){
        $query="select IdResident, Password from a19ux3.Resident where Firstname=".$this->db->escape($firstName)." and Lastname=".$this->db->escape($lastName);
        $result=$this->db->query($query);
        return $result->result_array();
    }

    public function updatePasswordResident($firstName,$lastName,$typeInPasswordHash){
        $query="update a19ux3.Resident set Password=".$this->db->escape($typeInPasswordHash)." where Firstname=".$this->db->escape($firstName)." and Lastname=".$this->db->escape($lastName);
        $result=$this->db->query($query);
        return $result;
    }

    public function getResidentLevel()
    {
        $this->db->distinct('Level');
        $this->db->select('Level');
        $this->db->from('Resident');
        $query = $this->db->get();
        $row =$query->result_array();
        return $row;
    }

    public function getResidentRoomByLevel($level){
        if($level!=NULL){
            $this->db->distinct('Room');
            $this->db->select('Room');
            $this->db->from('Resident');
            $this->db->where('Level',$level);
            $query = $this->db->get();
            $row =$query->result_array();
            return $row;
        }
        else{
            $this->db->distinct('Room');
            $this->db->select('Room');
            $this->db->from('Resident');
            $this->db->where('Level',NULL);
            $query = $this->db->get();
            $row =$query->result_array();
            return $row;
        }
    }

    public function getResidentNameByLevelRoom($level,$room){
        $this->db->select('Firstname');
        $this->db->select('Lastname');
        $this->db->from('Resident');
        $this->db->where('Level',$level);
        $this->db->where('Room',$room);
        $query = $this->db->get();
        $row =$query->result_array();
        return $row;
    }

    //dupilicate name???
    public function getResidentId($firstname,$lastname,$level,$room){
        $this->db->select('IdResident');
        $this->db->from('Resident');
        $this->db->where('FirstName',$firstname);
        $this->db->where('LastName',$lastname);
        $this->db->where('Level',$level);
        $this->db->where('Room',$room);
        $query = $this->db->get();
        $row =$query->result_array();
        return $row;
    }
    public function reset_resident_password($Idresident){
        $this->db->set('Password',NULL);
        $this->db->where('IdResident', $Idresident);
        $this->db->update('Resident');
        if($this->db->affected_rows()==1){
            return true;
        }
        else
            return false;
    }
}
?>
