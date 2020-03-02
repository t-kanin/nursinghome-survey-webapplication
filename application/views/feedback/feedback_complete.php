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

<br><br><br><br>

<div class="container">
    <div class="row justify-content-center">
        <h1><?= $confirm_message ?></h1>
    </div>

    <br>

    <div class="row justify-content-center">
        <button id="submit-feedback" onclick="location.href='<?php echo base_url(); ?>';"><strong>OK</strong></button>
    </div>
</div>
</body>
</html>
