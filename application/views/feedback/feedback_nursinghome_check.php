<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/feedback.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Feedback</title>
</head>
<body>
<button class="corner-button" onclick="location.href='<?php echo base_url(); ?>';">
    <strong><?= $home ?></strong>
</button>

<div class="container">
<div class="row">

    <div class="col-md-12">
        <div class="talk-bubble tri-right btm-right-in">
            <div class="talktext">
                <h3> <?= $plant_talk ?></h3>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <button onclick="location.href='<?php echo base_url(); ?>FeedbackController/view/feedback_choose_kind';" class="correctness">
            <strong><?= $yes ?></strong>
        </button>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <button onclick="location.href='<?php echo base_url(); ?>NursingHome/index';" class="correctness">
            <strong><?= $no ?></strong>
        </button>
    </div>

    <div class="col-md-4">
        <div>
            <img src="<?php echo base_url(); ?>assets/images/talking_plant.gif" alt="talking plant" id="daisy">
        </div>
    </div>
</div>
</div>


<button onclick="history.back()" class="corner-button">
    <strong> <?= $back ?></strong>
</button>




</body>
</html>
