$(function () {
    $("#select_all").change(function () {
        if ($("#select_all:checkbox:checked").length > 0) {
            $("#km_traveled").prop("checked", true);
            $("#km_difference").prop("checked", true);
            $("#fuel_consumption").prop("checked", true);
            $("#costs").prop("checked", true);
            $("#paid_km_traveled").prop("checked", true);
        } else {
            $("#km_traveled").prop("checked", false);
            $("#km_difference").prop("checked", false);
            $("#fuel_consumption").prop("checked", false);
            $("#costs").prop("checked", false);
            $("#paid_km_traveled").prop("checked", false);
        }
    });
});
