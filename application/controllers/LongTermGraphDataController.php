<?php

$this->db->select('IdCategory');
$this->db->from('Question');
$queryCat = $this->db->get();

$result = array();
$arraychecker = array();
//array_push($result, "apple", 1);
/*foreach ($result as $row1) {
    echo $row1, "<br>";
}*/

$amountOfDays = 100;
$dateArray = array();
$dateStringArray = array();
$dayCounter = 1;
$currentCat = 1;
$questionsPerCatCounter = 0;
$questionID = 1;
$sum = 0;
$average=0;
$answersPerQuestionCounter = 0;
$catSum=0;

for($i=1; $i<=$amountOfDays; $i++){
    if($i == 1){
        array_push($dateArray, strtotime("today"));
    }
    else {
        array_push($dateArray, strtotime("-" . strval($dayCounter) . " days"));
        $dayCounter++;
    }
}
foreach ($dateArray as $item) {
    array_push($dateStringArray, strval(date("Y-m-d", $item)));
}


foreach($dateArray as $day) {
    foreach ($queryCat->result() as $cat) {
        //echo "Cat ",$cat->IdCategory, ", QuestionID = ", $questionID, "<br>";
        if($currentCat != $cat->IdCategory){
            if($catSum!=0){
                //echo "Catsum = ", $catSum, " and questions per cat = ", $questionsPerCatCounter, "<br>";
            }

            if($questionsPerCatCounter != 0){
                $average = $catSum / $questionsPerCatCounter;
            }
            else{
                $average = $catSum / 1;
            }

            $questionsPerCatCounter=0;

            //echo "<br>";
            //echo "currentCat = ", $currentCat, ", day is: ", strval(date("Y-m-d", $day)), ", average is: ", $average, "<br>";
            //echo "<br>";
            array_push($result,$average);
            $string = "Category " . strval($currentCat);
            array_push($arraychecker, $string);
            $catSum=0;

            $currentCat =$cat->IdCategory;
        }
        if($currentCat == $cat->IdCategory){
            $questionsPerCatCounter++;
            $this->db->select('Content');
            $this->db->select('Timestamp');
            $this->db->from('Answer');
            $this->db->where('IdQuestion = ', $questionID);
            $this->db->where('Timestamp != ', null);
            $queryAnswerContent = $this->db->get();

            foreach ($queryAnswerContent->result() as $row2) {
                $string = strval($row2->Timestamp);
                $array = str_split($string, 10);
                $element = $array[0];
                //echo "Date to check for: ", strval(date("Y-m-d", $day)), " current date: ", $element, " questionID: ", $questionID, " with cat: ", $currentCat, "<br>";
                if (strval($element) == strval(date("Y-m-d", $day))) {
                    $sum = $sum + $row2->Content;
                    $answersPerQuestionCounter++;
                    //echo "success", "<br>";
                    //echo "currentCat = ", $currentCat, ", day is: ", strval(date("Y-m-d", $day)), ", content: ", $row2->Content, ", IDQUESTION is: ", $questionID , ", answersperquestion = ", $answersPerQuestionCounter, "<br>";
                }
            }
            if($answersPerQuestionCounter != 0){
                $sum = $sum/$answersPerQuestionCounter;
            }
            else{
                $sum = $sum/1;
            }
            $answersPerQuestionCounter =0;
            $catSum = $catSum + $sum;
            //echo "CatSum: ", $catSum, "<br>";
            $sum=0;
        }

        //echo "questionID = ", $questionID, "<br>";
        $questionID++;
    }
    $questionID = 1;
}
array_push($result,0);
array_push($result,0);

$data['result'] = $result;
$data['dateArray'] = $dateArray;
$data['arraychecker'] = $arraychecker;
$this->load->view('statistic/longtermgraph', $data);