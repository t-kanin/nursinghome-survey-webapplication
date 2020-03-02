<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/feedback.css">
    <script src="<?php echo base_url(); ?>assets/js/Jquery-2.2.2.js"></script>
    <script> let base_url = "<?php echo base_url();?>";</script>
    <title>Language</title>
</head>
<body>

<button class="corner-button" onclick="location.href='<?php echo base_url(); ?>';">
    <strong>Home</strong>
</button>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 header-language" id="header-dutch">
            <h2>Kies uw taal</h2>
        </div>
        <div class="col-md-3 header-language" id="header-english">
            <h2>Choose your language</h2>
        </div>
        <div class="col-md-3 header-language" id="header-french">
            <h2>Choisissez votre langue</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3 language-box" id="language-dutch">
            <img src="<?php echo base_url(); ?>assets/images/nl.png" alt="dutch" class="language-image">
            <span>Nederlands</span>
        </div>
        <div class="col-md-3 language-box" id="language-english">
            <img src="<?php echo base_url(); ?>assets/images/uk.png" alt="english" class="language-image">
            <span>English</span>
        </div>
        <div class="col-md-3 language-box" id="language-french">
            <img src="<?php echo base_url(); ?>assets/images/fr.png" alt="french" class="language-image">
            <span>French</span>
        </div>
    </div>
</div>
<script>
    //click on different flag and give different values to form, then upload form, no ajax hhh

    let DutchButtonElement=document.getElementById("language-dutch");
    let EnglishButtonElement=document.getElementById("language-english");
    let FrenchButtonElement=document.getElementById("language-french");

    EnglishButtonElement.addEventListener('click',function () {
        languageSubmission("English");
    });

    DutchButtonElement.addEventListener('click', function () {
        languageSubmission("Dutch");
    });

    FrenchButtonElement.addEventListener('click',function () {
        languageSubmission("French")
    })

    function languageSubmission(lang) {
        let url=base_url+"FeedbackController/languageSelection";
        $.ajax({
            data:{language:lang},
            type:"POST",
            url:url,
            error:function(msg){
            },
            success:function(msg){
                //alert("sucs" + msg)
                if(msg!=''){
                    sessionStorage.setItem('lang',msg);
                    window.location.href=base_url+'FeedbackController/view/feedback_choose_kind';
                }else{
                    let errormessage="error";
                    alert(errormessage);
                }
            }
        });
    }

</script>

<br><br><br>

    <button onclick="history.back()" class="corner-button">
        <strong>Back</strong>
    </button>


</body>
</html>