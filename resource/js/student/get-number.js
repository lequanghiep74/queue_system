/**
 * Created by thuan on 3/18/2017.
 */
$(document).ready(function () {
    $(".button-collapse").sideNav();

    var route_queue = JSON.parse(window.localStorage.getItem('route_queue'))[0];
    $('#fromLocation').html('<b>From </b>' + route_queue.from_location);
    $('#toLocation').html('<b>To </b>' + route_queue.to_location);
    $('#startTime').html('<b>Time </b>' + route_queue.start_time);
    $('#bus').html('<b>Bus </b>' + route_queue.plate_no);
    $('#currentQueue').html('<b>' + route_queue.queue + '</b>');

    $('#btnGetNumber').click(function () {
        $.ajax({
            url: "/queue/api/route_queue/enterRouteQueue.php",
            type: 'post',
            dataType: 'text',
            data: {
                route_queue_id: route_queue.id
            },
            success: function () {
                localStorage.setItem("route_queue", null);
                window.location.href = 'history.html';
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
    });

    // begin js
    function setNum() {
        var num = '0000';
        var queue = (parseInt(route_queue.queue) + 1).toString();
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

    setNum();
});