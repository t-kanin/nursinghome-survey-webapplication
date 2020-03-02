<?php
$this->db->select('IdCategory');
$this->db->from('Question');
$queryCat = $this->db->get();

$resultArray = array(0,0,0,0,0,0,0,0,0,0,0);
$oldResultArray = array(0,0,0,0,0,0,0,0,0,0,0);
$resultChangeArray = array(0,0,0,0,0,0,0,0,0,0,0);

$currentCat = 1;
$questionID = 1;
$sum = 0;
$sum2 = 0;
$catSum = 0;
$catSum2 = 0;
$questionsPerCatCounter = 0;
$answersPerQuestionCounter = 0;
$answersPerQuestionCounter2 = 0;
$result1 = 0;


$d=strtotime("-1 Week");
$startdate = date("d/m/Y h:i:sa", $d);
$d=strtotime("now");
$enddate = date("d/m/Y h:i:sa", $d);
$d=strtotime("-2 weeks");
$lastWeekDate = date("d/m/Y h:i:sa", $d);

$dateparser = strtotime("today");
$dateparser2 = strtotime("-1 week");
//echo strval(date("Y-m-d", $dateparser2)) , "<br>";
foreach($queryCat->result() as $row1){

    if($currentCat == $row1->IdCategory){
        $questionsPerCatCounter++;
        $this->db->select('Content');
        $this->db->select('Timestamp');
        $this->db->from('Answer');
        $this->db->where('IdQuestion = ', $questionID);
        $this->db->where('Timestamp != ', null);
        if($isProfile){
            $IdResident = element('IdResident',$Profile);
            $this->db->where('IdResident = ', $IdResident);
        }

        $queryAnswerContent = $this->db->get();

        foreach($queryAnswerContent->result() as $row2){
            //FOR THIS WEEK
            for($i=1; $i<=7; $i++){
                $string = strval($row2->Timestamp);
                $array = str_split($string, 10);
                $element = $array[0];
                if(strval($element) == strval(date("Y-m-d", $dateparser))){
                    $sum = $sum + $row2->Content;
                    $answersPerQuestionCounter++;
                }
                $dateparser = strtotime("-1 day", $dateparser);

            }
            $dateparser = strtotime("today");

            //FOR LAST WEEK
            for($i=1; $i<=7; $i++){
                $string = strval($row2->Timestamp);
                $array = str_split($string, 10);
                $element = $array[0];
                if(strval($element) == strval(date("Y-m-d", $dateparser2))){
                    $sum2 = $sum2 + $row2->Content;
                    $answersPerQuestionCounter2++;
                }
                $dateparser2 = strtotime("-1 day", $dateparser2);
            }
            $dateparser2 = strtotime("-1 week");


        }
        if($answersPerQuestionCounter != 0){
            $sum = $sum/$answersPerQuestionCounter;
        }
        else{
            $sum = $sum/1;
        }
        if($answersPerQuestionCounter2 != 0){
            $sum2 = $sum2/$answersPerQuestionCounter2;
        }
        else{
            $sum2 = $sum2/1;
        }

        $answersPerQuestionCounter =0;
        $answersPerQuestionCounter2 =0;
        $catSum = $catSum + $sum;
        $sum=0;

        $catSum2 = $catSum2 + $sum2;
        $sum2=0;

    }
    else{
        if($questionsPerCatCounter != 0){

            $average = $catSum / $questionsPerCatCounter;
            $average2 = $catSum2 / $questionsPerCatCounter;
        }
        else {
            $average = $catSum / 1;
            $average2 = $catSum2 / 1;
        }

        $resultArray[$currentCat-1] = $average;
        $oldResultArray[$currentCat-1] = $average2;
        $resultChangeArray[$currentCat-1] = $average - $average2;


        $sum = 0;
        $sum2 = 0;
        $catSum=0;
        $catSum2=0;
        $questionsPerCatCounter = 0;
        $currentCat =$row1->IdCategory;
    }
    $questionID++;
}

function checkCategory($catToCheck){
}

?>

<?php
// To print out the date on the title
$string = strval($startdate);
$array = str_split($string, 10);
$element = $array[0];

$string = strval($enddate);
$array = str_split($string, 10);
$element2 = $array[0];

$showingDate = strval($element)." - ".strval($element2);
?>

<?php
// To change color of bars
$barColorArray = array(checkColorChange($resultArray[0]), checkColorChange($resultArray[1]),
    checkColorChange($resultArray[2]),checkColorChange($resultArray[3]),checkColorChange($resultArray[4]),
    checkColorChange($resultArray[5]),checkColorChange($resultArray[6]),checkColorChange($resultArray[7]),
    checkColorChange($resultArray[8]),checkColorChange($resultArray[9]),checkColorChange($resultArray[10]));


function checkColorChange($resultArg){
    if($resultArg >= 0 && $resultArg<1){
        $barColor = "color: rgb(237, 22, 0)";
    }
    else if($resultArg >= 1 && $resultArg<2){
        $barColor = "color: rgb(255, 163, 0)";
    }
    else if($resultArg >= 2 && $resultArg<3){
        $barColor = "color: rgb(247, 229, 0)";
    }
    else if($resultArg >= 3 && $resultArg<4){
        $barColor = "color: rgb(160, 220, 0)";
    }
    else if($resultArg >= 4 && $resultArg<=5){
        $barColor = "color: rgb(24, 176, 0)";
    }
    else{
        $barColor = "color: rgb(0, 0, 0)";
    }
    return $barColor;
}
?>

<?php

$data['showingDate'] = $showingDate;
$data['resultArray'] = $resultArray;
$data['oldResultArray'] = $oldResultArray;
$data['resultChangeArray'] = $resultChangeArray;
$data['barColorArray'] = $barColorArray;

if($isProfile){
    $data['IdResident'] = $IdResident;
    $this->parser->parse('pages/resident_profile',$data);
}
else {
    $this->load->view('statistic/statistics', $data);
}
?>