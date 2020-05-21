$(".submit").click(function (e) {
    e.preventDefault();
    let licence_plate = $("input[name=licence_plate]").val();
    let vin = $("input[name=vin]").val();
    let odometer = $("input[name=odometer]").val();
    let brand = $("input[name=brand]").val();
    let model = $("input[name=model]").val();
    let horse_power = $("input[name=horse_power]").val();
    let emission_class = $("select[name='emission_class']").children('option:selected').val();
    let production_year = $("select[name='production_year']").children('option:selected').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/truck',

        data: {
            licence_plate: licence_plate,
            vin: vin,
            odometer: odometer,
            emission_class: emission_class,
            brand: brand,
            model: model,
            production_year: production_year,
            horse_power: horse_power,
        },

        success: function (data) {
            $("input[name=licence_plater]").val('');
            $('#messages').html('');
            $('#messages').append('<div class="alert alert-success">' + data.success +
                '<button type="button" class="close" data-dismiss="alert">×</button>' +
                '<div>');
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
