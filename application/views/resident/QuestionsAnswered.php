<?
if(isset($_POST['questionNumber']))
{
    $_SESSION['questionNumber']=$_POST['questionNumber'];
}
$questionNumber=$_SESSION['questionNumber'];
?>
<script>var questionNumber=<?echo $questionNumber?>;</script>
<script src="<? echo base_url(); ?>assets/js/category.js" type="text/javascript"></script>
<body>
<div id="content">
    <div id="main">
        <div class="talk-bubble tri-right btm-right-in">
            <div class="talktext">
            <p><?=$questions_answered?></p>
            </div>
        </div>
        <img src="<? echo base_url(); ?>assets/images/talking_plant.gif" alt="Person">
        <div id="buttonGoFurther">
            <button class="button2Clicked" onclick="location.href='<? echo base_url(); ?>Users'"><i class="material-icons">home</i><br><?=$end_the_survey?></button>
        </div>
    </div>
</div>
</body>
</html>