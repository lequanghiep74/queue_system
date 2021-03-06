$(document).ready(function () {
    $(".button-collapse").sideNav();

    var getHistory = function getHistory() {
        $.ajax({
            url: "/queue/api/driver/history.php",
            cache: false,
            dataType: "text",
            type: 'get',
            success: function (data) {
                data = JSON.parse(data);
                data.forEach(function (val) {
                    $('#histories').append(genHistoryItem(val));
                });
                $(".activeQueue").click(function () {
                    window.localStorage.setItem('queue_id', $(this).attr('data-id'));
                    window.location.href = 'queue.html';
                });
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    };

    var genHistoryItem = function (data) {
        var html = '<div class="row">'
            + '<div class="col s12 m6 offset-m3 ">'
            + '<div class="card-panel col s12 ">'
            + '<div class="card-content col s10" style="padding:10px 0 10px 0">'
            + '<span class="teal-text-history col s12 m12">'
            + '<i class="material-icons s1">location_on</i>'
            + '<i class="small"><b>To </b>' + data.to_location + '</i>'
            + '</span><br>'
            + '<span class="teal-text-history col s12 m12">'
            + '<i class="material-icons">date_range</i>'
            + '<i class="small"><b>Date </b>' + data.start_time.substr(0, data.start_time.lastIndexOf(' ')) + '</i>'
            + '</span><br>'
            + '<span class="teal-text-history col s12 m12">'
            + '<i class="material-icons s1">directions_bus</i>'
            + '<i class="small"><b>Van </b>' + data.plate_no + '</i>'
            + '</span>'
            + '</div>'
            + '<div class="col s2 ">';
        switch (data.status) {
            case '0':
                html += '<a data-id="' + data.id + '" class="activeQueue btn-floating waves-effect waves-light blue lighten-1 center-element center-align">'
                    + data.queue + '</a>';
                break;
            case '1':
                html += '<a class="btn-floating waves-effect waves-light teal lighten-1 center-element center-align">'
                    + '<i class="fa fa-check" aria-hidden="true"></i></a>';
                break;
            case '2':
                html += '<a class="btn-floating waves-effect waves-light red lighten-1 center-element center-align">'
                    + '<i class="fa fa-times" aria-hidden="true"></i></a>';
                break;
        }
        html += ' </div></div></div></div>';
        return html;
    };

    getHistory();
});