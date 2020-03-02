<?php

/*combine the two feedback and audio because its only 2 line of code in each model */
class Feedback extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function updateToFeedback($audioArray){
        return $this -> db -> insert('a19ux3.Feedback', $audioArray);
    }

    public function audioUpdate($audioArray){
        return $this -> db -> insert('a19ux3.Feedback', $audioArray);
    }

}

