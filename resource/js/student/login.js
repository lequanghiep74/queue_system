$(document).ready(function () {
    if (window.localStorage.getItem('user') !== null && window.localStorage.getItem('user') !== undefined) {
        var user = JSON.parse(window.localStorage.getItem('user'));
        if (user.type === 'student') {
            window.location.replace("choose-bus.html");
        }
    }

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
            success: function (data) {
                data = JSON.parse(data);
                data.type = 'student';
                window.localStorage.setItem('user', JSON.stringify(data));
                window.location.replace("choose-bus.html");
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    });
});