//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

let timer=null;
let isRecording=0;
let recognition= new webkitSpeechRecognition();
let language=sessionStorage.getItem('lang');
let transcript="";

let gumStream; 						//stream from getUserMedia()
let rec; 							//Recorder.js object
let input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb.
let AudioContext = window.AudioContext || window.webkitAudioContext;
let audioContext //audio context to help us record

let recordButton=document.getElementById("record_start");
let stopButton = document.getElementById("end-recording");
let timerElement=document.getElementById("recording_timer");
let bufferContainer = document.getElementById("bufferContainer");
let resultContainer = document.getElementById("resultContainer");
let startRecorderText=document.getElementById("message_above_speaking_icon");

//add events to those 2 buttons
recordButton.addEventListener("click", function () {
    if(!isRecording){
        startRecording();
    }
});
stopButton.addEventListener("click", function () {
    pauseTimer();
    stopRecording();
    startRecorderText.innerHTML=(language=='English' && "Please wait for a moment")||(language=='Dutch' && "even wachten aub")
    ||(language=='French'&& "veuillez patienter un instant");
    recordButton.style.opacity='0.3';
    stopButton.style.opacity='0.3';
    timerElement.style.opacity='0.3';
});



function startRecording() {
    console.log("recordButton clicked");

    let constraints = { audio: true, video:false }


    navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
        console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

        audioContext = new AudioContext();

        /*  assign to gumStream for later use  */
        gumStream = stream;

        /* use the stream */
        input = audioContext.createMediaStreamSource(stream);

        /*
            Create the Recorder object and configure to record mono sound (1 channel)
            Recording 2 channels  will double the file size
        */
        rec = new Recorder(input,{numChannels:1})

        //start the recording process
        if(sessionStorage.getItem('lang')=="French"){
            startRecorderText.innerHTML="Nous enregistrons, n'oubliez pas de vous identifier";
        }
        else if(sessionStorage.getItem('lang')=="Dutch"){
            startRecorderText.innerHTML="We zijn aan het opnemen, vergeet uzelf niet te identificeren";
        }
        else {
            startRecorderText.innerHTML="We are recording, don't forget to identify yourself";

        }

        rec.record();
        startTimer();


        isRecording=1;

        //show two hidden elements
        timerElement.hidden=false;
        stopButton.hidden=false;

        console.log("Recording started");
        SpeechToText();

    }).catch(function(err) {
        //enable the record button if getUserMedia() fails

    });
}


function stopRecording() {
    console.log("stopButton clicked");
    rec.stop();
    isRecording=0;
    //stop microphone access
    gumStream.getAudioTracks()[0].stop();
    //create the wav blob and pass it on to createDownloadLink
    rec.exportWAV(createDownloadLink);

}

function createDownloadLink(blob) {

    let form=new FormData();
    form.append("audioFile",blob,"recorder.wav");
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
