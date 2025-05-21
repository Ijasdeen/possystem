$(() => {
   
 


    const showOffSub1Categories = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { showOffSub1Categories: 223 },
            success: function(data) {
                $('#showcategories').html(data);  
            },
            error: function() {
                toastr.error("Failed to fetch categories. Please try again.");
            }
            });
    }

    showOffSub1Categories(); 


    $(document).on('click','.editSubCategories',function(){
        let myid = parseInt($(this).attr('myid')); 
        let main_cat_id = $(this).attr('main_cat_id'); 
        let sub_cat1= $(this).attr('sub_cat1'); 
        let code= $(this).attr('code'); 

        $('#editCategorymodal').modal('show'); 

        sessionStorage.setItem('myid',myid); 
        $('#ucategoryName').val(main_cat_id); 
        $('#usubcategory1name').val(sub_cat1);
        $('#usubcategoryCode').val(code);




    }); 


    

    $('#subcategoryupdatedform').on('submit', function (e) {
        e.preventDefault();
    
        const $ucategoryName = $('#ucategoryName');
        const usubcategory1name = $('#usubcategory1name').val().trim();
        const usubcategoryCode = $('#usubcategoryCode').val().trim();
        const ucategoryId = $ucategoryName.val();
        const selectedText = $ucategoryName.find('option:selected').text();
        const myid = sessionStorage.getItem('myid');
    
        if (!usubcategory1name) {
            toastr.error("Please enter the sub category name");
            return;
        }
    
        const formData = new URLSearchParams({
            ucategoryName: ucategoryId,
            usubcategory1name,
            usubcategoryCode,
            selectedText,
            myid,
            updateSubQuery44: 5443
        });
    
        fetch('action.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData
        })
        .then(res => res.json())
        .then(response => {
            if (response === 1) {
                $('#editCategorymodal').modal('hide');
                Swal.fire({
                    title: "Updated!",
                    text: "Your file has been Updated.",
                    icon: "success"
                });
                showOffSub1Categories();
            } else if (response === 12) {
                toastr.info("Same name already exists with main category");
            } else {
                toastr.error(response?.error || "An error occurred");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            alert("Error: " + error.message);
        });
    });
    


    $(document).on('click', '.deleteSubCategories', function () {
        let myid = parseInt($(this).attr('cat_id')); 
      
        
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
    
            $.ajax({
                url :'action.php', 
                method:'POST', 
                data:{
                    myid:myid,
                    deleteSubCategory11:43243
                },
                success:function(data){
                    if(data==1){
    showOffSub1Categories(); 

                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                          });
                    }
                    else {
                        alert(data); 
                    }
    
                },
                error:function(err){
                    alert("Error found in" + err); 
                }
            })
    
        
        }
      });
        
    });



    


    $('#subcategoryaddedform').on('submit', function (e) {
        e.preventDefault(); 
        const categoryName = $('#categoryName').val().trim();
        const subcategory1name = $('#subcategory1name').val().trim();
        let selectedText = $('#categoryName option:selected').text();
        let subcategoryCode= $('#subcategoryCode').val().trim(); 

 
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                categoryName: categoryName,
                subcategory1name: subcategory1name,
                selectedText:selectedText,
                code:subcategoryCode, 
               subcategoryaddeformlineup: 1
            },
            success: function(response) {
                if (response == 1) {
                    toastr.success("Category saved successfully.");
                   // $('#editCategoryModal').modal('hide');
                    $('#subcategoryaddedform')[0].reset();
                    showOffSub1Categories();
                    document.getElementById('categoryName').focus();

                } else if (response == 12) {
                    toastr.info("Category with the same name already exists.");
                    $('#editCategoryName').css('border', '2px solid red').focus();
                } else {
                    toastr.error(response);
                }
            },
            error: function() {
                toastr.error("An error occurred while updating the category.");
            }
        });


    });
    

  });
  