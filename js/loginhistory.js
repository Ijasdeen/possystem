$(document).ready(function(){
   
    const showoffLoginHistory = () => {
         $.ajax({
            url:'action.php',
            method:'POST',
            data:{
                showoffLoginHistory:55
            },
            success:function(data){
                $('#loginhistory').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
         })
    }

    showoffLoginHistory(); 

});