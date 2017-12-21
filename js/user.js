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
            if(response_arr['user_id']>0) {
                $('#user_id').val(response_arr['user_id']);
                $('#form').submit();
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

$("#register").click(function() {
    $("#formAlert").slideUp(400); 
    $("#formError").slideUp(400); 

    var name=$.trim($("#name").val());
    var email=$.trim($("#email").val());
    var username=$.trim($("#username").val());
    var password=$.trim($("#password").val());
    var confirm=$.trim($("#confirm").val());
    
    if(name=='' || email ==''|| username =='' || password =='' || confirm ==''){
        // If its value is empty
        $("#formAlert").slideDown(400);  
    }else if(password!=confirm){
        $("#error_msg").text("passwords do not match");
        $("#formError").slideDown(400); 
    }
    else{

        var data ={'action':'register','name':name,'email':email,'username':username,'password':password};
    
        $.ajax({
            url: "ajax/user.php",
            type: "post",
            data: data ,
            success: function (response) {
                var response_arr = $.parseJSON(response);
           if(response_arr['user_id']>0) {
                $('#user_id').val(response_arr['user_id']);
                $('#form').submit();
            } else{
                $("#error_msg").html($.parseHTML(response_arr['error_msg']));
                $("#formError").slideDown(400);  
            }         

            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }


        });
    }
    

});

$("#reset").click(function() {
    $("#formAlert").slideUp(400); 
    $("#formError").slideUp(400); 

    var email=$.trim($("#email").val());
    
    if(email ==''){
        // If its value is empty
        $("#formAlert").slideDown(400);  
    }
    else{

        var data ={'action':'reset','email':email};
    
        $.ajax({
            url: "ajax/user.php",
            type: "post",
            data: data ,
            success: function (response) {
                alert(response);
                $("#formInfo").slideDown(400);     

            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }


        });
    }
    

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

