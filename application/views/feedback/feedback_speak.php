<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/feedback.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500|Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <script> let base_url = "<?php echo base_url();?>";</script>
    <script src="<?php echo base_url(); ?>assets\js\recorder-lib.js"></script>
    <title>Feedback</title>
</head>
<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;' class="background-img">

<textarea  id="bufferContainer" rows="1" cols="1" readonly="readonly" style="display:none;"></textarea>
<textarea  id="resultContainer" rows="1" cols="1" style="display:none;"></textarea>

<button class="corner-button" onclick="location.href='<?php echo base_url(); ?>';">
    <strong><?= $home ?></strong>
</button>


<div class="container">
    <div class="row justify-content-center">
        <h1 id="message_above_speaking_icon"><?= $microphone ?></h1>
    </div>

    <div id='record_start' class="row justify-content-center">
        <div class="option_box">
            <img src="<?php echo base_url(); ?>assets/images/microphone.png" alt="" class="kind-image">
        </div>
    </div>

    <div class="row justify-content-center">
        <h2 hidden="true" id="recording_timer">00:00</h2>
    </div>

    <div class="row justify-content-center">
        <button hidden="true" id="end-recording">
            <?= $endrecording ?>
        </button>
    </div>

</div>

<br><br>
<button onclick="history.back()" class="corner-button">
    <strong><?= $back ?></strong>
</button>

<script src="<?php echo base_url(); ?>assets\js\recordApp.js"></script>
</body>
</html>