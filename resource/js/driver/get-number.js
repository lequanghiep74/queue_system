$(document).ready(function () {
    $(".button-collapse").sideNav();
    var id = window.localStorage.getItem('queue_id');
    var student_queue = {};

    $.ajax({
        url: "/queue/api/route_queue/getRouteQueueById.php?id=" + id,
        type: 'get',
        cache: false,
        success: function (data) {
            data = JSON.parse(data)[0];
            $('#toLocation').html('<b>To </b>' + data.to_location);
            $('#bus').html('<b>Van </b>' + data.plate_no);
        },
        error: function (error) {
            swal("error", error.responseText, "error");
        }
    });

    window.updateQueue = function updateQueue(action) {
        var status = action === 'cancel' ? 2 : 1;
        $.ajax({
            url: "/queue/api/route_queue/updateQueue.php?id=" + id + "&status=" + status,
            type: 'get',
            cache: false,
            success: function () {
                window.localStorage.setItem('queue_id', null);
                window.location.href = 'history.html';
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    };

    window.updateStudentQueue = function updateStudentQueue(action) {
        var status = action === 'decline' ? 2 : 1;
        $.ajax({
            url: "/queue/api/route_queue/updateStudentQueue.php?id=" + student_queue.id + "&status=" + status + "&route_queue_id=" + id,
            type: 'get',
            cache: false,
            success: function () {
                getStudentQueueByRouteQueue();
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    };

    function getStudentQueueByRouteQueue() {
        $.ajax({
            url: "/queue/api/route_queue/getStudentQueueByRouteQueueId.php?id=" + id,
            type: 'get',
            cache: false,
            success: function (data) {
                student_queue = JSON.parse(data)[0];
                if (student_queue !== undefined) {
                    $('#studentName').html('<b>Name</b> ' + student_queue.fullname);
                    setData(student_queue.queue);
                } else {
                    $('#studentName').html('<b>Name</b> No passengers');
                    $('#btn-accept').prop('disabled', true);
                    $('#btn-decline').prop('disabled', true);
                    setData('0');
                }
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    }

    function setData(queue) {
        var num = '0000';
        queue = num.substr(queue.length) + queue;

        var h = [queue[0], queue[1]];
        var m = [queue[2], queue[3]];

        // let's clear the old outgoing
        var oldOutgoing = document.querySelectorAll('.outgoing');
        var i;
        for (i = 0; i < oldOutgoing.length; i++) {
            oldOutgoing[i].className = 'number';
        }

        // let's get minutes going
        var minutesDizainesOutgoingId = m[0] - 1 === -1 ? 5 : m[0] - 1;
        var minutesDizainesOutgoing = document.getElementById('minutes-dizaines-' + minutesDizainesOutgoingId);
        var minutesDizaines = document.getElementById('minutes-dizaines-' + m[0]);

        var minutesUnitesOutgoingId = m[1] - 1 === -1 ? 9 : m[1] - 1;
        var minutesUnitesOutgoing = document.getElementById('minutes-unites-' + minutesUnitesOutgoingId);
        var minutesUnites = document.getElementById('minutes-unites-' + m[1]);

        minutesDizaines.className = 'number is-active';
        minutesDizainesOutgoing.className = 'number outgoing';
        minutesUnites.className = 'number is-active';
        minutesUnitesOutgoing.className = 'number outgoing';

        // clear outgoing

        // let's get hours going
        var hoursDizainesOutgoingId = h[0] - 1 === -1 ? 1 : h[0] - 1;
        var hoursDizainesOutgoing = document.getElementById('hours-dizaines-' + hoursDizainesOutgoingId);
        var hoursDizaines = document.getElementById('hours-dizaines-' + h[0]);

        var hoursUnitesOutgoingId = h[1] - 1 === -1 ? 9 : h[1] - 1;
        var hoursUnitesOutgoing = document.getElementById('hours-unites-' + hoursUnitesOutgoingId);
        var hoursUnites = document.getElementById('hours-unites-' + h[1]);

        hoursDizaines.className = 'number is-active';
        hoursDizainesOutgoing.className = 'number outgoing';
        hoursUnites.className = 'number is-active';
        hoursUnitesOutgoing.className = 'number outgoing';
    }

    getStudentQueueByRouteQueue();
});