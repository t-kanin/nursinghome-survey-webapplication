<?php
$this->session->set_userdata('language_resident',"Dutch");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/home.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Home</title>

</head>
<body>
<div class="homepage">
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1; opacity: 0.5;'>

    <div class="nursinghome" onclick="location.href='<?php echo base_url(); ?>NursingHome/index';">
        <button><strong>{NursingHome}</strong></button>
        <p class="instruction">Not correct? Click here</p>
    </div>

    <div class="logins">
        <div id="identitybox" class ="resident" onclick="location.href='<?php echo base_url(); ?>Users/login_resident';">
            <img class="login_img" src="<?php echo base_url(); ?>assets/images/grandparents.png" alt="">
            <p class="heading">Ik ben een bewoner</p>
            <p>I am a resident</p>
            <p>Je suis un résident</p>
        </div>
        <div id="identitybox" class="caregiver" onclick="location.href='<?php echo base_url(); ?>Users/login_caregiver';">
            <img class="login_img" src="<?php echo base_url(); ?>assets/images/nurse.png" alt="">
            <p class="heading">Ik ben een verzorger</p>
        </div>
    </div>
    <div class="feedback">
        <div class="feedback_grid" id="feedbackbox" onclick="location.href='<?php echo base_url();?>FeedbackController/view/language';">
            <img class="feedback_img" src="<?php echo base_url(); ?>assets/images/care.png"/>
            <div class="feedback_text">
                <p class="heading">Ik wil feedback geven</p>
                <p>I want to give feedback <p>
                <p>Je veux donner des commentaires</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>