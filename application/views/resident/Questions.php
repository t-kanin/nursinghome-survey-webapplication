<?php
$id=$this->session->userdata('id');
$language=$this->session->userdata('language_resident');
$Is_loggedIn=$this->session->userdata("IsUserLoggedIn");
if($Is_loggedIn == 0)
    redirect('Users/index');

if(isset($_POST['questionNumber']))
{
    $this->session->set_userdata('questionNumber',$_POST['questionNumber']);
}
$questionNumber=$this->session->userdata('questionNumber');

//find all the IdCategories and IdQuestionContents in the table question ordered.
$sql="SELECT IdCategory,IdQuestion FROM a19ux3.Question ORDER BY IdCategory,IdQuestion";
$result = $this->db->query($sql);
$total_data= $result->num_rows();
$IdCategories=array();
$IdQuestions=array();
if ($result->num_rows() > 0) {
    foreach ($result->result() as $row) {
        array_push($IdCategories, $row->IdCategory);
        array_push($IdQuestions,$row->IdQuestion);
    }
}

//find the content from idQuestionContents
$questionContents=array();
$audioNames=array();
foreach($IdQuestions as $IdQuestion){
    $sql="SELECT Content,AudioName FROM a19ux3.QuestionContent WHERE Language='$language' AND IdQuestion='$IdQuestion';";
    $result = $this->db->query($sql);
    if($result->num_rows()>0){
        array_push($questionContents, ($result->result())[0]->Content);
        array_push($audioNames, ($result->result())[0]->AudioName);
    }
    else{
        array_push($questionContents,"empty");
    }
}

//find the questionNumbers of the previous and next category
$questionNumberNextCategory=$questionNumber;
while($IdCategories[$questionNumberNextCategory]==$IdCategories[$questionNumber]){
    $questionNumberNextCategory++;
    if($questionNumberNextCategory>=$total_data){break;}
}
$questionNumberPreviousCategory=$questionNumber;
while($IdCategories[$questionNumberPreviousCategory]==$IdCategories[$questionNumber]){
    $questionNumberPreviousCategory--;
    if($questionNumberPreviousCategory<0){break;}
}
?>
<script>
    <?
        $temp= json_encode($audioNames);
        echo "var audioNames = ". $temp . ";\n";
    ?>
</script>

<script> var base_url = "<?php echo base_url();?>";</script>
<script src="<? echo base_url(); ?>assets/js/navigation.js" type="text/javascript"></script>
<script>
    function myFunction(id) {
        var emojis= document.getElementById("emojis").children;
        for(var i=0;i<emojis.length;i++) {
            emojis[i].className = "emoji";
        }
        id.className="emojiClicked";
        document.getElementById("button").children[0].className="button2Clicked";
        document.getElementById("button").children[0].disabled=false;
    }
    function showCurrentAnswer(){
        var answer=(JSON.parse(sessionStorage.getItem("answers")))[questionNumber];
        if(answer<=5) {
            myFunction((document.getElementById("emojis").children)[5 - answer]);
        }
    }
    function playRec() {
        let audio_url=base_url+"assets/QuestionAudio/"+audioNames[questionNumber]+".m4a";
        let audio=new Audio(audio_url);
        audio.volume = 1;
        audio.play();
    }
    function changeDaisy(id){
        id.src="<? echo base_url(); ?>assets/images/Daisy/Face<?php echo intval(10*$questionNumber/$total_data)+1;?>Boop.gif";
        setTimeout(changeBack, 3000)
    }
    function changeBack(){
        document.getElementById("DaisyInQuestionnaire" ).src="<? echo base_url(); ?>assets/images/Daisy/Face<?php echo intval(10*$questionNumber/$total_data)+1;?>_Default.gif";
    }
</script>

