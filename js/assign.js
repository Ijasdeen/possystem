$(document).ready(function(){
       
 
    

    const showOffBranches = () => {
        $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                showOffBranches:55
            },
            success:function(data){
                $('#branch').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })
    }
    showOffBranches(); 


    const showoffCashiers = () => {
        $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                showoffCashiers:55
            },
            success:function(data){
                $('#cashierssection').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })
    }

       const warehouseDropdown = () => {
        $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                warehouseDropdown:55
            },
            success:function(data){
                $('#warehouseDropdown').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })
    }


      const storeDrodown = () => {
        $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                storeDrodown:55
            },
            success:function(data){
                $('#storeDrodown').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        });
    }

    storeDrodown(); 

    warehouseDropdown(); 

   showoffCashiers(); 

}); 