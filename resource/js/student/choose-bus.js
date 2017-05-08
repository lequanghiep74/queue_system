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

    var getBuses = function (isLoadBus) {
        $('#selectBus').material_select('destroy');
        if (!isLoadBus) {
            $.ajax({
                url: "/queue/api/general/getBuses.php",
                type: 'get',
                success: function (data) {
                    data = JSON.parse(data);
                    $('#selectBus').val('none');
                    $('#selectBus option').each(function() {
                        if ($(this).val() != 'none') {
                            $(this).remove();
                        }
                    });
                    data.forEach(function (val) {
                        $('#selectBus')
                            .append($('<option>', {value: val.id})
                                .text(val.plate_no));
                    });
                    $('#selectBus').material_select();
                },
                error: function (error) {
                    alert(error.responseText);
                }
            });
        } else {
            var d = new Date();
            var dateStr = d.toISOString().substr(0, 10) + ' ' + $('#selectTime').val() + ':00:00';
            var obj = {
                from_location_id: $('#selectFromLocation').val(),
                to_location_id: $('#selectToLocation').val(),
                start_time: dateStr
            };
            $.ajax({
                url: "/queue/api/route_queue/getBusOfRouteQueue.php",
                type: 'get',
                data: obj,
                success: function (data) {
                    data = JSON.parse(data);
                    $('#selectBus').val('none');
                    $('#selectBus option').each(function() {
                        if ($(this).val() != 'none') {
                            $(this).remove();
                        }
                    });
                    data.forEach(function (val) {
                        $('#selectBus')
                            .append($('<option>', {value: val.id})
                                .text(val.plate_no));
                    });
                    $('#selectBus').material_select();
                },
                error: function (error) {
                    alert(error.responseText);
                }
            });
        }
    };

    var getLocations = function (elementId) {
        $.ajax({
            url: "/queue/api/general/getLocations.php",
            type: 'get',
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
                alert(error.responseText);
            }
        });
    };

    getLocations('#selectFromLocation');
    getLocations('#selectToLocation');
    getBuses(false);

    $('#selectFromLocation').on('change', function() {
        getBuses($('#selectFromLocation').val() && $('#selectToLocation').val() && $('#selectTime').val());
    });

    $('#selectFromLocation').on('change', function() {
        getBuses($('#selectFromLocation').val() && $('#selectToLocation').val() && $('#selectTime').val());
    });

    $('#selectTime').on('change', function() {
        getBuses($('#selectFromLocation').val() && $('#selectToLocation').val() && $('#selectTime').val());
    });

    $("#submit-btn").click(function () {
        var d = new Date();
        var dateStr = d.toISOString().substr(0, 10) + ' ' + $('#selectTime').val() + ':00:00';
        var obj = {
            from_location_id: $('#selectFromLocation').val(),
            to_location_id: $('#selectToLocation').val(),
            start_time: dateStr,
            bus_id: $('#selectBus').val()
        };
        $.ajax({
            url: "/queue/api/route_queue/getRouteQueue.php",
            type: 'get',
            dataType: 'text',
            data: obj,
            success: function (data) {
                localStorage.setItem("route_queue", data);
                window.location.href = 'get-number.html';
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    });
});