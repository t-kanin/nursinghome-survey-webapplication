<?php
$this->session->set_userdata(Array("MTOR"=>1,"MTON"=>1));
?>

<body>
<div id="content">
    <div id="main">
            <div class="talk-bubble tri-right btm-right-in">
                <div class="talktext">
                <p class="daisy_introduction"><?=$hi?></p>
                    <p class="daisy_introduction"> <?=$identify?>
                    <br class="daisy_introduction"> <?=$privacy?>
                <br class="daisy_introduction"> <?=$answer_questions?></p>

                </div>
            </div>
        <img src="<? echo base_url(); ?>assets/images/talking_plant.gif" alt="Person">
        <div id="buttonGoFurther">
            <form method="post" action="<?php echo base_url(); ?>Users/login_resident/resident_login_floor">
                <input class="button2Clicked" type="submit" value="<?=$start?>" />
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function goBack() {
        window.location.href = base_url + "Users";
    }
</script>
