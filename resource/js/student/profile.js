$(document).ready(function () {
    var tab = 'general';
    var profile = {};
    var user = JSON.parse(window.localStorage.getItem('user'));
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        format: 'dd/mm/yyyy'
    });

    $('.tab').click(function () {
        tab = $(this).attr('data');
    });

    $("#submit-btn").click(function () {
        var obj = {};
        var isUpdate = true;
        if (tab === 'password') {
            var new_pass = $('#new_password').val();
            var confirm_pass = $('#confirm_password').val();
            if (new_pass === confirm_pass) {
                obj = {
                    id: profile.id,
                    password: $('#new_password').val(),
                    type: 'pass'
                }
            } else {
                swal('Error', 'New password and Confirm password is different!!', 'error');
                isUpdate = false;
            }
        } else {
            obj = {
                id: profile.id,
                full_name: $('#full_name').val(),
                identity_id: $('#identity_id').val(),
                day_of_birth: $('#day_of_birth').val(),
                student_no: $('#student_no').val(),
                phone_number: $('#phone_number').val(),
                type: 'info'
            };
        }
        if (isUpdate) {
            $.ajax({
                url: "/queue/api/student/updateProfile.php",
                type: 'get',
                cache: false,
                dataType: 'text',
                data: obj,
                success: function () {
                    swal({
                            title: "Update Success",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "rgb(140, 212, 245)",
                            confirmButtonText: "Yes",
                            closeOnConfirm: true
                        },
                        function () {
                            $('#new_password').val('');
                            $('#confirm_password').val('');
                            getUserById(user.id);
                        });
                },
                error: function (error) {
                    swal("error", error.responseText, "error");
                }
            });
        }
    });

    var getDate = function (date) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; //January is 0!

        var yyyy = date.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        return dd + '/' + mm + '/' + yyyy;
    };

    var getUserById = function (id) {
        $.ajax({
            url: "/queue/api/student/getProfile.php?id=" + id,
            cache: false,
            success: function (data) {
                profile = JSON.parse(data)[0];
                var dob = new Date(profile.dob.substr(0, 10));
                profile.dob = getDate(dob);
                $('#user_name').val(profile.username);
                $('#full_name').val(profile.fullname);
                $('#day_of_birth').val(profile.dob);
                $('#phone_number').val(profile.phone);
                $('#student_no').val(profile.student_no);
                $('#identity_id').val(profile.identity_id);
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    };

    getUserById(user.id);
});