$(document).ready(function() {
    const showOffCategories = () => {
        $.ajax({
        url: 'action.php',
        type: 'POST',
        data: { fetchCategories: 223 },
        success: function(data) {
            $('#showcategories').html(data);  
        },
        error: function() {
            toastr.error("Failed to fetch categories. Please try again.");
        }
        });
    };

   
    showOffCategories();


    $('body').delegate('.deleteCategory','click',function(){
        let myid = $(this).attr('myid'); 
        
        if(confirm("Are you sure you want to delete it?")){
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { deleteCategory: myid, categoryDelete:55 },
                success: function(response) {
                    if (response == 1) {
                        toastr.success("Category deleted successfully.");
                        showOffCategories(); // Refresh the categories list
                    } else {
                        toastr.error("Failed to delete category. Please try again.");
                    }
                },
                error: function() {
                    toastr.error("An error occurred while deleting the category.");
                }
            });
        }

    }); 


    $('body').on('click', '.editCategory', function() {
        let categoryId = $(this).attr('myid');
        let categoryName = $(this).attr('name');
        let categoryCode = $(this).attr('code');

        $('#editCategoryName').val(categoryName); 
        $('#editCategoryCode').val(categoryCode); 
        sessionStorage.setItem("category_id",categoryId); 
         
        $('#editCategoryModal').modal('show');
    });


    $('#editCategoryForm').submit(function(e){
        e.preventDefault(); 
        let categoryId = sessionStorage.getItem("category_id");
        let categoryName = $('#editCategoryName').val();
        let categoryCode = $('#editCategoryCode').val();

        if (categoryName === '') {
            toastr.error("Please enter the category name");
            $('#editCategoryName').css('border', '2px solid red').focus();
            return false;
        }

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                updateCategoryId: categoryId,
                updateCategoryName: categoryName,
                updateCategoryCode: categoryCode,
                updateCategory: 1
            },
            success: function(response) {
                if (response == 1) {
                    toastr.success("Category updated successfully.");
                    $('#editCategoryModal').modal('hide');
                    $('#editCategoryForm')[0].reset();
                   
                    showOffCategories();
                } else if (response == 12) {
                    toastr.info("Category with the same name already exists.");
                    $('#editCategoryName').css('border', '2px solid red').focus();
                } else {
                    toastr.error("Failed to update category. Please try again.");
                }
            },
            error: function() {
                toastr.error("An error occurred while updating the category.");
            }
        });
    })

 
    $('#editCategoryForm').on('submit', function(e) {
        e.preventDefault();

        let categoryId = $('#editCategoryId').val();
        let categoryName = $('#editCategoryName').val();
        let categoryCode = $('#editCategoryCode').val();

        if (categoryName === '') {
            toastr.error("Please enter the category name");
            $('#editCategoryName').css('border', '2px solid red').focus();
            return false;
        }

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                updateCategoryId: categoryId,
                updateCategoryName: categoryName,
                updateCategoryCode: categoryCode,
                updateCategory: 1
            },
            success: function(response) {
                if (response == 1) {
                    toastr.success("Category updated successfully.");
                    $('#editCategoryModal').modal('hide');
                    $('#editCategoryForm')[0].reset();
                    showOffCategories();
                } else if (response == 12) {
                    toastr.info("Category with the same name already exists.");
                    $('#editCategoryName').css('border', '2px solid red').focus();
                } else {
                    toastr.error("Failed to update category. Please try again.");
                }
            },
            error: function() {
                toastr.error("An error occurred while updating the category.");
            }
        });

        
    });
 

    $('#addCategoryFormsectionss').on('submit', function(e) {
    e.preventDefault(); 
    let categoryName = $('#categoryName').val();
    let categoryCode = $('#categoryCode').val();

    if (categoryName === '') {
        toastr.error("Please enter the category name");
        $('#categoryName').css('border', '2px solid red').focus(); 
        return false; 
    }


    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            categoryName: categoryName,
            categoryCode: categoryCode, 
            saveAddCategoryform: 55
        },
        success: function(data) {
            if (data == 1) {
                $('#addCategoryFormsectionss')[0].reset(); // Reset the form
                $('#categoryName').focus(); 
                toastr.success("Saved successfully"); 
                showOffCategories();
            } else if (data == 12) {
                toastr.info("Category with same name already exists"); 
                $('#categoryName').css('border', '2px solid red').focus(); 
            } else {
                toastr.info(data); 
            }
        },
        error: function() {
            Toastify({
                text: "An error occurred while adding the category.",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#F44336"
            }).showToast();
        }
    });
});

 


});