$(document).ready(function () {
    const menu = $("#navbar-solid-bg");
    const button = $("#navbar-button");
    button.on("click", function () {
        if (menu.hasClass("hidden")) {
            menu.removeClass("hidden");
        } else {
            menu.addClass("hidden");
        }
    });
});
