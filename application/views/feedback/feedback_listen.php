<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/feedback.css">
    <script> let base_url = "<?php echo base_url();?>";</script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500|Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <script src="<?php echo base_url(); ?>assets/js/recorder.wav.min.js"></script>
    <title>Feedback</title>
</head>
<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;' class="background-img">


<button class="corner-button" onclick="location.href='<?php echo base_url(); ?>';">
    <strong><?= $home ?></strong>
</button>

<div class="container">
    <div class="row justify-content-center">
        <h1><?= $ear ?></h1>
    </div>

    <div  class="row justify-content-center">
        <div id='listen_button' class="col-md-3">
            <div id="hearing-box" >
                <img src="<?php echo base_url(); ?>/assets/images/ear.png" alt="" class="kind-image">
            </div>
        </div>
        <div class="col-md-6">
            <div class="row ">
                <div id="succesful-box">
                    <span><?= $submit ?></span>
                </div>
            </div>
            <div class="row ">
                <div id="retry-box" onclick="location.href='<?php echo base_url(); ?>FeedbackController/view/feedback_speak';">
                    <span><?= $try_again ?></span>
                </div>
            </div>
        </div>
    </div>


    <script>
        let playRecButton=document.getElementById("listen_button");
        let audio_name=sessionStorage.getItem('audio_name');
        let audio_url=base_url+"assets/audio/"+audio_name;
        let audio=new Audio(audio_url);
        let isAudioPlaying=0;

        function playRec() {
            playRecButton.style.opacity=0.3;
            audio.play();
            isAudioPlaying=1;
            audio.addEventListener('ended',function () {
                playRecButton.style.opacity=1;
                isAudioPlaying=0;
            })
        }

        function pausePlayRec(){
            audio.pause();
            isAudioPlaying=0;
            playRecButton.style.opacity=1;
        }

        playRecButton.addEventListener('click',function () {
            if(isAudioPlaying==0){
                playRec();
            }
            else{
                pausePlayRec();
            }
        });

    </script>


    <script>
        let submitButton=document.getElementById("succesful-box");

        function recordSubmission() {
            //using ajax to upload
            let audio_name=sessionStorage.getItem('audio_name');
            let transcript=sessionStorage.getItem('transcript');

            if(audio_name!=""){
                let xhr=new XMLHttpRequest();
                xhr.open("POST",base_url+"FeedbackController/uploadAudioToDB");
                xhr.onreadystatechange=function(msg){
                    if(xhr.readyState==4 && xhr.status==200){
                        sessionStorage.clear();
                        window.location.href="feedback_complete";
                    }
                }
                let params={'audio_name':audio_name,'transcript':transcript};
                xhr.send(JSON.stringify(params));
            }
        }

        submitButton.addEventListener('click',recordSubmission);


    </script>

</div>

    <button onclick="history.back()" class="corner-button">
        <strong><?= $back ?></strong>
    </button>

</body>
</html>
