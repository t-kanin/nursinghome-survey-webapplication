function goBack() {
    if(questionNumber>0) {
        questionNumber--;
        post(base_url + "ResidentController/resident/Questions", {questionNumber: questionNumber});
    }
    else{
        window.location.href = base_url+"ResidentController/resident/ifSurveyNotEnded";
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
