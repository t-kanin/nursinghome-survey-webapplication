<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/caregiver_home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>{title}</title>
</head>
<body style="background-color: #F5F8ED">
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1; opacity: 0.5;'>

<div class="container">
    <div class="row justify-content-around" id="buttons">
        <div class="col-md-3" id="button">
            <form action='<?php echo base_url(); ?>PageController/statistic'>
                <div class="circle">
                    <input type="image" name="statistics_button" src="<?php echo base_url(); ?>assets/images/loop.png"  alt="statistic" style="width:102%">
                </div>
            </form>
            <p id="button_caption"><strong>Statistieken</strong></p>
        </div>
        <div class="col-md-3" id="button">
            <form action='<?php echo base_url(); ?>PageController/table_view/questionnaire_editor'>
                <div class="circle">
                    <input type="image" name="questionnaire_editor_button" src="<?php echo base_url(); ?>assets/images/questionnaire_black.png"  alt="questionnaire" style="width:100%">
                </div>
            </form>
            <p id="button_caption"><strong>Vragenlijst</strong></p>
        </div>
        <div class="col-md-3" id="button">
            <form action='<?php echo base_url(); ?>PageController/table_view/Notification'>
                <div class="circle">
                    <input type="image" name="notifications_button" src="<?php echo base_url(); ?>assets/images/bel.png"  alt="Notification" style="position:absolute;width:95%; left:7%; top:-9%">
                </div>
            </form>
            <p id="button_caption"><strong>Notificaties</strong></p>
        </div>
    </div>
    <div class="row justify-content-around" id="buttons">
        <div class="col-md-3" id="button">
            <form action='<?php echo base_url(); ?>PageController/table_view/Feedback'>
                <div class="circle">
                    <input type="image" name="feedback_button" src="<?php echo base_url(); ?>assets/images/feedback_icon.png"  alt="Feedback" style="position:absolute;width:110%; left:-8%; top:13%;">
                </div>
            </form>
            <p id="button_caption"><strong>Feedback</strong></p>
        </div>
        <div class="col-md-3" id="button">
            <form action='<?php echo base_url(); ?>PageController/table_view'>
                <div class="circle">
                    <input type="image" name="residents_button" src="<?php echo base_url(); ?>assets/images/residents_green.png"  alt="Resident" style="position:absolute;width:50%; left:23%; top:16%">
                </div>
            </form>
            <p id="button_caption"><strong>Bewoners</strong></p>
        </div>
        <div class="col-md-3" id="button">
            <form action='<?php echo base_url(); ?>PageController/table_view/Setting'>
                <div class="circle">
                    <input type="image" name="settings_button" src="<?php echo base_url(); ?>assets/images/settings.png"  alt="Setting" style="position:absolute;filter: invert(98%) sepia(91%) saturate(2%) hue-rotate(195deg) brightness(108%) contrast(100%);;width:60%;top:10%;left:15%">
                </div>
            </form>
            <p id="button_caption"><strong>Instellingen</strong></p>
        </div>
    </div>
</div>


<footer>
    <form action="<?php echo base_url(); ?>">
        <button type="button" id="logout_button" class="logout" onclick="location.href='<?php echo base_url(); ?>Users/logout'"><strong>Uitloggen</strong></button>
    </form>
</footer>

</body>
</html>
