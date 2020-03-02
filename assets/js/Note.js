$(document).ready(function() {
    $('.save').click(function() {
        var Id = this.id;
        var element =document.getElementById("txt");
        var note = element.value;//element.innerText || element.textContent;
        console.log(Id);
        console.log(element);
        console.log(note);
        $.ajax({
            //url: 'https://a19ux3.studev.groept.be/Master/PageController/select_floor',
            url: base_url+'/PageController/update_note',
            method: "POST",
            data: {
                Id: Id,
                note: note
            },
            success: function (msg) {
                //if(response){
                //$('#'+IdNotification ).children('<td><button type=\'button\' class=\'takeCare\' id='+IdNotification+'> I\'ll take care</button></td>')
                //  .replaceWith( "<td>Taken by"+ caregiver_id+ "</td>");
                //}
                if(msg == "success")
                    location.reload();
            }
        });
    });
    /*$('.reset_pass').click(function () {
        var Id = this.id;
        console.log(Id);
        $.ajax({
            url: base_url+'PageController/resident_reset_password',
            method: "POST",
            data:{
                Id:Id
            },
            success: function (msg) {
                if(msg=="success")
                    location.reload();
            }
        })
    }); */
});

