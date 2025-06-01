 

$(document).ready(function(){

    const showoffStore = () => {
         $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                showoffStore:55
            },
            success:function(data){
                $('#showoffstores').html(data); 
            },
            error:function(err){

            }
         }); 
    }


    showoffStore(); 


     $('body').on('click', '.editStoreSectionlineup', function() {
    let myid = $(this).attr('myid'); 
    let name = $(this).attr('name'); 
 
    $('#uname').val(name); 
    sessionStorage.setItem('myid', myid); 
    $('#editModalsectionlineup').modal('show'); 
});


 



     
   $('body').on('click', '.deleteStore', function() {
    let myid = $(this).attr('myid'); 

    if(confirm("Are you sure you want to delete it?")){
          $.ajax({
            url :'action.php', 
            method:'POST', 
            data:{
                deleteStore:55,
                myid:myid 
            },
            success:function(data){
                  if(data==1){
                    showoffStore(); 
                     toastr.info("Data has been deleted successfully"); 
                  }
                  else {
                     console.clear(); 
                     toastr.error(data); 
                  }
            },
            error:function(err){

            }
         }); 
    }
    
});

 
$('#updateCashiers').on('submit',function(e){
        e.preventDefault(); 

        let name = $('#uname').val(); 
        if(name=='' || !name){
            toastr.error("Please enter the name"); 
            return false; 
        }

        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                name : name, 
                id : sessionStorage.getItem('myid'), 
                updateStore : 444
            },
            success:function(data){
                if(data==1){
                    $('#editModalsectionlineup').modal('hide'); 
                        showoffStore(); 
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


$('#saveCashiers').on('submit',function(e){
        e.preventDefault(); 

        let name = $('#name').val(); 

        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                name : name, 
                saveStore : 444
            },
            success:function(data){
                if(data==1){
                    toastr.info("Saved successfully"); 
                    $('#saveCashiers')[0].reset(); 
                    $('#name').focus(); 
                        showoffStore(); 
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