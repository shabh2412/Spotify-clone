$(document).ready(function() {
    $("#hideLogin").click(function() {
        console.log("Register was pressed!");
        $("#loginForm").hide();
        $("#registerForm").show();
    });
    $("#hideRegister").click(function() {
        console.log("Login was pressed!");
        $("#loginForm").show();
        $("#registerForm").hide();
    });
});