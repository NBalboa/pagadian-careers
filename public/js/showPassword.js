$(document).ready(function () {
    const showPassword = $("#showPassword");
    const login = $("#login");
    const btnLogin = $("#login-btn");
    const spinner = $("#spinner");
    let toggle = false;
    showPassword.on("click", function () {
        toggle = !toggle;
        const password = $("#password");
        if (toggle) {
            $(this).html('<i class="fa-solid fa-eye-slash"></i>');
            password.attr("type", "text");
        } else {
            $(this).html('<i class="fa-solid fa-eye "></i>');
            password.attr("type", "password");
        }
    });

    login.on("submit", function () {
        btnLogin.hide();
        spinner.show();
    });
});