<script src="<? echo base_url(); ?>assets/js/Jquery-2.2.2.js" type="text/javascript"></script>
<script src="<? echo base_url(); ?>assets/js/Jquery.md5.js" type="text/javascript"></script>
<script>var questionNumber=<?echo $questionNumber?>;</script>
<script>var questionNumberNextCategory=<?echo $questionNumberNextCategory?>;</script>
<script>var questionNumberPreviousCategory=<?echo $questionNumberPreviousCategory?>;</script>
<script>var total_data=<?echo $total_data?>;</script>
<script>var question="<?echo $question?>"</script>
<script>var from="<?echo $from?>"</script>
<script>var the="<?echo $the?>"</script>
<script>var questions="<?echo $questions?>"</script>
<script src="<? echo base_url(); ?>assets/js/Questions.js" type="text/javascript"></script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>assets/css/updated_resident.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/0768bf6c67.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Questionnaire</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div id="myProgress">
                <h4 class="bar" id="myBar">&nbsp<?=$question?>&nbsp<?echo$questionNumber+1?>&nbsp<?=$from?>&nbsp<?=$the?>&nbsp<?echo$total_data?>&nbsp<?=$questions?></h4>
            </div>
            <div>
                <h1 id="contentQuestion"><?echo$questionContents[$questionNumber]?></h1>
            </div>
        </div>
        <div class="col-md-3 ">
            <button onclick="endSurvey('<?echo base_url()?>Users/index/')" class="side-button"><i class="material-icons" style="font-size: 45px">home</i><br><?=$end_the_survey?></button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="emojis" id="emojis">
                <button id="laugh" value=5 onclick='myFunction(this)' class="emoji">
                    <i class="far fa-laugh fa-4x"></i><br>
                    <h5 class="button-text"><?=$always?></h5>
                </button>
                <button id="smile" value=4 onclick='myFunction(this)' class="emoji">
                    <i class="far fa-smile fa-4x"></i><br>
                    <h5><?=$mostly?></h5>
                </button>
                <button id="meh" value=3 onclick='myFunction(this)' class="emoji">
                    <i class="far fa-meh fa-4x"></i><br>
                    <h5><?=$sometimes?></h5>
                </button>
                <button id="frown" value=2 onclick='myFunction(this)' class="emoji">
                    <i class="far fa-frown fa-4x"></i><br>
                    <h5><?=$rarely?></h5>
                </button>
                <button id="angry" value=1 onclick='myFunction(this)' class="emoji">
                    <i class="far fa-angry fa-4x"></i><br>
                    <h5><?=$never?></h5>
                </button>
                <button id="times" value=0 onclick='myFunction(this)' class="emoji">
                    <i class="fas fa-times fa-4x"></i><br>
                    <h5><?=$no_answer?></h5>
                </button>
            </div>
        </div>
        <div class="col-md-3">
            <button onclick="goBack()" class="side-button"><i class="material-icons" style="font-size: 45px">arrow_back</i><br><?=$go_back?></button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="submit-button-div">
                <div id="button" >
                    <input disabled class="button2" type="submit" value="<?=$confirm?>" onclick="getNextContent()">
                    <input type='hidden' value='<?echo $id?>'>
                </div>
            </div>
            <div id="contentQuestions">
                <?php
                foreach($questionContents as $content){
                    echo "<input type='hidden' value='$content'>";
                }
                ?>
            </div>
            <div id="idQuestion">
                <?php
                foreach($IdQuestions as $value){
                    echo "<input type='hidden' value='$value'>";
                }
                ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="daisy-questionnaire-div">
                <img onclick="changeDaisy(this)" id="DaisyInQuestionnaire" src="<? echo base_url(); ?>assets/images/Daisy/Face<?php echo intval(10*$questionNumber/$total_data)+1;?>_Default.gif" alt="Person">
            </div>

        </div>
        <div class="col-md-3">
            <button onclick="playRec()" class="side-button"><i class="material-icons" style="font-size: 45px">play_arrow</i><br><?=$listen?></button>
        </div>
    </div>
    <script>progressBarVisualisationNext()</script>
    <script>showCurrentAnswer()</script>
</div>
</body>
</html>
