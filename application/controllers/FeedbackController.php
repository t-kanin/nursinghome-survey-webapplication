<?php


class FeedbackController extends CI_Controller
{
    public function __construct(){
        parent::__construct();

    }
    public function view($page = 'language'){
        if(!file_exists(APPPATH.'views/feedback/'.$page.'.php')){
            show_404();
        }

        if($page == 'feedback_nursinghome_check'){
            $this->language_nursinghome_check($page);
        }
        else if($page == 'feedback_choose_kind'){
            $this->language_choose_kind($page);
        }
        else if($page == 'feedback_speak'){
            $this->language_speak($page);
        }
        else if($page == 'feedback_listen'){
            $this->language_listen($page);
        }
        else if($page == 'feedback_type'){
            $this->language_type($page);
        }
        else if($page == 'feedback_complete'){
            $this->language_complete($page);
        }
        else {
            $this->load->view('feedback/'.$page);
        }

    }

    public function language_nursinghome_check($page){
        $this->load->library('session');

        if($this->session->userdata("Language")=='Dutch'){
            $data['plant_talk'] = '“Edouard Remy” is het woonzorgcentrum waaraan u feedback geeft';
            $data['yes'] = 'Ja, dit is correct';
            $data['no'] = 'Neen, ik wens een ander woonzorgcentrum te kiezen';
            $data['back'] = 'Ga terug';
            $data['home'] = 'Hoofdmenu';
        }
        else if($this->session->userdata("Language")=='English'){
            $data['plant_talk'] = 'The nursing home you want to give feedback to is called: "Edouard Remy"';
            $data['yes'] = 'Yes, this is the correct nursing home';
            $data['no'] = 'No, I want a different nursing home';
            $data['back'] = 'Back';
            $data['home'] = 'Home';
        }
        else if($this->session->userdata("Language")=='French'){
            $data['plant_talk'] = 'La maison de retraite à qui vous voulez donner votre avis s’appelle: "Edouard Remy"';
            $data['yes'] = 'Oui, c’est correct';
            $data['no'] = 'Non, je veux une maison de retraite différente';
            $data['back'] = 'Retour';
            $data['home'] = 'Maison';
        }

        $this->load->view('feedback/'.$page, $data);
    }

    public function language_choose_kind($page){
        $this->load->library('session');

        if($this->session->userdata("Language")=='Dutch'){
            $data['how_question'] = 'Hoe wil je feedback geven?';
            $data['speaking'] = 'Door te spreken';
            $data['typing'] = 'Door te typen';
            $data['back'] = 'Ga terug';
            $data['home'] = 'Hoofdmenu';
        }
        else if($this->session->userdata("Language")=='English'){
            $data['how_question'] = 'How do you wish to give feedback?';
            $data['speaking'] = 'By Speaking';
            $data['typing'] = 'By Typing';
            $data['back'] = 'Back';
            $data['home'] = 'Home';
        }
        else if($this->session->userdata("Language")=='French'){
            $data['how_question'] = 'Comment voulez-vous donner vos commentaires?';
            $data['speaking'] = 'Par la parole';
            $data['typing'] = 'Par l\'écriture';
            $data['back'] = 'Retour';
            $data['home'] = 'Maison';
        }

        $this->load->view('feedback/'.$page, $data);
    }

    public function language_speak($page){
        $this->load->library('session');

        if($this->session->userdata("Language")=='Dutch'){
            $data['microphone'] = 'Klik op de microfoon om te beginnen met opnemen';
            $data['endrecording'] = 'Stop met opnemen';
            $data['back'] = 'Ga terug';
            $data['home'] = 'Hoofdmenu';
        }
        else if($this->session->userdata("Language")=='English'){
            $data['microphone'] = 'Click on the microphone to start recording';
            $data['endrecording'] = 'End recording';
            $data['back'] = 'Back';
            $data['home'] = 'Home';
        }
        else if($this->session->userdata("Language")=='French'){
            $data['microphone'] = 'Cliquez sur le microphone pour commencer l\'enregistrement';
            $data['endrecording'] = 'Terminer l\'enregistrement';
            $data['back'] = 'Retour';
            $data['home'] = 'Maison';
        }

        $this->load->view('feedback/'.$page, $data);
    }

