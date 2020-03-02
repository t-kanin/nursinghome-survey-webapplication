<?php

class PageController extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->model('Database_data');
        $this->load->library('session');
        $Is_loggedIn = $this->session->userdata('logged_in');
        if($Is_loggedIn == 0)
            redirect('Users/index');
    }


    public function view($page = 'overview'){
        //print_r($this->session->all_userdata());
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }
        if($page=='login_caregiver')
            redirect('test_kanin');
        $data['title'] = ucfirst($page);
        $this->parser->parse('pages/'.$page, $data);
    }

    /*Generating the table from the database */
    public function table_view($page ='Resident'){
        $language = $this->session->userdata('Language');
        $IdCaregiver=$this->session->userdata('User_id');
        $data = array();
        /*load different javascript for different page*/
        if($page == 'questionnaire_editor') $data['jslibs_to_load'] = array('dataTableQuestionnaire.js');
        else $data['jslibs_to_load'] = array('dataTable.js');

        if($page === 'Resident'){
            $data['title'] = 'Bewoners';
            $data['fetch_data']=$this->Database_data->fetch_data_resident();
        }
        if($page ==='questionnaire_editor'){
            $data['title']='Vragenlijst';
            $data['fetch_data']=$this->Database_data->fetch_data_question($language);
        }
        if($page ==='Setting')
        {
            $data['title']= 'Instellingen';
            //$data['level'] =$this->Database_data->fetch_data_level();
            $data['fetch_data'] = $this->Database_data->fetch_data_level_select($IdCaregiver);
        }
        if($page === 'Notification')
        {
            $data['title'] = 'Notificaties';
            $data['fetch_data']=$this->Database_data->fetch_data_notification($IdCaregiver);
        }
        if($page ==='Feedback'){
            $data['title'] = 'Feedback';
            $data['fetch_data']=$this->Database_data->fetch_data_feedback();}

        $this->load->view('templates/header_table',$data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer_table');
    }

    public function resident_profile($Id){
        $IdCaregiver=$this->session->userdata('User_id');
        $fetch_data = $this->Database_data->fetch_data_resident_profile($Id);
        $fetch_note = $this->Database_data->fetch_data_resident_profile_note($Id,$IdCaregiver);
        $data_fetch= array();
        $data_fetch['Note']= array();
        foreach($fetch_data->result() as $row){
            $data_fetch['Profile'] = array(
                'Firstname' => $row->Firstname,
                'Lastname'  => $row->Lastname,
                'Language'  => $row->Language,
                'Birthdate' => $row->Birthday,
                'Gender'    => $row->Gender,
                'Level'     => $row->Level,
                'Room'      => $row->Room,
                'IdResident'=> $Id,
            );
        }
        foreach($fetch_note->result() as $row){
            $data_fetch['Note'] = array(
                'Note' => $row->Content
            );
        }
        $data_fetch['isProfile'] = true;
        $this->load->view('templates/header_register');
        $this->load->view('../controllers/GraphDataController', $data_fetch);
    }

    public function resident_reset_password(){
        $this->load->model('Register');
        $IdResident = $this->input->get_post('Id',true); // resident_id
        if($this->Register->reset_resident_password($IdResident)== true){
            $this->session->set_tempdata('reset_pass_success','Password reset successfully',10);
            echo "success";}
        else
            echo "failure";
    }

    public function update_note(){
        $note=$this->input->get_post('note',true);
        $IdResident = $this->input->get_post('Id',true); // resident_id
        $IdCaregiver=$this->session->userdata('User_id');
        $this->Database_data->update_note($note,$IdResident, $IdCaregiver);
        $this->session->set_tempdata('save_note','Note has been saved',5);
        echo "success";
    }
    public function add_question(){
        $data = array();
        $data['title'] = "Voeg een vraag toe aan de vragenlijst";
        $data['function'] = "add_question";
        $this->form_validation->set_rules('content_NL', 'Nederlands', 'required|is_unique[QuestionContent.Content]');
        $this->form_validation->set_rules('content_EN', 'English', 'is_unique[QuestionContent.Content]');
        $this->form_validation->set_rules('content_FR', 'French', 'is_unique[QuestionContent.Content]');
        $data['NL'] = $this->input->post('content_NL',true);
        $data['EN']= $this->input->post('content_EN',true);
        $data['FR']= $this->input->post('content_FR',true);

        if($this->form_validation->run() == False ){
            $this->load->view('templates/header_table',$data);
            $this->parser->parse('pages/questionnaire_edit',$data);
            $this->load->view('templates/footer_table');
        }
        else{
            $questionId = $this->Database_data->insert_id_question($IdCaregiver=$this->session->userdata('User_id'));
            $this->Database_data->update_question($data['NL'],'Dutch',$questionId);
            if(!empty($data['EN']))
                $this->Database_data->update_question($data['EN'],'English',$questionId);
            if(!empty($data['FR']))
                $this->Database_data->update_question($data['FR'],'French',$questionId);
            $this->session->set_tempdata('update_question_success','Vraag toevoegen is gelukt!',3);
            redirect('PageController/table_view/questionnaire_editor');
        }
    }

    /*if questionId == 0 it means user "add" a question and not "edit" the existing question */
    public function edit_question($questionId =0){
        $data = array();
        $data['title'] = 'Vraag bewerken';
        $data['function'] = "edit_question/{$questionId}";
        if($this->Database_data->fetch_question_from_id($questionId,'Dutch') != NULL)
            $data['NL'] = $this->Database_data->fetch_question_from_id($questionId,'Dutch')->row()->Content;
        if($this->Database_data->fetch_question_from_id($questionId,'English') != NULL)
            $data['EN'] = $this->Database_data->fetch_question_from_id($questionId,'English')->row()->Content;
        if($this->Database_data->fetch_question_from_id($questionId,'French') != NULL)
            $data['FR'] = $this->Database_data->fetch_question_from_id($questionId,'French')->row()->Content;
        if(empty($data['NL'])) $data['NL'] =NULL;
        if(empty($data['EN'])) $data['EN'] =NULL;
        if(empty($data['FR'])) $data['FR'] =NULL;

        $this->form_validation->set_rules('content_NL', 'Nederlands', 'required');
        $data['questionId'] = $questionId;

        if($this->form_validation->run() == False){
            $this->load->view('templates/header_table',$data);
            $this->parser->parse('pages/questionnaire_edit',$data);
            $this->load->view('templates/footer_table');
        }
        else{
            $data['NL'] = $this->input->post('content_NL',true);
            $data['EN']= $this->input->post('content_EN',true);
            $data['FR']= $this->input->post('content_FR',true);
            $this->Database_data->update_question($data['NL'],'Dutch',$questionId);
            if(!empty($data['EN']))
                $this->Database_data->update_question($data['EN'],'English',$questionId);
            if(!empty($data['FR']))
                $this->Database_data->update_question($data['FR'],'French',$questionId);
            $this->session->set_tempdata('update_question_success','Vraag is succesvol aangepast',3);
            redirect('PageController/table_view/questionnaire_editor');
        }

    }

    /*Add notification*/
    public function add_notification(){
        $IdCaregiver=$this->session->userdata('User_id');
        $this->form_validation->set_rules('question-box', 'content', 'required');
        $data['title'] = "Voeg een notificatie toe";
        $this->load->model('Database_data');
        $notification = $this->input->post("question-box",true);
        if($this->form_validation->run() == false){
            $this->load->view('templates/header_table',$data);
            $this->load->view('pages/notification_editor');
            $this->load->view('templates/footer_table');
        }
        else{
            $this->session->set_tempdata('add_notification','Notificatie is verzonden',10);
            $this->Database_data->insert_notification($notification,$IdCaregiver);
            redirect('PageController/table_view/Notification');
        }
    }

    /*select the floor you want to get the notification from*/
    public function select_floor(){
        $IdCaregiver=$this->session->userdata('User_id');
        $level=$this->input->get_post('Level',true);
        $this->Database_data->update_notification($level,$IdCaregiver);
        //echo $level;
        $this->session->set_tempdata('select_floor','Instelling is opgeslagen',10);
        echo "success";
    }

    /*change the status when caregiver take care of the notification*/

    public function change_status(){
        $IdCaregiver = $this->session->userdata('User_id');
        $IdNotification = $this -> input -> get_post('IdNotification',true);
        if($this->Database_data->update_takecare_status($IdNotification, $IdCaregiver) == true){
            echo "success";
        }
        else
            echo "failure";
    }
    /*statistic section + graph*/
    public function statistic($page='statistics'){
        $data['title'] = "Statistieken van deze week";
        $data['isProfile'] = false;
        $this->load->view('templates/header_table',$data);
        $this->load->view('../controllers/GraphDataController', $data);
        $this->load->view('templates/footer_table');
    }

    public function longtermgraph(){
        $data['title'] = 'Statistieken aangepast bereik';
        $this->load->view('templates/header_table',$data);
        $this->load->view('../controllers/LongTermGraphDataController');
        $this->load->view('templates/footer_table');
    }
}



