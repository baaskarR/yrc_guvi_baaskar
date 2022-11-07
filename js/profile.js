jQuery(document).ready(function() {

    var session = localStorage.getItem('session');

    var tokenJson = {
        'session' : session,
    }
    $.ajax(
        {
            type: "POST",
            url: "/api/profile.php",
            data: JSON.stringify(tokenJson),
            success: function(response){
                var responseData = JSON.parse(JSON.stringify(response));
                $("#firstname").val(responseData["firstname"]);
                $("#lastname").val(responseData["lastname"]);
                $("#email").val(responseData["email"]);
                $("#gender").val(responseData["gender"]);
                $("#location").val(responseData["location"]);
                $("#age").val(responseData["age"]);
                $("#Fd").val(responseData["Fd"]);
                $("#4m").val(responseData["4m"]);
                $("#wd").val(responseData["wd"]);
                $("#dis").val(responseData["dis"]);
                


            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
                window.location = "/login.html";
            }
        }
    );
});