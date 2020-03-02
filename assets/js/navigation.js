function goBack() {
    window.history.go(-1);
}
function endSurvey(url){
    localStorage.clear(); //if survey ends best clear localstorage
    window.location.href = url.concat("home");
}
