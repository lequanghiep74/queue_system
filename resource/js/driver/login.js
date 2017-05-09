/**
 * Created by thuan on 3/19/2017.
 */
$(document).ready(function () {
    $("#submit-btn").click(function () {
        var obj = {
            username: $('#username').val(),
            password: $('#password').val(),
            type: 'driver'
        };
        $.ajax({
            url: "/queue/api/general/login.php",
            type: 'post',
            dataType: 'text',
            data: obj,
            success: function (data) {
                data = JSON.parse(data);
                data.type = 'driver';
                window.localStorage.setItem('user', JSON.stringify(data));
                window.location.replace("choose-bus.html");
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    });
});