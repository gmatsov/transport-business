$(".remove-truck").click(function (e) {
    e.preventDefault();
    let truck_id = $("input[name=truck_id]").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/truck/' + truck_id,

        data: {
            truck_id: truck_id,
            "_method": 'DELETE',
        },

        success: function (data) {
            $("input[name=licence_plater]").val('');
            $('#messages').html('');
            $('#messages').append('<div class="alert alert-success">' + data.success +
                '<button type="button" class="close" data-dismiss="alert">×</button>' +
                '<div>');
            $('#truck-' + truck_id).remove();
        },
        error: function (data) {
            $('#messages').html('');
            $.each(data.responseJSON.errors, function (key, value) {
                $('#messages').append('<div class="alert alert-danger">' + value +
                    '<button type="button" class="close" data-dismiss="alert">×</button>' +
                    '</div>');
            });
        }
    });
});
