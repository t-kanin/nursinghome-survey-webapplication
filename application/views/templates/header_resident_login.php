<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>assets/css/resident_login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/0768bf6c67.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <title>Questionnaire</title>
</head>
<body>
<div id="nav">
    <button onclick="endSurvey('<?echo base_url()?>Users/index/')" class="button1"><i class="material-icons">home</i><br><?= $end_the_survey ?></button>
    <button onclick="goBack()" class="button1"><i class="material-icons">arrow_back</i><br><?= $go_back?></button>
</div>
</body>
<script> var base_url = "<?php echo base_url();?>";</script>
<script src="<? echo base_url(); ?>assets/js/navigation.js" type="text/javascript"></script>

