$(document).ready(function () {
    $(".button-collapse").sideNav();
    var bus = {};

    $('#cancel-btn').click(function () {
        bus = {};
        $('#busNo').val('');
        $('#plateNo').val('');
    });

    $("#submit-btn").click(function () {
        var url = bus.id ? '/queue/api/bus/updateBus.php' : '/queue/api/bus/saveBus.php';
        if ($('#busNo').val() !== '' && $('#busNo').val() !== null && $('#busNo').val() !== undefined
            && $('#plateNo').val() !== '' && $('#plateNo').val() !== null && $('#plateNo').val() !== undefined) {
            $.ajax({
                url: url,
                type: 'get',
                cache: false,
                dataType: 'text',
                data: {
                    id: bus.id,
                    bus_no: $('#busNo').val(),
                    plate_no: $('#plateNo').val(),
                },
                success: function () {
                    bus = {};
                    $('#busNo').val('');
                    $('#plateNo').val('');
                    getListBus();
                },
                error: function (error) {
                    swal("error", error.responseText, "error");
                }
            });
        }
    });

    function deleteBus(id) {
        $.ajax({
            url: '/queue/api/bus/deleteBus.php?id=' + id,
            success: function () {
                swal("Deleted!", "Your bus has been deleted.", "success");
                getListBus();
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    }

    function getListBus() {
        $.ajax({
            url: "/queue/api/bus/getBus.php",
            cache: false,
            success: function (data) {
                data = JSON.parse(data);
                $('#tableBus > tbody').html('');
                var i = 1;
                if (data.length > 0) {
                    data.forEach(function (val) {
                        var button = '<a class="edit" data=\'' + JSON.stringify(val) + '\' style="margin-right: 10px"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                            + '<a class="delete" data-id="' + val.id + '"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        $('#tableBus > tbody:last-child').append('<tr>'
                            + '<td>' + i++ + '</td>'
                            + '<td>' + val.bus_no + '</td>'
                            + '<td>' + val.plate_no + '</td>'
                            + '<td>' + button + '</td></tr>');
                    });
                    $('.edit').click(function () {
                        var data = JSON.parse($(this).attr('data'));
                        bus.id = data.id;
                        $('#busNo').val(data.bus_no);
                        $('#plateNo').val(data.plate_no);
                    });

                    $('.delete').click(function () {
                        var id = $(this).attr('data-id');
                        swal({
                                title: "Are you sure?",
                                text: "You will not be able to recover this bus!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes, delete it!",
                                closeOnConfirm: false
                            },
                            function () {
                                deleteBus(id);
                            });
                    });
                } else {
                    $('#tableBus > tbody:last-child').append('<tr><td colspan="4">Empty data</td></tr>');
                }
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    }

    getListBus();
});