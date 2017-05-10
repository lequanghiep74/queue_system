$(document).ready(function () {
    $(".button-collapse").sideNav();
    $('select').material_select();

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year
        format: 'dd/mm/yyyy',
        min: [1950, 0, 1],
        max: [2018, 1, 1]
    });

    $("#submit-btn").click(function () {
        var obj = {
            username: $('#username').val(),
            password: $('#password').val(),
            full_name: $('#full_name').val(),
            identity_id: $('#identity_id').val(),
            day_of_birth: $('#day_of_birth').val(),
            student_no: $('#student_no').val(),
            phone_number: $('#phone_number').val(),
            sex: $('input[name=sex]:checked').val()
        };
        $.ajax({
            url: "/queue/api/student/register.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: obj,
            success: function () {
                alert("Register Success");
                window.location.href = "login.html";
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    });
});