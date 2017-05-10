$(document).ready(function () {
    $(".button-collapse").sideNav();
    var location = {};

    $('#cancel-btn').click(function () {
        location = {};
        $('#location').val('');
    });

    $("#submit-btn").click(function () {
        var url = location.id ? '/queue/api/location/updateLocation.php' : '/queue/api/location/saveLocation.php';
        if ($('#location').val() !== '' && $('#location').val() !== null && $('#location').val() !== undefined) {
            $.ajax({
                url: url,
                type: 'get',
                cache: false,
                dataType: 'text',
                data: {
                    id: location.id,
                    name: $('#location').val()
                },
                success: function () {
                    location = {};
                    $('#location').val('');
                    getListLocation();
                },
                error: function (error) {
                    swal("error", error.responseText, "error");
                }
            });
        }
    });

    function deleteLocation(id) {
        $.ajax({
            url: '/queue/api/location/deleteLocation.php',
            type: 'get',
            cache: false,
            dataType: 'text',
            data: {
                id: id
            },
            success: function () {
                swal("Deleted!", "Your location has been deleted.", "success");
                getListLocation();
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    }

    function getListLocation() {
        $.ajax({
            url: "/queue/api/location/getLocation.php",
            cache: false,
            success: function (data) {
                data = JSON.parse(data);
                $('#tableLocation > tbody').html('');
                var i = 1;
                if (data.length > 0) {
                    data.forEach(function (val) {
                        var button = '<a class="edit" data=\'' + JSON.stringify(val) + '\' style="margin-right: 10px"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                            + '<a class="delete" data-id="' + val.id + '"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        $('#tableLocation > tbody:last-child').append('<tr>'
                            + '<td>' + i++ + '</td>'
                            + '<td>' + val.name + '</td>'
                            + '<td>' + button + '</td></tr>');
                    });
                    $('.edit').click(function () {
                        var data = JSON.parse($(this).attr('data'));
                        location.id = data.id;
                        $('#location').val(data.name);
                    });

                    $('.delete').click(function () {
                        var id = $(this).attr('data-id');
                        swal({
                                title: "Are you sure?",
                                text: "You will not be able to recover this location!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes, delete it!",
                                closeOnConfirm: false
                            },
                            function () {
                                deleteLocation(id);
                            });
                    });
                } else {
                    $('#tableLocation > tbody:last-child').append('<tr><td colspan="3">Empty data</td></tr>');
                }
            },
            error: function (error) {
                swal("error", error.responseText, "error");
            }
        });
    }

    getListLocation();
});