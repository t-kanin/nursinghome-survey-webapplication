<?php

class ResidentController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    public function resident($page ='privacy')
    {
        if($this->session->userdata("language_resident")=='Dutch'){
            $data['end_the_survey'] = 'Beëindig enquête';
            $data['go_back'] = 'Ga terug';
            $data['listen'] = 'Beluister de tekst';
        }
        else{
            $data['end_the_survey'] = 'End the survey';
            $data['go_back'] = 'Go back';
            $data['listen'] = 'Listen to the text';
        }
        $data['title'] = ucfirst($page);


        if($page =='privacy'){
            if($this->session->userdata("language_resident")=='Dutch'){
                $data['share_answers'] = 'Wilt u uw antwoorden met de zorgverleners delen?';
                $data['read_more'] = 'Lees verder';
                $data['read_less'] = 'Lees minder';
                $data['Yes'] = 'Ja';
                $data['No'] = 'Nee';
                $data['share_answers_extra']="U stemt ermee in vragen te beantwoorden over de kwaliteit van uw leven in de residentie.
Als u ja antwoordt, worden uw antwoorden gedeeld met de zorgverleners, anders worden ze anoniem verwerkt.";
            }
            else{
                $data['share_answers'] = 'Do you want to share your answers with the caregivers?';
                $data['read_more'] = 'Read more';
                $data['read_less'] = 'Read less';
                $data['Yes'] = 'Yes';
                $data['No'] = 'No';
                $data['share_answers_extra']="You agree to answer questions about your quality of life in the residence.
If you answer yes, your answers will be shared with the caregivers, otherwise it will be processed anonymously.";
            }
        }
        if($page =='ifSurveyNotEnded'){
            if($this->session->userdata("language_resident")=='Dutch'){
                $data['continue'] = 'Wilt u doorgaan waar u vorige keer bent gebleven?';
                $data['Yes'] = 'Ja';
                $data['No'] = 'Nee';

            }
            else{
                $data['continue'] = 'Do you want to continue where you left previous time?';
                $data['Yes'] = 'Yes';
                $data['No'] = 'No';
            }
        }
        if($page =='Category'){
            if($this->session->userdata("language_resident")=='Dutch'){
                $data['focus_on'] = 'De volgende vragen zijn gericht op: ';
            }
            else{
                $data['focus_on'] = 'The questions that follow focus on: ';
            }
        }
        if($page =='Questions'){
            if($this->session->userdata("language_resident")=='Dutch'){
                $data['always'] = 'Altijd';
                $data['mostly'] = 'Meestal';
                $data['sometimes'] = 'Soms';
                $data['rarely'] = 'Zelden';
                $data['never'] = 'Nooit';
                $data['no_answer'] = 'Geen antwoord';
                $data['confirm'] = 'Bevestig';
                $data['question'] = 'Vraag';
                $data['from'] = 'van';
                $data['the'] = 'de';
                $data['questions'] = 'vragen';
            }
            else{
                $data['always'] = 'Always';
                $data['mostly'] = 'Mostly';
                $data['sometimes'] = 'Sometimes';
                $data['rarely'] = 'Rarely';
                $data['never'] = 'Never';
                $data['no_answer'] = 'No answer';
                $data['confirm'] = 'Confirm';
                $data['question'] = 'Question';
                $data['from'] = 'from';
                $data['the'] = 'the';
                $data['questions'] = 'questions';
            }
        }
        if($page =='QuestionsAnswered'){
            if($this->session->userdata("language_resident")=='Dutch'){
                $data['questions_answered'] = 'Alle vragen zijn beantwoord. Hartelijk dank voor uw deelname!';
            }
            else{
                $data['questions_answered'] = 'All questions are answered. Thank you for your participation!';
            }
        }
        if($page=='Questions'){
            if($this->session->userdata("language_resident")=='Dutch'){
                $data['listen'] = 'Beluister de vraag';            }
            else{
                $data['listen'] = 'Listen to the question';            }
            $this->load->view('resident/'.$page, $data);
        }else{
        $this->load->view('templates/header_resident_login',$data);
        $this->load->view('resident/'.$page, $data);
        }
    }

    public function storeAnswer(){
        $idResident=$_POST['idResident'];
        $idQuestion=$_POST['idQuestion'];
        $content=$_POST['content'];
        $sql = "UPDATE a19ux3.Answer SET Content=$content WHERE IdResident=$idResident AND IdQuestion=$idQuestion AND Timestamp>DATE_SUB(NOW(),INTERVAL 6 HOUR)";
        $result=$this->db->query($sql);
        if ($this->db->affected_rows()==0) {
            $sql = "INSERT INTO a19ux3.Answer (IdResident,IdQuestion,Content) VALUES ('$idResident','$idQuestion','$content')";
            $this->db->query($sql);
        }
    }
}
