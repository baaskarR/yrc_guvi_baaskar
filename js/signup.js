
$("#btn-signup").on("click", function(){

    var _firstname = $("#firstname").val().trim();
    var _lastname = $("#lastname").val().trim();
    var _email = $("#email").val().trim();
    var _gender = $("#gender").val().trim();
    var _pass =  $("#password").val().trim();
    var _cpass =  $("#cpassword").val().trim();

    var _location = $("#location").val().trim();
    var _age= $("#age").val().trim();
    var _Fd= $("#Fd").val().trim();
    var _4m= $("#4m").val().trim();
    var _wd= $("#wd").val().trim();
    var _dis= $("#dis").val().trim();




    if(_pass == "" || _cpass == "" || _firstname == "" || _lastname == "" || _email == "" || _gender == "" ||_location == ""||_age == ""||_Fd == ""||_4m ==""||_wd == ""||_dis == ""){
        alert("All fields are mandatory")
    }
    if(_pass != _cpass){
        alert("Password do not match")
    }

    var signupJson = {
        'firstname' : _firstname,
        'lastname' : _lastname,
        'email' : _email,
        'gender' : _gender,
        'password' : _pass,
        'location':_location,
        'age':_age,
        'Fd':_Fd,
        'wd':wd,
        'dis':dis,

    }
    $.ajax(
        {
            type: "POST",
            url: "/api/signup.php",
            data: JSON.stringify(signupJson),
            success: function(response){
                console.log(response);
                var responseData = JSON.parse(JSON.stringify(response));
                alert(responseData['message']);
                window.location = "/login.html";
            },
            error: function(xhr, status, error){
                var response = JSON.parse(xhr.responseText);
                alert(response['error']);
            }
        }
    );
});