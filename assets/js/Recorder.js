//Some Elements from Html
let startRecordButton=document.getElementById("record_start");
let timerElement=document.getElementById("recording_timer");
let endRecorderButton=document.getElementById("end-recording");
let startRecorderText=document.getElementById("message_above_speaking_icon");
let bufferContainer = document.getElementById("bufferContainer");
let resultContainer = document.getElementById("resultContainer");

//Initialize the recorder
let rec=Recorder(
    {
        type:"wav",
        sampleRate:16000,
        bitRate:16,
    });

//Global vars
let timer=null;
let isRecording=0;
let recognition= new webkitSpeechRecognition();
let transcript="";
let language="en";


// Functions
function startRec() {

    //Ask for permission of microphone

    rec.open(function () {
        //start recording

        timerElement.hidden=false;
        endRecorderButton.hidden=false;
        startTimer();
        if(sessionStorage.getItem('lang')=="French"){
            startRecorderText.innerHTML="Nous enregistrons, n'oubliez pas de vous identifier";
            language="fr";
        }
        else if(sessionStorage.getItem('lang')=="Dutch"){
            startRecorderText.innerHTML="We zijn aan het opnemen, vergeet uzelf niet te identificeren";
            language="nl";
        }
        else {
            startRecorderText.innerHTML="We are recording, don't forget to identify yourself";
            language="en";
        }

        rec.start();

        isRecording=1;
    },function(msg,isUserNotAllow){
        //if user declined the request or browser doesnt support
        alert((isUserNotAllow?"User delinced, ":"")+"Is not supported");
    });

    SpeechToText();
}

function stopRec(){
    let success=rec.stop(function (blob, duration) {
        //Upload the audio
        let form=new FormData();
        form.append("audioFile",blob,"recorder.wav");
        //stop timer

        //using ajax to upload
        let xhr=new XMLHttpRequest();
        xhr.open("POST",base_url+"/FeedbackController/uploadToServer");
        xhr.onreadystatechange=function(msg){
            if(xhr.readyState==4 && xhr.status==200){
                isRecording=0;
                recognition.stop();
                let audio_name=xhr.responseText;
                let transcript=bufferContainer.value;
                sessionStorage.setItem('audio_name',audio_name);
                sessionStorage.setItem('transcript',transcript);
                window.location.href=base_url+"FeedbackController/view/feedback_listen";
            }
        }
        xhr.send(form);
        //go to another page

    },function(msg) {
        alert("Recording fail:"+msg);
    });
}

//Timers
function startTimer(){
    clearInterval(timer);
    let n=0;
    timer=setInterval(function () {
        n++;
        let m=parseInt(n/60);
        let s=parseInt(n%60);
        timerElement.innerHTML=toDub(m)+":"+toDub(s);
    },1000);
}


//pause
function pauseTimer(){
    clearInterval(timer);
    timer=null;
}

//clear timer
function clearTimer(){
    timerElement.value="00:00";
}


//zero padding
function toDub(n){
    return n<10?"0"+n:""+n;
}

//Speech recognition
function SpeechToText(){
    if ('webkitSpeechRecognition' in window) {
    }
    else{
        alert("SpeechRecognition not supported on this browser");
    }

    //STT Settings
    if(language==="en"){
        recognition.lang="en-GB";
    }
    else if(language==="nl"){
        recognition.lang="nl-NL";
    }
    else if(language==="fr"){
        recognition.lang="fr-FR";
    }
    //language setting
    if(sessionStorage.getItem('lang')!=""){
        recognition.lang=sessionStorage.getItem('lang');
    }

    recognition.continuous = true;
    recognition.interimResults = true;

    //create two html buffers to store transcript

    bufferContainer.value=" ";
    resultContainer.value=" ";

    recognition.onresult=function (event) {
        console.log(event);

        let resultList = event.results;
        for (let i = 0; i < resultList.length; i++){
            let result = resultList.item(i);
            try{
                let alternative = result.item(0);
                //let text = convertToPunctuation(alternative.transcript);
                bufferContainer.value = resultContainer.value + alternative.transcript;
            } catch (ex){
                console.log(ex);
            }
            if (result.isFinal){
                this.stop();
                break;
            }
        }
    }

    recognition.addEventListener("end", function(){
        resultContainer.value = bufferContainer.value;
        if (isRecording!=0){
            this.start();
        }
    });
    recognition.start();
}


//Event listener
startRecordButton.addEventListener('click',function () {
    if(!isRecording){
        startRec();
    }
});
endRecorderButton.addEventListener('click', function () {
    pauseTimer();
    setTimeout(stopRec,2000);
});
