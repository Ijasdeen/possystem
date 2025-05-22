 

$(document).ready(function(){

    const showOffCashier = () => {
         $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                showOffCashier:55
            },
            success:function(data){
                $('#showcashiers').html(data); 
            },
            error:function(err){

            }
         }); 
    }


    showOffCashier(); 

   $('body').on('click', '.deleteCashier', function() {
    let myid = $(this).attr('myid'); 

    if(confirm("Are you sure you want to delete it?")){
          $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                deleteCashiersection:55,
                myid:myid 
            },
            success:function(data){
                $('#showcashiers').html(data); 
            },
            error:function(err){

            }
         }); 
    }
    
});




$('#saveCashiers').on('submit',function(e){
        e.preventDefault(); 

        let name = $('#name').val(); 

        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                name : name, 
                saveName : 444
            },
            success:function(data){
                if(data==1){
                    toastr.info("Saved successfully"); 
                    $('#saveCashiers')[0].reset(); 
                    $('#name').focus(); 
                    showOffCashier(); 
                }
                else if(data==12){
                    toastr.error("Name already exists. Please enter the different name");
                    return false;  
                }
                else {
                  toastr.info(data); 
                }
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })

}); 

}) //end of scirpt 