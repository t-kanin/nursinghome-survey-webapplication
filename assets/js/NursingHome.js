$(document).ready(function() {
    $('.takeCare').click(function() {
        var NursingHome_name = this.id;
        console.log(NursingHome_name);
        $.ajax({
            //url: 'https://a19ux3.studev.groept.be/Master/PageController/select_floor',
            url: base_url+'/NursingHome/set_nursingHome',
            method: "POST",
            data: {
                NursingHome: NursingHome_name
            },
            success: function (msg) {
                //if(response){
                //$('#'+IdNotification ).children('<td><button type=\'button\' class=\'takeCare\' id='+IdNotification+'> I\'ll take care</button></td>')
                //  .replaceWith( "<td>Taken by"+ caregiver_id+ "</td>");
                //}
                if(msg == "success")
                    location.href= base_url+"Users/index";
            }
        });
    });
});