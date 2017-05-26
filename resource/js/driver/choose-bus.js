/**
 * Created by thuan on 3/17/2017.
 */
$(document).ready(function () {
    $(".button-collapse").sideNav();
    $("#selectTime").material_select();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        format: 'dd/mm/yyyy'
    });

    var getBuses = function () {
        $.ajax({
            url: "/queue/api/general/getBuses.php",
            type: 'get',
            cache: false,
            success: function (data) {
                data = JSON.parse(data);
                data.forEach(function (val) {
                    $('#selectBus')
                        .append($('<option>', {value: val.id})
                            .text(val.plate_no));
                });
                $('#selectBus').material_select();
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    };

    var getLocations = function (elementId) {
        $.ajax({
            url: "/queue/api/general/getLocations.php",
            type: 'get',
            cache: false,
            success: function (data) {
                data = JSON.parse(data);
                data.forEach(function (val) {
                    $(elementId)
                        .append($('<option>', {value: val.id})
                            .text(val.name));
                });
                $(elementId).material_select();
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    };

    getLocations('#selectToLocation');
    getBuses();

    $("#submit-btn").click(function () {
        var obj = {
            to_location_id: $('#selectToLocation').val(),
            bus_id: $('#selectBus').val()
        };
        $.ajax({
            url: "/queue/api/route_queue/createRouteQueue.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: obj,
            success: function (data) {
                data = JSON.parse(data);
                window.localStorage.setItem("queue_id", data.id);
                window.location.href = 'queue.html';
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    });
});