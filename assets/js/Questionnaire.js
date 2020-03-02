$(document).ready(function() {
    $('.takeCare').on('click',function (){
        $.ajax({
            success: function () {
                location.href= base_url+"Users/index";
            }
        })
    });
});