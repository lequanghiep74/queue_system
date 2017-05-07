/**
 * Created by thuan on 3/19/2017.
 */
$(document).ready(function () {
    $("#submit-btn").click(function () {
        var obj = {
            username: $('#username').val(),
            password: $('#password').val(),
            type: 'student'
        };
        $.ajax({
            url: "/queue/api/general/login.php",
            type: 'post',
            dataType: 'text',
            data: obj,
            success: function () {
                window.location.replace("choose-bus.html");
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    });
});