<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/feedback.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500|Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <script src="<?php echo base_url(); ?>assets/js/Jquery-2.2.2.js"></script>
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
        <h1><?= $question ?></h1>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <textarea class="form-control rounded-0" id="identification-box" rows="1" placeholder="<?= $placeholder_identification ?>" maxlength="30"></textarea>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <textarea class="form-control rounded-0" id="feedback-box" rows="10" placeholder="<?= $placeholder_feedback ?>" maxlength="500"></textarea>
        </div>
        <div class="col-md-3"></div>
    </div>


    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="button" id="submit-feedback"><strong><?= $submit ?></strong></button>
        </div>
        <div class="col-md-3"></div>
    </div>

    <script>
        let feedbackContent=document.getElementById("feedback-box");
        let submitButton=document.getElementById("submit-feedback");

        function updateToDB() {
            let feedback=feedbackContent.value;
            $.ajax({
                data:{text:feedback},
                type:"POST",
                url:base_url+"FeedbackController/updateToDB",
                error:function(msg){
                },
                success:function(msg){
                    //alert("sucs" + msg)
                    if(msg!=''){

                        // redirect to another page
                        window.location.replace("feedback_complete");

                    }else{
                        let errormessage="error";
                        alert(errormessage);
                    }
                }
            });
        }

        submitButton.addEventListener('click',updateToDB)
    </script>

    <br>
</div>


<button type="button" onclick="history.back()" class="corner-button">
    <Strong><?= $back ?></Strong>
</button>

</body>
</html>
