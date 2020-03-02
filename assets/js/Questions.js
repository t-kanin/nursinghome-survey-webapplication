var animationBusy = 0;

function progressBarVisualisationNext(){
    if (animationBusy == 0) {
        animationBusy = 1;
        var elem = document.getElementById("myBar");
        var width = (100 / total_data) * (parseInt(questionNumber));
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= (100 / total_data) * (parseInt(questionNumber)+1)) {
                elem.innerHTML = "\xa0"+question+"\xa0"+(parseInt(questionNumber)+1) + "\xa0"+from+"\xa0"+the+"\xa0" +total_data +"\xa0"+questions;
                clearInterval(id);
                elem.style.width=(100 / total_data) * (parseInt(questionNumber)+1)+"%";
                animationBusy = 0;
            } else {
                width=width+0.1;
                elem.style.width = width + "%"
            }
        }
    }
}
function progressBarVisualisationBack(){
    if (animationBusy == 0) {
        animationBusy = 1;
        var elem = document.getElementById("myBar");
        var width = (100 / total_data) * (parseInt(questionNumber)+2);
        if(width>100){width=100};
        var id = setInterval(frame, 10);
        function frame() {
            if (width <= (100 / total_data) * (parseInt(questionNumber)+1)) {
                elem.innerHTML = "\xa0Question\xa0"+(parseInt(questionNumber)+1) + "\xa0from\xa0the\xa0" +total_data +"\xa0questions";
                clearInterval(id);
                elem.style.width=(100 / total_data) * (parseInt(questionNumber)+1)+"%";
                animationBusy = 0;
            } else {
                width=width-0.1;
                elem.style.width = width + "%"
            }
        }
    }
}

function getNextContent() {
    //put answer in database
    var values=document.getElementById("button").children;
    var idQuestion= document.getElementById("idQuestion").children;
    var data={'idResident':values[1].value,'idQuestion':idQuestion[questionNumber].value,'content':(document.getElementsByClassName("emojiClicked"))[0].value};
    var ajaxurl = base_url+"ResidentController/StoreAnswer";
    $.post(ajaxurl, data, function (response) {
        // Response div goes here.
    });

    //remember answer in this 'session'
    var answers = JSON.parse(sessionStorage.getItem("answers"))
    answers[questionNumber]=parseInt((document.getElementsByClassName("emojiClicked"))[0].value);
    window.sessionStorage.setItem("answers", JSON.stringify(answers));

    questionNumber++;
    if (questionNumber<questionNumberNextCategory) {
        progressBarVisualisationNext();
        var contentQuestions = document.getElementById("contentQuestions").children;
        document.getElementById("contentQuestion").innerHTML = contentQuestions[questionNumber].value;

        //reset buttons
        var emojis = document.getElementById("emojis").children;
        for (var i = 0; i < emojis.length; i++) {
            emojis[i].className = "emoji";
        }
        document.getElementById("button").children[0].className = "button2";
        document.getElementById("button").children[0].disabled = true;
        showCurrentAnswer();
    }
    else if(questionNumber>=total_data){
        post(base_url+"ResidentController/resident/QuestionsAnswered",{questionNumber:questionNumber});
    }
    else {
        post(base_url+"ResidentController/resident/Category",{questionNumber:questionNumber});
    }
}

function goBack() {
    if (questionNumber-1>questionNumberPreviousCategory) {
        questionNumber--;
        showCurrentAnswer();
        progressBarVisualisationBack();
        var contentQuestions= document.getElementById("contentQuestions").children;
        document.getElementById("contentQuestion").innerHTML=contentQuestions[questionNumber].value;
    }
    else{
        post(base_url+"ResidentController/resident/Category",{questionNumber:questionNumber});
    }
}

//source: https://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit
function post(path, params, method='post') {
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    const form = document.createElement('form');
    form.method = method;
    form.action = path;
    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = key;
            hiddenField.value = params[key];
            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}
