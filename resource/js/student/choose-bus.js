/**
 * Created by thuan on 3/17/2017.
 */
$(document).ready(function () {
    $(".button-collapse").sideNav();

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

    $("#submit-btn").click(function () {
        var obj = {
            to_location_id: $('#selectToLocation').val()
        };
        $.ajax({
            url: "/queue/api/route_queue/getRouteQueue.php",
            type: 'get',
            cache: false,
            dataType: 'text',
            data: obj,
            success: function (data) {
                localStorage.setItem("route_queue", data);
                localStorage.removeItem("queue");
                window.location.href = 'get-number.html';
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    });
});