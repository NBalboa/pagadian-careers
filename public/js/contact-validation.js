$(document).ready(function () {
    const regex = /^[0-9+-]+$/;

    $("#phone_no").on("input", function () {
        let phone = $(this).val();

        if (!regex.test(phone)) {
            $(this).val(phone.slice(0, -1));
        }
    });
    $("#telephone_no").on("input", function () {
        let telephone = $(this).val();

        if (!regex.test(telephone)) {
            $(this).val(telephone.slice(0, -1));
        }
    });
});
