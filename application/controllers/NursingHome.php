<?php
class NursingHome extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->model('Database_data');
        $this->load->library('session');
    }

    public function index($page = 'nursinghome')
    {
        $data = array();
        $data['n_home'] =$this->session->userdata('NursingHome');
        $data['fetch_data'] = $this->Database_data->fetch_data('NursingHome');
        $data['title'] = ucfirst($page);
        $this->load->view('pages/'.$page, $data);
    }

    public function set_nursingHome(){
        $nursingHome = $this->input->get_post('NursingHome');
        $this->session->set_userdata('NursingHome',$nursingHome);
        echo "success";;
    }
}