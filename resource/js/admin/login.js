$(document).ready(function () {
    if (window.localStorage.getItem('user') !== null) {
        var user = JSON.parse(window.localStorage.getItem('user'));
        if (user.type === 'admin') {
            window.location.replace("report.html");
        }
    }

    $("#submit-btn").click(function () {
        var obj = {
            username: $('#username').val(),
            password: $('#password').val(),
            type: 'admin'
        };
        $.ajax({
            url: "/queue/api/general/login.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: obj,
            success: function (data) {
                data = JSON.parse(data);
                data.type = 'admin';
                window.localStorage.setItem('user', JSON.stringify(data));
                window.location.replace("report.html");
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    });
});