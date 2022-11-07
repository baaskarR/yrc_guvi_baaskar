
$("#btn-login").on("click", function(){

    var _email = $("#email").val().trim();
    var _pass =  $("#password").val().trim();


    if(_pass == "" || _email == "" ){
        alert("All fields are mandatory")
    }

    var loginJson = {
        'email' : _email,
        'password' : _pass,
    }
    $.ajax(
        {
            type: "POST",
            url: "/api/login.php",
            data: JSON.stringify(loginJson),
            success: function(response){
                var responseData = JSON.parse(JSON.stringify(response));
                localStorage.setItem('session', responseData['session']);
                window.location = "/profile.html";
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
                var response = JSON.parse(xhr.responseText);
                alert(response['error']);
            }
        }
    );
});