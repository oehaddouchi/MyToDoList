$("#sign_in").click(function() {
    $("#formAlert").slideUp(400); 
    $("#formError").slideUp(400); 

    var username=$.trim($("#username").val());
    var password=$.trim($("#password").val());
    
    if(username=='' || password ==''){
        // If its value is empty
        $("#formAlert").slideDown(400);  
    }
    else{

        var data ={'action':'sign_in','username':username,'password':password};
    
        $.ajax({
            url: "ajax/user.php",
            type: "post",
            data: data ,
            success: function (response) {
                var response_arr = $.parseJSON(response);
            if(response_arr['logged_in']) {
                sessionStorage.setItem('loggedIn', true);
                sessionStorage.setItem('user_id', response_arr['id']);
                window.location="http://ouafaehaddouchi.tk/tasks.php";
            } else{
                $("#error_msg").text(response_arr['error_msg']);
                $("#formError").slideDown(400);  
            }         

            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }


        });
    }
    

});

$(".close").click(function() {
    $(this).parent().slideUp(400);  
});

//input validation 

$('#username').keypress(function (e) {
    //only allow alphanumeric values
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});

$('#password').keypress(function (e) {
    //space is not allowed 
     if(e.which === 32) 
        return false;
});