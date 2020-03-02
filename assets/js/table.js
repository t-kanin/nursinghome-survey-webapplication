$(document).ready(function() {
    $('#Save').click(function() {
        var level = [];
        $('.get_value').each(function() {
            if ($(this).is(":checked")) {
                level.push($(this).val());
            }
        });
        level = level.toString();
        console.log(level);
        $.ajax({
            url: base_url+'/PageController/select_floor',
            method: "POST",
            data: {
                Level: level.toString()
            },
            success: function (msg) {
                if(msg == "success")
                    location.reload();
            }
        });

        console.log(level );
    });
});


