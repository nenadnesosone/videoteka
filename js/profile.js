$(document).ready(function(){
    //
    $("#update").click(function () {
        $("#second").slideUp("slow", function () {
            $("#first").slideDown("slow");
        })
    });
    //
    $("#signout").click(function () {
        $("#first").slideUp("slow", function () {
            $("#second").slideDown("slow");
        })
    });
});