$("#show_reminder_tab").click(function () {
    $("#stats_tab").css("display", "none");
    $("#reminder_tab").css("display", "block");
    $('#refuels_tab').css('display', 'none');

    $("#show_reminder_tab").addClass('active');
    $("#show_stats_tab").removeClass('active');
    $("#show_refuels_tab").removeClass('active');

});

$("#show_stats_tab").click(function () {
    $("#stats_tab").css("display", "block");
    $("#reminder_tab").css("display", "none");
    $('#refuels_tab').css('display', 'none');

    $("#show_stats_tab").addClass('active');
    $("#show_reminder_tab").removeClass('active');
    $("#show_refuels_tab").removeClass('active');

});

$('#show_refuels_tab').click(function () {
    $("#stats_tab").css("display", "none");
    $("#reminder_tab").css("display", "none");
    $('#refuels_tab').css("display", "block");

    $("#show_stats_tab").removeClass('active');
    $("#show_reminder_tab").removeClass('active');
    $("#show_refuels_tab").addClass('active');

});

$('#test').click(function (){
    alert('test')
});
