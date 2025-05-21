$(() => {
    $('#subcategoryaddedform').on('keypress', 'input, select', function (e) {
        if (e.which === 13) { // Enter key
            e.preventDefault();
    
            const fields = $('#subcategoryaddedform').find('input:visible, select:visible');
            const index = fields.index(this);
    
            if (index !== -1 && index < fields.length - 1) {
                fields.eq(index + 1).focus();
            } else {
                // Optional: trigger submit or stay on last field
                $('#subcategoryaddedform').submit();
            }
        }
    });
 
  
     const showOffAddedata = () => {
          $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                showOffAddedata:55
            },
            success:function(data){
                $('#showsubcategories11').html(data); 
            },
            error:function(err){
                alert("Error found in " + err); 
            }
          })
     }

     showOffAddedata(); 


      $('body').on('click','.editSubCategories',function(e){
           let myid = $(this).attr('myid'); 
           let main_cat_id= $(this).attr('main_cat_id');
           let sub_cat_id = $(this).attr('sub_cat_id');
            let sub_cat_code = $(this).attr('code');

            let subcategory2_name= $(this).attr('subcategory2_name'); 

           
            $('#ucategoryName').val(myid); 

            $('#usubcategory2name').val(sub_cat_id);

            $('#usubcategory2name').val(subcategory2_name);
            $('#usubcategory2code').val(sub_cat_code);
 
            
           sessionStorage.setItem('id',myid); 

            $.ajax({
                url : 'action.php', 
                method:'POST', 
                data:{
                    value : myid, 
                    changeCategoryName : 55
                },
                success:function(data){
                    $('#usubcategory1').html(data); 
                },
                error:function(err){
                    alert("Error found in" + err); 
                }
            })


            $('#editCategoryModalsection').modal('show'); 



      }); 

     $('body').on('click', '.deleteSubCategories', function (e) {
         e.preventDefault();
         const subcategoryId = $(this).attr('cat_id'); // Assuming the button has a data-id attribute
         
         if (confirm('Are you sure you want to delete this subcategory?')) {
             $.ajax({
                 url: 'action.php',
                 method: 'POST',
                 data: {
                     deleteSubCategory: 1,
                     deleteId: subcategoryId
                 },
                 success: function (response) {
                     if (response == 1) {
                         toastr.success('Subcategory 2 deleted successfully');
                         showOffAddedata();
                     } else {
                         alert('Failed to delete subcategory: ' + response);
                     }
                 },
                 error: function (err) {
                     alert('Error found in ' + err);
                 }
             });
         }
     });

    $("#subcategoryaddedform").on('submit',function(e){
        e.preventDefault(); 
          let category_id = $('#categoryName').val(); 
          let subcategory1 = $('#subcategory1').val(); 
          let subcategory2name = $('#subcategory2name').val(); 
          let subcategory2code = $('#subcategory2code').val(); 
          let category_name = $('#categoryName option:selected').text();
          let subcategory1text = $('#subcategory1 option:selected').text(); 

          $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                category_id : category_id, 
                subcategory1 : subcategory1, 
                subcategory2name:subcategory2name, 
                subcategory2code:subcategory2code, 
                category_name:category_name, 
                subcategory1text:subcategory1text,
                subcategoryaddedform:55
            },
            success:function(data){
                if(data==1){
                    toastr.info("It has been added successfully");
                    $('#subcategoryaddedform')[0].reset();
                    document.getElementById('categoryName').focus();
    
                }
               else {
                   alert(data); 
               }

            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })




          

    }); 

    
    $('#categoryName').on('change', function () {
         
        let value = this.value; 
     
        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                value : value, 
                changeCategoryName : 55
            },
            success:function(data){
                $('#subcategory1').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })


      });

 
      $('#subcategoryupdateform').on('submit',function(e){
        e.preventDefault(); 
          let category_id = $('#ucategoryName').val(); 
          let subcategory1 = $('#usubcategory1').val(); 
          let subcategory2name = $('#usubcategory2name').val(); 
          let subcategory2code = $('#usubcategory2code').val(); 
          let category_name = $('#ucategoryName option:selected').text();
          let subcategory1text = $('#usubcategory1 option:selected').text(); 
 

          $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {
                category_id: category_id,
                subcategory1: subcategory1,
                subcategory2name: subcategory2name,
                subcategory2code: subcategory2code,
                category_name: category_name,
                subcategory1text: subcategory1text,
                id:  sessionStorage.getItem('id'),  
                subcategoryupdateform: 55
            },
            success: function (data) {
                if (data == 1) {
                    toastr.success("Subcategory updated successfully");
                    $('#subcategoryupdateform')[0].reset();
                    $('#editCategoryModalsection').modal('hide');
                    showOffAddedata();
                } else {
                    alert(data);
                }
            },
            error: function (err) {
                alert("Error found in " + err);
            }
          });


      }); 

      
    $('#ucategoryName').on('change', function () {
         
        let value = this.value; 
     
        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                value : value, 
                changeCategoryName : 55
            },
            success:function(data){
                $('#subcategory1').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })


      });
    
 
}); //end of script 
  