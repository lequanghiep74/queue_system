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
        getSummaryReport();
        getBusReport();
    });

    function getSummaryReport() {
        $.ajax({
            url: "/queue/api/admin/report.php",
            type: 'post',
            dataType: 'text',
            data: {
                report_date: $('#report_date').val()
            },
            success: function (data) {
                data = JSON.parse(data)[0];
                data.cancel = data.cancel || 0;
                data.accept = data.accept || 0;
                $('#numRejected').html(data.cancel);
                $('#numAccepted').html(data.accept);
                $('#totalMoney').html((parseInt(data.accept) * 35) + '฿');
                $('#report').show();
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    }

    function getBusReport() {
        $.ajax({
            url: "/queue/api/admin/reportBus.php",
            type: 'post',
            dataType: 'text',
            data: {
                report_date: $('#report_date').val()
            },
            success: function (data) {
                data = JSON.parse(data);
                $('#busReport > tbody').html('');
                var i = 1;
                data.forEach(function (val) {
                    console.log(val);
                    $('#busReport > tbody:last-child').append('<tr>'
                        + '<td>' + i++ + '</td>'
                        + '<td>' + val.bus_no + '</td>'
                        + '<td>' + val.plate_no + '</td>'
                        + '<td>' + val.count + '</td></tr>');
                });
                $('#busReport').show();
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    }
});