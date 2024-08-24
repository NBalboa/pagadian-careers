$(document).ready(function () {
    const sidebar = $("#sidebar");

    const open_btn = $("#open-sidebar-btn");
    const close_btn = $("#close-sidebar-btn");

    open_btn.on("click", function () {
        if (sidebar.hasClass("-translate-x-full")) {
            sidebar.removeClass("-translate-x-full");
        }
    });

    close_btn.on("click", function () {
        if (!sidebar.hasClass("-translate-x-full")) {
            sidebar.addClass("-translate-x-full");
        }
    });
});
