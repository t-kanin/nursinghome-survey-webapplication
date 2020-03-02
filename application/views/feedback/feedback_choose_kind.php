<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/feedback.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500|Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <title>Feedback</title>
    <script> var base_url = "<?php echo base_url();?>";</script>
</head>
<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;' class="background-img">

<button class="corner-button" onclick="location.href='<?php echo base_url(); ?>';">
    <strong><?= $home ?></strong>
</button>

<div class="container">
    <div class="row justify-content-center">
        <h1><?= $how_question ?></h1>
    </div>

    <div class="row justify-content-center">
        <div class="option_box" onclick="location.href='<?php echo base_url(); ?>FeedbackController/view/feedback_speak';">
            <img src="<?php echo base_url(); ?>assets/images/speak.png" alt="speak" class="kind-image">
            <span class="kind"><?= $speaking ?></span>
        </div>
        <div class="option_box" onclick="location.href='<?php echo base_url(); ?>FeedbackController/view/feedback_type';">
            <img src="<?php echo base_url(); ?>assets/images/type.png" alt="type" class="kind-image">
            <span class="kind"><?= $typing ?></span>
        </div>
    </div>

    <br><br>
</div>

<button onclick="history.back()" class="corner-button">
    <strong> <?= $back ?></strong>
</button>
</body>
</html>
