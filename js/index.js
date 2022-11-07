$("#btn-register").on("click", function(){

    
   

   

   
    $.ajax(
        {
            type: "POST",
                success: function(response){
                var responseData = JSON.parse(JSON.stringify(response));
                localStorage.setItem('session', responseData['session']);
                window.location = "/signup.html";
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

$("#btn-loginn").on("click", function(){

    
   

   

   
    $.ajax(
        {
            type: "POST",
                success: function(response){
                var responseData = JSON.parse(JSON.stringify(response));
                localStorage.setItem('session', responseData['session']);
                window.location = "/login.html";
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
