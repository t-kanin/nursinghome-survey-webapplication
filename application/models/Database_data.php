<?php


class Database_data Extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); // always safe to do this
        $this->load->database();
    }
    /*Select all from $data */
    public function fetch_data($data){
        $query= $this->db->get("{$data}");
        return $query;
    }

    public function fetch_id_nursing_home(){
        $nursingHome = $this->session->userdata('NursingHome');
        $this->db->select('IdNursingHome');
        $this->db->from('NursingHome');
        $this->db->where('NursingHome', $nursingHome);
        $query = $this->db->get() ;
        return $query;
    }
    /*Fetch all the unique category*/
    public function fetch_data_unique_category($language){
        /*equal to Select Category from Category*/
        /*it returns all the rows as a result*/
        $this->db->select('Category');
        $this->db->from('CategoryContent');
        $this->db->where('Language',$language);
        $query = $this->db->get();
        return $query;
    }

    public function fetch_data_question($language){
        $this->db->select('Question.IdQuestion,QuestionContent.Content, Question.IsOptional, QuestionContent.Language, CategoryContent.Category');
        $this->db->from('Question');
        $this->db->join('QuestionContent','Question.IdQuestion = QuestionContent.IdQuestion','left');
        $this->db->join('CategoryContent',' Question.IdCategory = CategoryContent.IdCategory','left');
        $this->db->where("QuestionContent.Language='{$language}'");
        $this->db->where("CategoryContent.Language ='{$language}'");
        $query = $this->db->get();
        return $query;
    }

    public function fetch_question_from_id($question_id, $language){
        $this->db->select('Question.IdQuestion, QuestionContent.Content');
        $this->db->from('Question');
        $this->db->join('QuestionContent','Question.IdQuestion = QuestionContent.IdQuestion');
        $this->db->where('QuestionContent.Language', $language);
        $this->db->where('Question.IdQuestion ',$question_id);
        $query = $this->db->get();
        if($query->num_rows() ==0 )return null;
        return $query;
    }

    /*When join is needed */
    public function fetch_data_notification($IdCaregiver){
        /*first get the id of nursingHome */
        $NursingHome =$this->fetch_id_nursing_home();
        foreach($NursingHome->result() as $row)
            $IdNursingHome = $row->IdNursingHome;
        $level = array();
        $fetch_level=$this->fetch_data_notification_level($IdCaregiver);
        if($fetch_level->num_rows() > 0){
            foreach($fetch_level->result() as $row)
                array_push($level,$row->Level);
            $level_str = implode(",",$level);
            $this->db->select('Notification.IdNotification, Notification.Content,Notification.IsChecked, Caregiver.Lastname');
            $this->db->from('Notification');
            $this->db->join('Caregiver',"Notification.IdCaregiverAction = Caregiver.IdCaregiver","left");
            $this->db->join("NotificationCenter","Notification.IdNotification = NotificationCenter.IdNotification ","left");
            $this->db->where("Notification.NursingHome", $IdNursingHome);
            $this->db->where("NotificationCenter.Level IN ({$level_str})");
            $this->db->group_by("Notification.IdNotification");
            $this->db->order_by('Notification.IdNotification','desc');
            $query = $this->db->get();
            return $query;
        }
        else
            return NULL;
    }

    public function fetch_data_resident(){
        $NursingHome =$this->fetch_id_nursing_home();
        foreach($NursingHome->result() as $row)
            $IdNursingHome = $row->IdNursingHome;
        $this->db->select('*');
        $this->db->from('Resident');
        $this->db->join('NursingHome','Resident.NursingHome = NursingHome.IdNursingHome');
        $this->db->where('Resident.NursingHome', $IdNursingHome);
        $query = $this->db->get() ;
        return $query;
    }

    /*fetch all info from resident */
    public function fetch_data_resident_profile($Id){
        $this->db->select('*');
        $this->db->from('Resident');
        $this->db->where('IdResident', $Id);
        $query = $this->db->get();
        return $query;
    }
    /*fetch note for that specific resident and  caregiver*/
    public function fetch_data_resident_profile_note($Id,$IdCaregiver) { // id = resident Id
        $this->db->select('Content');
        $this->db->from('Note');
        $this->db->where('IdResident', $Id);
        $this->db->where('IdCaregiver',$IdCaregiver);
        $query = $this->db->get();
        return $query;
    }

    public function fetch_data_feedback(){
        $this->db->select('Feedback.Content,Feedback.IsSpoken,Feedback.IsAnonymous,Feedback.Username,Feedback.AudioName');  // Resident.Lastname
        $this->db->from('Feedback');
        $this->db->order_by('IdFeedback','desc');
        $query = $this->db->get();
        return $query;
    }

    public function fetch_data_level(){
        $this->db->distinct('Level');
        $this->db->select('Level');
        $this->db->from('Level');
        $query = $this->db->get();
        return $query;
    }

    public function fetch_data_level_select($IdCaregiver){
        $this->create_level_if_not_exist($IdCaregiver);
        $this->db->select('Level, Value');
        $this->db->from('Level');
        $this->db->where("IdCaregiver",$IdCaregiver);
        $query = $this->db->get();
        return $query;
    }

    public function fetch_data_notification_level($IdCaregiver){
        /*get all selected level where caregiver want to receive notification*/
        $this->db->select('*');
        $this->db->from("Level");
        $this->db->where("IdCaregiver",$IdCaregiver);
        $this->db->where("Value", 1 );
        $query = $this->db->get();
        return $query;
    }

    /*Inserting data*/
    public function insert_id_question($IdCaregiver){
        $IdNursingHome =$this->fetch_id_nursing_home();
        foreach($IdNursingHome->result() as $row)
            $IdNursingHome = $row->IdNursingHome;
        $data = array(
            'IsOptional' => 1,
            'IdCategory' => 12, // 12 for optional questions
            'IdCaregiver' => $IdCaregiver,
            'IdNursingHome' => $IdNursingHome
        );
        $this->db->insert('Question', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function insert_notification($notification, $IdCaregiver){
        $IdNursingHome =$this->fetch_id_nursing_home();
        foreach($IdNursingHome->result() as $row)
            $IdNursingHome = $row->IdNursingHome;
        $data  = array(
            'Content' => html_escape($notification),
            'IsChecked' => 0,
            'NursingHome' => $IdNursingHome
        );
       $this->db->insert('Notification',$data);
        $IdNotification = $this->db->insert_id();
        $data = array();
        $fetch_level=$this->fetch_data_notification_level($IdCaregiver);
        foreach($fetch_level->result() as $row){
            $data = array(
                "IdNotification" => $IdNotification,
                "Level" => $row->Level
            );
            $this->db->insert('NotificationCenter', $data);
        }
        print_r($data);
    }
    public function is_question_exist($question){
        if($question == NULL) return false;
        else{
            $this->db->select('IdQuestionContent');
            $this->db->from('QuestionContent');
            $this->db->where('Content',$question);
            $query = $this->db->get();
            if($query->num_rows()>0){ // $this->db->affected_rows()>0)
                return FALSE;
            }
            else
                return TRUE;
        }
    }


    public function create_level_if_not_exist($IdCaregiver){
        $fetch_data=$this->fetch_data_level();
        foreach($fetch_data->result() as $row) {
            /*check if the level exist*/
            $this->db->from('Level');
            $this->db->where('Level',$row->Level);
            $this->db->where('IdCaregiver', $IdCaregiver);
            if($this->db->get()->num_rows() == 0){
                $data = array(
                    "IdCaregiver" => $IdCaregiver,
                    "Level" => $row->Level,
                    "Value" => 1
                );
                $this->db->insert('Level',$data);
            }
        }
    }
    /*updating data */
    public function update_notification($level, $IdCaregiver){
        //$value = implode(',',$level); // JOIN ALL ID INTO ONE COMMA SEPARATED STRING
        $this->create_level_if_not_exist($IdCaregiver);
        if(!empty($level)){
            $sql ="Update Level set Value = 1 Where Level IN($level) AND IdCaregiver =$IdCaregiver";
            $this->db->query($sql);

            $sql="Update Level set Value = 0 Where Level NOT IN ($level) AND IdCaregiver = $IdCaregiver";
            $this->db->query($sql);
        }
        else{
            $fetch_data=$this->fetch_data_level();
            foreach($fetch_data->result() as $row){
                $this->db->set('Value', 0);
                $this->db->where('Level', $row->Level);
                $this->db->where('IdCaregiver', $IdCaregiver);
                $this->db->update('Level');
            }
        }
    }


    public function update_takecare_status ($IdNotification, $IdCaregiver ){
        $query=$this->db->conn_id->prepare("update Notification set IsChecked = 1, IdCaregiverAction = ? Where IdNotification = ? ");
        $query->execute(array($IdCaregiver,$IdNotification));
        if($query->rowCount() >= 1)
            return true;
        else
            return false;
    }

    public function update_note($note,$IdResident, $IdCaregiver){
        $num_row = $this->fetch_data_resident_profile_note($IdResident, $IdCaregiver)->num_rows();
        $data = array(
            'Content' => html_escape($note),
            'IdResident' => $IdResident,
            'IdCaregiver' => $IdCaregiver
        );
        if($num_row == 0)
            $this->db->insert('Note', $data);
        else{
            $this->db->set('Content', $note);
            $this->db->where('IdResident', $IdResident);
            $this->db->where('IdCaregiver', $IdCaregiver);
            $this->db->update('Note');
        }
    }

    public function update_question($content, $language,$IdQuestion){
        $num_row = 0;
        if($this->fetch_question_from_id($IdQuestion,$language) != null)
            $num_row = $this->fetch_question_from_id($IdQuestion,$language)->num_rows();
        $data_insert = array(
            'Language' => html_escape($language),
            'Content' => html_escape($content),
            'IdQuestion' => html_escape($IdQuestion)
        );
        if($num_row == 0)
            $this->db->insert('QuestionContent', $data_insert);
        else{
            $this->db->where('IdQuestion',$IdQuestion);
            $this->db->where('Language', $language);
            $this->db->update('QuestionContent', $data_insert);
        }

    }

}