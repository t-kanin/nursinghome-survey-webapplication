let firstNameElement=document.getElementById('firstname');
let lastNameElement=document.getElementById('lastname');
let userstate=document.getElementById('userstate');
let pw=document.getElementById('pw');
let button=document.getElementById('submit');
let img_container=document.getElementById('img-container');
let nameArray=new Array();
let imageArray=new Array(15);

function imageLoader() {
	for (let i = 1; i <= 15; i++) {
		let imageElement = document.getElementById('img' + i);
		imageElement.addEventListener('click',function () {
			if(imageElement.style.opacity=="0.3"){
				imageElement.style.opacity="1.0";
				nameArray.splice($.inArray(imageElement.name,nameArray),1);
			}
			else {
				imageElement.style.opacity="0.3";
				nameArray.push(imageElement.name);
			}
		});
		imageArray.push(imageElement)
	}
}

function updateLogin() {
	//img array process
	let name="";
	nameArray.sort();
	nameArray.forEach(function (value) {
		name=name+value;
	});
	name=hex_md5(name);
	pw.value=name;

	let firstName=firstNameElement.value;
	let lastName=lastNameElement.value;
	let us=userstate.value;
	if(firstName=="" || lastName==""){
		alert("Druk op je naam");
	}
	else if(nameArray.length!=4){
		let errormessage="Je moet 4 afbeeldingen kiezen";
		errorMessageLoad(errormessage);
		restoreImgStyle();
		nameArray=[];}
	else{
		restoreImgStyle();
		nameArray=[];

		$.ajax({
			data:{imgName:name,firstName:firstName,lastName:lastName,IsRegistered:us},
			type:"POST",
			url:base_url+"Users/LoginCheck",
			error:function(msg){
				let json=eval(msg);
				alert(json);
			},
			success:function(msg){
				//In this case, msg is a string not an array, so you dont need to use eval
				//msg 1: you finished first password, 2: your second password is correct, 3: your second password is wrong
				//4: no registeration right pw, 5: wrong pw

				if(msg=='1'){
					userstate.value=1;
					document.getElementById('header1').innerHTML="Bevestig je wachtwoord:";
				}
				else if(msg=='2')
				{
					window.location.href=base_url+'ResidentController/resident';
				}
				else if(msg=='3')
				{
					userstate.value=0;
					document.getElementById('header1').innerHTML="Kies 4 personen:";
					errorMessageLoad("Wachtwoorden zijn niet hetzelfde");
				}
				else if(msg=='4'){
					window.location.href=base_url+'ResidentController/resident';
				}
				else{
					errorMessageLoad("Verkeerd wachtwoord");
				}
			}
		});
	}

}

function restoreImgStyle(){
	for(let i=0;i<15;i++){
		let img=document.getElementById('img'+(i+1));
		img.style.opacity="1.0";
	}
}

function errorMessageLoad(errormessage){
	let errorElement = document.getElementById('error_message');//.style.display
	errorElement.innerHTML=errormessage;
	errorElement.style.display="";
}

function errorMessageHide(){
	let errorElement = document.getElementById('error_message');//.style.display
	errorElement.style.display="none";
}

imageLoader();

img_container.addEventListener('click',errorMessageHide);
button.addEventListener('click',updateLogin);
