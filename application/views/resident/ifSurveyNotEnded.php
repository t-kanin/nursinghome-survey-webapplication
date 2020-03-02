<?php
/**
    You can't continue when:
        -You never filled in the questionnaire
        -You answered last question
    If you continue then:
        -You jump to the last question answered.
        -Answers that are still changeable will show up.
            (-To prevent spamming residents cannot give new answers continuously
            if new answer is given they will overwrite their previous answer)
**/
?>
<script>
    var answers = [];
    window.sessionStorage.setItem("answers", JSON.stringify(answers));
</script>
<?php
$this->session->set_userdata('questionNumber',0);

$id=$this->session->userdata('id');
//get id from the last Question
$sql="SELECT IdQuestion FROM a19ux3.Question ORDER BY IdQuestion DESC;";
$result = $this->db->query($sql);
$lastQuestion=($result->result())[0]->IdQuestion;

//get id from last question answered and decide if you want to skip this page
$sql="SELECT IdQuestion FROM a19ux3.Answer WHERE IdAnswer=(SELECT MAX(IdAnswer) FROM a19ux3.Answer WHERE IdResident=$id)";
$result = $this->db->query($sql);
if ($result->num_rows() > 0) {
    $lastQuestionAnswered = ($result->result())[0]->IdQuestion;
    if ($lastQuestion == $lastQuestionAnswered) {
        $this->session->set_userdata('continuePossible',0);
        header("Location: " . base_url() . "ResidentController/resident/Category");
    }
}
else{
    $this->session->set_userdata('continuePossible',0);
    header("Location: " . base_url() . "ResidentController/resident/Category");
}

//get id from last questions answered in the last 6 hours and the answers
$sql="SELECT IdQuestion,Content FROM a19ux3.Answer WHERE IdResident=$id AND Timestamp>DATE_SUB(NOW(),INTERVAL 6 HOUR) ORDER BY IdAnswer ASC;";
$result = $this->db->query($sql);
$answersPrevious=array();
$questionsAnsweredPrevious=array();
if ($result->num_rows() > 0) {
    foreach($result->result() as $row){
        array_push($questionsAnsweredPrevious,$row->IdQuestion);
        array_push($answersPrevious,$row->Content);
    }
}
?>

<script>

    <?php
        $js_array = json_encode($questionsAnsweredPrevious);
        echo "var questionsAnsweredPrevious = ". $js_array . ";\n";
        $js_array = json_encode($answersPrevious);
        echo "var answersPrevious = ". $js_array . ";\n";
    ?>
</script>
<script src="<? echo base_url(); ?>assets/js/category.js" type="text/javascript"></script>
<body>
<div id="content">
    <div id="main">
        <div class="talk-bubble tri-right btm-right-in">
            <div class="talktext">
            <p><?=$continue?></p>
            </div>
        </div>
        <img src="<? echo base_url(); ?>assets/images/talking_plant.gif" alt="Person">
        <div id="buttonGoFurther">
            <div id="button">
                <button class="button2Clicked" onclick='getAnswers()'><?=$Yes?></button>
                <button class="button2Clicked" onclick="location.href='<? echo base_url(); ?>ResidentController/resident/Category'"><?=$No?></button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function getAnswers(){
        for(var i=0; i<<?echo $lastQuestion?>;i++){
            answers[i]="error"
        }
        for(var i=0;i<questionsAnsweredPrevious.length;i++) { //different loop, bcs otherwise changeable answers will not show up after lastQuestion answered
            //TODO/ make sure first answer is the same as first question. Now it's not a problem bcs they ordered from 1-61 correctly
            answers[questionsAnsweredPrevious[i]-1]=answersPrevious[i];
        }

        window.sessionStorage.setItem("answers", JSON.stringify(answers));
        post(base_url + "ResidentController/resident/Category", {questionNumber: <? echo $lastQuestionAnswered?>});
    }
    function goBack() {
        window.location.href = base_url + "ResidentController/resident/privacy";
    }
</script>


