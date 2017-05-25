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
            day_of_birth: $('#day_of_birth').val(),
            driver_license: $('#driver_license').val(),
            staff_id: $('#staff_id').val(),
            phone_number: $('#phone_number').val(),
            sex: $('input[name=sex]:checked').val()
        };
        $.ajax({
            url: "/queue/api/driver/register.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: obj,
            success: function () {
                swal({
                        title: "Register Success",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "rgb(140, 212, 245)",
                        confirmButtonText: "Go to Login!",
                        closeOnConfirm: true
                    },
                    function () {
                        window.location.href = "login.html";
                    });
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    });
});