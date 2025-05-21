$(function() {
 

    $('#subcategory11').on('change', function () {
         
        let value = this.value; 
     
        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                value : value, 
                changeSubCategorysection : 55
            },
            success:function(data){
                console.clear(); 
                console.log(data); 
                $('#subcategory2').html(data); 
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
                $('#subcategory11').html(data); 
            },
            error:function(err){
                alert("Error found in" + err); 
            }
        })


      });


      const showOffErrorData = async () => {
        const loadingIndicator = '<div class="loading">Loading...</div>'; // Display loading indicator
        document.getElementById('showinglineuphell').innerHTML = loadingIndicator;
    
        try {
            // Fetch request with optimized async/await
            const response = await fetch('action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    errorDataRequest: 44
                })
            });
    
            if (response.ok) {
                const data = await response.text();
                document.getElementById('showinglineuphell').innerHTML = data;
            } else {
                console.error('Server error:', response.status);
                document.getElementById('showinglineuphell').innerHTML = '<div class="error">Server error</div>';
            }
        } catch (err) {
            console.error("Error fetching error data:", err);
            document.getElementById('showinglineuphell').innerHTML = '<div class="error">Error fetching data</div>';
        }
    }
    
    showOffErrorData(); 
 

     const geSubcategory1 = (cat_id, settableCategory) => {
        $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {
                cat_id : cat_id, 
                fetchSubcategories11: 22
            },
            success: function (data) {
                $('#usubcategory2').html(data);
                $('#usubcategory2').val(settableCategory);

            },
            error: function (err) {
                console.error("Error fetching subcategories:", err);
            }
        });
     }

     $('body').on('click','.editbuttonsection',function(e){
         var id = Number($(this).data('id'));
 
    var categoryIdFk = $(this).data('category_id_fk');
    var subcategoryIdFk = $(this).data('subcategory_id_fk');
    var subcategory2IdFk = $(this).data('subcategory2_id_fk');
    var subcategory3Name = $(this).data('subcategory3_name');
    var subcategory3Code = $(this).data('subcategory3_codeliner');

 
 
      $('#uucategoryName').val(categoryIdFk);

    $.ajax({
        url: 'action.php',
        method: 'POST',
        data: {
            categoryIdFk: categoryIdFk,
            fetchSubcategories: 22
        },
        success: function (data) {
            $('#usubcategory11').html(data);
               $('#usubcategory11').val(subcategoryIdFk);
               geSubcategory1(subcategoryIdFk,subcategory2IdFk); 
        },
        error: function (err) {
            console.error("Error fetching subcategories:", err);
        }
    });

    $('#usubcategory11').val(subcategoryIdFk);
    $('#usubcategory2').val(subcategory2IdFk);
    $('#uusubcategory3code').val(subcategory3Code);
     $('#uusubcategory3name').val(subcategory3Name);

        $('#editModalsection').modal('show');

     }); 

      $('body').on('click','.deleteFromtable',function(e){
            let id = parseInt($(this).attr('deleteId'));
            
            if(confirm("Are you sure you want to delete this subcategory?")) {
                $.ajax({
                    url: 'action.php',
                    method: 'POST',
                    data: {
                        deleteSubcategory3: id,
                        deleteSubcategory3Request: 44
                    },
                    success: function (data) {
                        if(data==1){
                            toastr.success("Subcategory 3 deleted successfully.");
                            showOffErrorData(); 
                        }
                        else{
                            toastr.error("Error deleting subcategory 3.");
                        }
                    },
                    error: function (err) {
                        console.error("Error deleting subcategory:", err);
                    }
                });
            }
  
      }); 

      

   $('#subcategoryaddedform').on('submit',function(e){
    e.preventDefault(); 
    let categoryName = $("#categoryName").val(); 
    let subcategory11 = $('#subcategory11').val(); 
    let subcategory2= $('#subcategory2').val(); 
    
    let subcategory3name = $("#subcategory3name").val(); 
    let subcategory2code = $('#subcategory3code').val(); 

    let categoryNameText = $("#categoryName option:selected").text(); 
    let subcategory11Text = $('#subcategory11 option:selected').text(); 
    let subcategory2Text = $('#subcategory2 option:selected').text(); 
   
    if (!categoryName) {
        toastr.error("Main category is required.");
        return;
    }

    if (!subcategory11) {
        toastr.error("Subcategory 1 is required.");
        return;
    }

    if (!subcategory2) {
        toastr.error("Subcategory 2 is required.");
        return;
    }

    if (!subcategory3name) {
        toastr.error("Subcategory 3 Name is required.");
        return;
    }

 

     
    $.ajax({
        url: 'action.php',
        method: 'POST',
        data: {
            categoryName: categoryName,
            subcategory11: subcategory11,
            subcategory2: subcategory2,
            subcategory3name: subcategory3name,
            subcategory2code: subcategory2code,
            categoryNameText:categoryNameText, 
            subcategory11Text:subcategory11Text, 
            subcategory2Text:subcategory2Text, 
            submitSubcategoryForm: 44
        },
        success: function (data) {
            if(data==1){ 
                toastr.success("Subcategory 3 added successfully.");
                $('#subcategoryaddedform')[0].reset(); 
                $('#subcategory2').html('<option value="">Select Subcategory 2</option>');
                $('#subcategory11').html('<option value="">Select Subcategory 1</option>');
                showOffErrorData(); 
                 
            }
            else if(data==12){
                toastr.error("Subcategory 3 already exists.");
               // $('#subcategoryaddedform')[0].reset(); 
            }
            else {
                console.clear(); 
                console.log(data); 
                alert(data); 
            }
        },
        error: function (err) {
            toastr.error("Error submitting form: " + err);
        }
    });

   }); 

   
});