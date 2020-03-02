$(document).ready(function() {
    $('.takeCare').click(function() {
        var IdNotification = this.id;
        console.log(IdNotification);
        $.ajax({
            //url: 'https://a19ux3.studev.groept.be/Master/PageController/select_floor',
            url: base_url+'/PageController/change_status',
            method: "POST",
            data: {
                IdNotification: IdNotification
            },
            success: function (msg) {
                if(msg == "success")
                    location.reload();
            }
        });
    });

});