    public function language_listen($page){
        $this->load->library('session');

        if($this->session->userdata("Language")=='Dutch'){
            $data['ear'] = 'Druk op het oor om uw feedback te beluisteren';
            $data['submit'] = 'Indienen';
            $data['try_again'] = 'Probeer opnieuw';
            $data['back'] = 'Ga terug';
            $data['home'] = 'Hoofdmenu';
        }
        else if($this->session->userdata("Language")=='English'){
            $data['ear'] = 'Press on the ear to hear your recording';
            $data['submit'] = 'Submit';
            $data['try_again'] = 'Try again';
            $data['back'] = 'Back';
            $data['home'] = 'Home';
        }
        else if($this->session->userdata("Language")=='French'){
            $data['ear'] = 'Appuyez sur l’oreille pour écouter votre enregistrement';
            $data['submit'] = 'Envoyer';
            $data['try_again'] = 'Recommencer';
            $data['back'] = 'Retour';
            $data['home'] = 'Maison';
        }

        $this->load->view('feedback/'.$page, $data);
    }

    public function language_type($page){
        $this->load->library('session');

        if($this->session->userdata("Language")=='Dutch'){
            $data['question'] = 'Wat is uw feedback?';
            $data['placeholder_identification'] = 'Identificeer uzelf of de persoon voor wie u feedback geeft';
            $data['placeholder_feedback'] = 'Geef hier uw feedback in';
            $data['submit'] = 'Indienen';
            $data['back'] = 'Ga terug';
            $data['home'] = 'Hoofdmenu';
        }
        else if($this->session->userdata("Language")=='English'){
            $data['question'] = 'What’s your feedback?';
            $data['placeholder_identification'] = 'Please identify yourself or the person you are speaking for';
            $data['placeholder_feedback'] = 'Type here your feedback';
            $data['submit'] = 'Submit';
            $data['back'] = 'Back';
            $data['home'] = 'Home';
        }
        else if($this->session->userdata("Language")=='French'){
            $data['question'] = 'Quels sont tes commentaires?';
            $data['placeholder_identification'] = 'Identifiez-vous ou la personne pour qui vous parlez';
            $data['placeholder_feedback'] = 'Donner vos commentaires ici';
            $data['submit'] = 'Envoyer';
            $data['back'] = 'Retour';
            $data['home'] = 'Maison';
        }

        $this->load->view('feedback/'.$page, $data);
    }

    public function language_complete($page){
        $this->load->library('session');

        if($this->session->userdata("Language")=='Dutch'){
            $data['confirm_message'] = 'Bedankt om feedback te geven';
        }
        else if($this->session->userdata("Language")=='English'){
            $data['confirm_message'] = 'Thank you for giving feedback';
        }
        else if($this->session->userdata("Language")=='French'){
            $data['confirm_message'] = 'Merci d\'avoir donné votre avis';
        }

        $this->load->view('feedback/'.$page, $data);
    }



    public function updateToDB(){
        $username = $this->input->get_post('username',TRUE);
        $text = $this->input->get_post('text');

        $this->load->model('Feedback');

        $is_sucess = $this->Feedback->updateToFeedback(Array('Username'=>$username,'Content'=>html_escape($text),'IsSpoken'=>0));

        if($is_sucess){
            echo "success";
        }else{
            echo '';
        }
    }

    /*Here is from the AuddioController*/

    public function index()
    {
        $this->load->view("Recorder");
    }

    public function  uploadToServer(){
        if($_FILES['audioFile']['error']>0){
            exit('Error with attachment');
        }
        $dir = "./assets/audio/";

        $ext = substr($_FILES['audioFile']['name'],strrpos($_FILES['audioFile']['name'],"."));
        $name = date("YmdHis").'-'.mt_rand(1000,9999).$ext;
        $dir_name = $dir.$name;

        //B. move_uploaded_file()
        if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$dir_name)){
            echo $name;
        }else{
            echo "fail";
        }

    }

    public function uploadAudioToDB(){
        $input=file_get_contents("php://input");
        $object=json_decode($input);
        $audio_name = $object->audio_name;
        $transcript = $object->transcript;
        $this->load->model('Feedback');

        $audioArray=Array("AudioName"=>$audio_name,"Content"=>html_escape($transcript),"IsSpoken"=>1);
        $is_sucess = $this->Feedback->audioUpdate($audioArray);

        if($is_sucess){
            echo 'success';
        }
        else{
            echo 'fail';
        }
    }

    public function languageSelection(){
        $this->load->library('session');
        $lang=$this->input->get_post('language');
        $this->session->set_userdata(array("Language"=>$lang));
        echo $this->session->userdata("Language");
    }

}
