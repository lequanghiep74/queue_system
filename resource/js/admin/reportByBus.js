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
        getBusReport();
    });

    function getBusReport() {
        $.ajax({
            url: "/queue/api/admin/reportByBus.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: {
                report_date: $('#report_date').val()
            },
            success: function (data) {
                data = JSON.parse(data);
                $('#busAcceptReport > tbody').html('');
                $('#busCancelReport > tbody').html('');
                var i = 0;
                var j = 0;
                if (data.length > 0) {
                    data.forEach(function (val) {
                        $('#busAcceptReport > tbody:last-child').append('<tr>'
                            + '<td>' + ++i + '</td>'
                            + '<td>' + val.bus_no + '</td>'
                            + '<td>' + val.plate_no + '</td>'
                            + '<td>' + val.accept + '</td>');
                    });

                    data.forEach(function (val) {
                        $('#busCancelReport > tbody:last-child').append('<tr>'
                            + '<td>' + ++j + '</td>'
                            + '<td>' + val.bus_no + '</td>'
                            + '<td>' + val.plate_no + '</td>'
                            + '<td>' + val.cancel + '</td>');
                    });
                } else {
                    if (i === 0) {
                        $('#busAcceptReport > tbody:last-child').append('<tr><td colspan="4">Empty data</td></tr>');
                    }
                    if (j === 0) {
                        $('#busCancelReport > tbody:last-child').append('<tr><td colspan="4">Empty data</td></tr>');
                    }
                }
                $('#report').show();
                $('ul.tabs').tabs();
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    }
});