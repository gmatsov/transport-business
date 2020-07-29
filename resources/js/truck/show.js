$(function () {
    $("#show_reminder_tab").click(function () {
        $("#stats_tab").css("display", "none");
        $("#reminder_tab").css("display", "block");

        $("#show_reminder_tab").addClass('active');
        $("#show_stats_tab").removeClass('active');

    });
    $("#show_stats_tab").click(function () {
        $("#stats_tab").css("display", "block");
        $("#reminder_tab").css("display", "none");

        $("#show_stats_tab").addClass('active');
        $("#show_reminder_tab").removeClass('active');
    });
});
