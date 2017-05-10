$(document).ready(function () {
    if (window.localStorage.getItem('user') !== null) {
        var user = JSON.parse(window.localStorage.getItem('user'));
        if (user.type === 'driver') {
            window.location.replace("choose-bus.html");
        }
    }

    $("#submit-btn").click(function () {
        var obj = {
            username: $('#username').val(),
            password: $('#password').val(),
            type: 'driver'
        };
        $.ajax({
            url: "/queue/api/general/login.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: obj,
            success: function (data) {
                data = JSON.parse(data);
                data.type = 'driver';
                window.localStorage.setItem('user', JSON.stringify(data));
                window.location.replace("choose-bus.html");
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    });
});