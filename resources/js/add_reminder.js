$(function () {
    $("#remind_by_date").change(function () {
        if ($("#remind_by_date:checkbox:checked").length > 0) {
            $("#by_date").prop("disabled", false);
            $("#days_before").prop("disabled", false);
        } else {
            $("#by_date").prop("disabled", true);
            $("#days_before").prop("disabled", true);

            if (!($("#remind_by_odometer:checkbox:checked").length > 0)) {
                $("#remind_by_odometer").prop("checked", true)
                $("#by_odometer").prop("disabled", false);
                $("#km_before").prop("disabled", false);
            }
        }
    });
    $("#remind_by_odometer").change(function () {
        if ($("#remind_by_odometer:checkbox:checked").length > 0) {
            $("#by_odometer").prop("disabled", false);
            $("#km_before").prop("disabled", false);
        } else {
            $("#by_odometer").prop("disabled", true);
            $("#km_before").prop("disabled", true);

            if (!($("#remind_by_date:checkbox:checked").length > 0)) {
                $("#remind_by_date").prop("checked", true)
                $("#by_date").prop("disabled", false);
                $("#days_before").prop("disabled", false);
            }
        }
    });
});
