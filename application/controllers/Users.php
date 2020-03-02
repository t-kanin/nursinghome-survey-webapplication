<?php


class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();  // you have to call superclass manually
        $this->load->model('Register', 'user');
    }


    public function index($page = 'home'){   // view to index
        $this->load->library('session');
        if(!$this->session->has_userdata('NursingHome')){  // return false if not exist or null;
            $this->session->set_flashdata('selectNursingHome',"Selecteer uw woonzorgcentrum");
            redirect('NursingHome/index');
        }
        if(!file_exists(APPPATH.'views/users/'.$page.'.php')){
            show_404();
        }
        $data['NursingHome']=$this->session->userdata('NursingHome');
        $data['title'] = ucfirst($page);
        if($page != 'login_caregiver')
            $header='header_register';
        else
            $header='header';

        if($page !='home')
            $this->load->view('templates/'.$header);
        $this->parser->parse('users/'.$page, $data);

    }
    public function login_resident($page ='resident_login'){
        $this->load->library('session');
        $data['title'] = ucfirst($page);
        if($this->session->userdata("language_resident")=='English'){

            $data['end_the_survey'] = 'Home screen';
            $data['go_back'] = 'Go back';
            $data['listen'] = 'Listen to the text';
            $data['confirm']='Confirm';
        }
        else{
            $data['end_the_survey'] = 'Hoofd- menu';
            $data['go_back'] = 'Ga terug';
            $data['listen'] = 'Beluister de tekst';
            $data['confirm']='Bevestig';
        }
        if($page !='resident_password') {
            $this->load->view('templates/header_resident_login',$data);
        }

        if ($page=='resident_login'){
            if($this->session->userdata("language_resident")=='English'){
                $data['hi'] = 'Hi, I am Daisy. Thanks for participating in the questionnaire. The survey consists of 3 parts:';
                $data['identify'] = '1) Identify yourself';
                $data['privacy'] = '2) Fill in the privacy notice';
                $data['answer_questions']='3) Answer 50 questions about your quality of life';
                $data['start']="Start";
            }
            else{
                $data['hi'] = 'Hallo, ik ben Daisy. Bedankt voor uw deelname aan de vragenlijst. Het onderzoek bestaat uit 3 delen:';
                $data['identify'] = '1) Identificeer jezelf';
                $data['privacy'] = '2) Vul de privacyverklaring in';
                $data['answer_questions']='3) Beantwoord 52 vragen over de kwaliteit van jouw leven';
                $data['start']="Start";
            }
        }


        //if the page is resident_login_floor transmit values here
        if($page == 'resident_login_floor'){
            $result=$this->user->getResidentLevel();
            $data['Level']=$result;
            if($this->session->userdata("language_resident")=='English'){
                $data['floor'] = 'Press on your floor';
            }
            else{
                $data['floor'] = 'Druk op je verdieping';
            }
        }
        if($page=='resident_login_room'){
            //use post to receive form
            $level=$this->input->get_post("level");

            if($this->session->userdata("language_resident")=='English'){
                $data['room'] = 'Press on your room';
            }
            else{
                $data['room'] = 'Druk op je kamernummer';
            }

            //get level in post
            if($level!=null){
                $this->session->set_userdata(Array("Level"=>$level));
            }

            //get level from session
            $level= $this->session->userdata("Level");
            //session level

            $result=$this->user->getResidentRoomByLevel($level);
            $data['Room']=$result;
            $data['Level']=$level;
        }
        if($page=='resident_login_name'){
            $room=$this->input->get_post("room");

            if($this->session->userdata("language_resident")=='English'){
                $data['name'] = 'Press on your name';
            }
            else{
                $data['name'] = 'Druk op je naam';
            }

            //get value from post
            if($room!=null){
                //session room
                $this->session->set_userdata(Array("Room"=>$room));
            }

            //or room value is already in session
            $room=$this->session->userdata("Room");
            $level= $this->session->userdata("Level");

            $result=$this->user->getResidentNameByLevelRoom($level,$room);
            $Firstnames=array();
            $Lastnames=array();
            foreach($result as $value)
            {
                array_push($Firstnames,$value['Firstname']);
                array_push($Lastnames,$value['Lastname']);
            }
            $data['Firstnames']=$Firstnames;
            $data['Lastnames']=$Lastnames;
            $data['Room']=$room;
            $data['Level']=$level;
        }
        $this->load->view('users/'.$page,$data);
    }


    public function login_caregiver(){
        $this->load->library('session');
        $this->load->model('Register');
        $this->form_validation->set_rules('email','email', 'required');
        $this->form_validation->set_rules('password','password', 'required');
        $is_loggedIn=$this->session->userdata('logged_in');
        /*uncomment to show session variable*/
        //print_r($this->session->all_userdata());
        if($is_loggedIn==1)
            redirect('PageController/view');
        $data = array(
            "Email" => $this->input->post('email')
        );
        if(empty($data['Email']))
            $data['Email'] =NULL;

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('invalidLogin',"Email of wachtwoord is fout");
            $this->load->view('templates/header');
            $this->parser->parse('users/login_caregiver',$data);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            if($this->user->loginCaregiver($email,$password)==TRUE){
                redirect('PageController/view');
                //$this->Register->make_login_sesstion($email,0);
            }
            else{
                $this->load->view('templates/header');
                $this->parser->parse('users/login_caregiver',$data);
            }
        }

    }
    public function register_resident(){
        $this->load->library('session');
        $Is_loggedIn = $this->session->userdata('logged_in');
        if($Is_loggedIn == 0)
            redirect('Users/login_caregiver');
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('lastname', 'lastname', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('room', 'room', 'required');
        $this->form_validation->set_rules('level', 'level', 'required');
        $this->form_validation->set_rules('Gender','Gender', 'required');
        $this->form_validation->set_rules('language','language', 'required');
        /*Birthdat*/
        $day=$this->input->post('dd');
        $month=$this->input->post('mm');
        $year=$this->input->post('yyyy');
        $data = array(
            "level" => $this->input->post('level'),
            "room" => $room =$this->input->post('room'),
            "name" =>$this->input->post('name'),
            "lastname" =>$this->input->post('lastname'),
            "language" =>$this->input->post('language'),
        );

        foreach ($data as $key => $value) {
            if(empty($value))
                $value = NULL;
        }
        $data['function'] ='register_resident';
        $data['title'] ='Registreer Bewoner';
        if($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_register');
            $this->parser->parse('templates/body_register',$data);
            $this->parser->parse('users/resident_register',$data);
            $this->load->view('templates/footer_table');
        } else {
            // post values
            $level=$this->input->post('level');
            $room =$this->input->post('room');
            $name = $this->input->post('name');
            $lastname = $this->input->post('lastname');
            $birthdate="{$year}-{$month}-{$day}";
            $language=$this->input->post('language');
            $gender=$this->input->post('Gender');

            // insert values in database

            $this->user->createResident(html_escape($name),html_escape($lastname),
                html_escape($level),html_escape($room),html_escape($birthdate),html_escape($gender),html_escape($language));
            $this->session->set_tempdata('create_resident_success','Bewoner is succesvol aangemaakt',10);
            redirect('PageController/table_view');
        }

    }

    public function edit_resident($Id){
        $this->load->library('session');
        $Is_loggedIn = $this->session->userdata('logged_in');
        if($Is_loggedIn == 0)
            redirect('Users/login_caregiver');
        $this->load->model('Database_data');
        $fetch_data = $this->Database_data->fetch_data_resident_profile($Id);
        foreach($fetch_data->result() as $row){
            $data = array(
                'name' => $row->Firstname,
                'lastname'  => $row->Lastname,
                'level'     => $row->Level,
                'room'      => $row->Room,
                'IdResident'=> $row->IdResident
            );
        }
        $data['function'] = "edit_resident/".$Id;
        $data['title'] = "Pas profiel bewoner aan";
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[3]');
        if($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_register');
            $this->parser->parse('templates/body_register',$data);
            $this->parser->parse('users/resident_edit',$data);
            $this->load->view('templates/footer_table');
        } else {
            // post values
            $level=$this->input->post('level',true);
            $room =$this->input->post('room',true);
            $name = $this->input->post('name',true);
            $lastname = $this->input->post('lastname',true);

            // insert values in database
            $this->user->updateResident(html_escape($name),html_escape($lastname),html_escape($level),html_escape($room,$Id));
            redirect('PageController/table_view');
        }

    }
    public function register_caregiver(){
        $this->load->library('session');
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[Caregiver.email]');
        $this->form_validation->set_rules('language','language', 'required');

        $data = array(
            "name" =>$this->input->post('name'),
            "lastname" =>$this->input->post('lastname'),
            "language" =>$this->input->post('language'),
            "email" => $this->input->post('email')
        );

        foreach ($data as $key => $value) {
            if(empty($value))
                $value = NULL;
        }


        if($this->form_validation->run() == FALSE ) {
            $this->load->view('templates/header');
            $this->parser->parse('users/register_caregiver',$data);
        } else {
            // post values
            $ref_code =$this->input->post('nursing_home',true);
            $nursingHome = $this->user->fetch_nursing_home_id($ref_code);
            $name = $this->input->post('name',true);
            $lastname = $this->input->post('lastname',true);
            $email = $this->input->post('email',true);
            $password = $this->input->post('password',true);
            $language = $this->input->post('language',true);
            $this->user->createCaregiver($name,$lastname,$email,$password,$nursingHome,$language);
            $this->session->set_flashdata('caregiver_registered',"Account succesvol aangemaakt, bevestigingsemail word zo snel mogelijk verzonden naar $email ");
            redirect('Users/login_caregiver');
        }
    }
    public function validate_email($email, $email_code){
        $email_code= trim($email_code);
        $validate=$this->user->validate_email($email,$email_code);
        if($validate){
            redirect('PageController/view');
        }
    }
    public function residentPassword() //index ->residentPassword
    {
        $this->load->library('session');

        if($this->session->userdata("language_resident")=='English'){

            $data['end_the_survey'] = 'Home screen';
            $data['go_back'] = 'Go back';
            $data['listen'] = 'Listen to the text';
            $data['confirm']='Confirm';
        }
        else{
            $data['end_the_survey'] = 'Hoofd- menu';
            $data['go_back'] = 'Ga terug';
            $data['listen'] = 'Beluister de tekst';
            $data['confirm']='Bevestig';
        }

        if($this->session->userdata("language_resident")=='English'){
            $data['choose'] = 'Choose four persons as your password';
            $data['confirm_password']='Confirm your password';
            $data['no_match']='First and second password not match';
            $data['choose_4']='You should choose 4 pictures';
            $data['press']='Press the four persons that you have chosen as password';
            $data['incorrect']="The password is incorrect";
        }
        else{
            $data['choose'] = 'Kies vier personen voor uw wachtwoord';
            $data['confirm_password']='Bevestig uw wachtwoord';
            $data['no_match']='Wachtwoorden komen niet overeen';
            $data['choose_4']='U moet 4 afbeeldingen kiezen';
            $data['press']='Druk op de vier personen die u als wachtwoord heeft gekozen';
            $data['incorrect']='Het wacthwoord is onjuist';
        }

        //get firstname and lastname
        $firstName=$this->input->get_post("firstName",true);
        $lastName=$this->input->get_post("lastName",true);

        //if we get name from post
        if($firstName!=null or $lastName!=null){
            //session firstname , lastname
            $this->session->set_userdata("FirstName",$firstName);
            $this->session->set_userdata("LastName",$lastName);
        }

        //or we can get firstname and last name from already set session
        $firstName=$this->session->userdata("FirstName");
        $lastName=$this->session->userdata("LastName");

        $this->load->helper('url');

        //$data['imageName']=$this->user->getImages();

        //Check if user has a password
        $userInfo=$this->IfUserHasPassword($firstName,$lastName);
        $data['Firstname']=$firstName;
        $data['Lastname']=$lastName;

        if($userInfo==0){ //if there is no password, let user to register a password
            $data['IsRegistered']=0;
        }
        else{
            $data['IsRegistered']=2;
        }

        $this->load->view('users/resident_password',$data);
    }

    public function LoginCheck() {
        $this->load->helper('url');
        $this->load->library('session');
        //load and process password from the user
        $typeInPassword = $this->input->get_post('imgName',true);
        $firstName=$this->input->get_post('firstName',true);
        $lastName=$this->input->get_post('lastName',true);
        $IsRegistered=$this->input->get_post('IsRegistered',true);
        $data['Firstname']=$firstName;
        $data['Lastname']=$lastName;

        if($IsRegistered=="0"){
            $this->session->set_userdata('tempPW',$typeInPassword);
            echo '1';
        }
        else if($IsRegistered=="1") //password confirm
        {
            $pwString=$tmp=$this->session->userdata('tempPW');
            $IsCorrect=$this->IsCorrectPassword($pwString,$typeInPassword);
            if($IsCorrect==1){
                $this->UpdateNewPassword($firstName,$lastName,$typeInPassword);
                $this->session->set_userdata('IsUserLoggedIn',1);
                echo '2';
            }
            else{

                echo '3';
            }
        }
        //normal login without registeration
        else{
            $userPW=$this->user->getPasswordResident($firstName,$lastName);//$userPW[0]['Password']
            $IsCorrect=$this->IsCorrectPassword($userPW[0]['Password'],$typeInPassword);
            if($IsCorrect==1){
                $this->session->set_userdata('IsUserLoggedIn',1);

                echo '4';
            }
            else{
                echo '5';
            }
        }


    }

    public function UpdateNewPassword($firstName,$lastName,$typeInPassword){
        $this->user->updatePasswordResident($firstName,$lastName,$typeInPassword);
    }

    public function IsCorrectPassword($typeInPassword,$truePassword){
        return ($typeInPassword==$truePassword);
    }

    public function HashStringToArray($password){
        $passwordArray=explode("%",$password);
        $HashArray=array();

        foreach ($passwordArray as $value){
            array_push($HashArray,md5($value));
        }
        return $HashArray;
    }

    //We need to add id to session later
    //Check if the user has a password, if yes, we get the password, if not return a "0"
    public function IfUserHasPassword($firstName,$lastName){
        //load a model to check the password if exists,
        $result=$this->user->getPasswordResident($firstName,$lastName);
        if($result[0]['Password']==null){

            return 0;
        }
        else{

            return 1;
        }
    }

    public function logout(){
        $this->load->library('session');
        // first keep the nursing home before destroy
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('Email');
        //$this->session->sess_destroy();
        redirect('Users/login_caregiver');
    }
}
