$(document).ready(function () {
    $(".button-collapse").sideNav();

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year
        format: 'dd/mm/yyyy',
        min: [1950, 0, 1],
        max: [2018, 1, 1]
    });

    $("#submit-btn").click(function () {
        getDriverReport();
    });

    function getDriverReport() {
        $.ajax({
            url: "/queue/api/admin/reportByDriver.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: {
                report_date: $('#report_date').val()
            },
            success: function (data) {
                data = JSON.parse(data);
                $('#driverReport > tbody').html('');
                var i = 1;
                if (data.length > 0) {
                    data.forEach(function (val) {
                        $('#driverReport > tbody:last-child').append('<tr>'
                            + '<td>' + i++ + '</td>'
                            + '<td>' + val.fullname + '</td>'
                            + '<td>' + val.bus + '</td>'
                            + '<td>' + (val.total || 0) + '฿</td></tr>');
                    });
                } else {
                    $('#driverReport > tbody:last-child').append('<tr><td colspan="4">Empty data</td></tr>');
                }
                $('#driverReport').show();
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    }
});