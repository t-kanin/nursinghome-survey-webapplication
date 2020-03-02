<?php
$this->session->set_userdata('continuePossible',1);
?>
<script>
    var answers = [];
    window.sessionStorage.setItem("answers", JSON.stringify(answers));
</script>
<body>
<div id="content">
    <div id="main">
        <div class="talk-bubble tri-right btm-right-in">
            <div class="talktext">
            <p><?= $share_answers?><br><span id="dots"></span><span id="more"><br><?= $share_answers_extra?></span></p>
            <button onclick="readMore()" id="readMore"><?= $read_more?></button>
            </div>
        </div>
        <img src="<? echo base_url(); ?>assets/images/talking_plant.gif" alt="Person">
        <div id="buttonGoFurther" >
            <button class="button2Clicked" onclick="location.href='<? echo base_url(); ?>ResidentController/resident/ifSurveyNotEnded'"><?= $Yes?></button>
            <button class="button2Clicked" onclick="location.href='<? echo base_url(); ?>ResidentController/resident/ifSurveyNotEnded'"><?= $No?></button>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function goBack() {
        window.location.href = base_url + "Users/residentPassword";
    }
    function readMore() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("readMore");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "<? echo $read_more?>";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "<? echo $read_less?>";
            moreText.style.display = "inline";
        }
    }
</script>
