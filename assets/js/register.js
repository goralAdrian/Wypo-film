$(document).ready(function () {

    $("#hideRegister").click(function () {
        $("#registerForm").hide();
        $("#loginForm").show();
    });

    $("#hideLogin").click(function () {

        $("#registerForm").show();
        $("#loginForm").hide();
    });
});
