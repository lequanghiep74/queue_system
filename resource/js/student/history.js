$(document).ready(function () {
    $(".button-collapse").sideNav();

    var getHistory = function getHistory() {
        $.ajax({
            url: "/queue/api/student/history.php",
            dataType: "text",
            type: 'get',
            success: function () {
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    };

    getHistory();
});