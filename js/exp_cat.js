$(document).ready(function(){


    const showOffExpenseCategories = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { fetchExpenseCategories: 44 },
            success: function(response) {
                $('#showexpcat').html(response);
            },
            error: function(xhr, status, error) {
                toastr.error('Failed to fetch expense categories.');
            }
        });
    }

    showOffExpenseCategories();

    $('body').on('click','.deleteExpenseCategories',function(){
        let myid= $(this).attr('myid'); 
        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { myid: myid, deleteLineup:55 },
                success: function(response) {
                    if (response == 1) {
                        toastr.success('Category deleted successfully!');
                        showOffExpenseCategories();
                    } else {
                        toastr.error('Failed to delete category.');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error: ' + error);
                }
            });
        }
    }); 


    $('body').on('click','.editExpenseCategories',function(){
        let myid = $(this).attr('myid'); 
        let category_name = $(this).attr('category_name'); 
        let show_cashier = $(this).attr('show_cashier');
 
        $('#urllight').val(category_name);
        $('#urlshowcashier').val(show_cashier);
        sessionStorage.setItem("urlscategory_id",myid);

        $('#editCategoryModal').modal('show'); 
    }); 

    $('#updateCatexp').on('submit',function(e){
         e.preventDefault(); 
         let ucategoryName = $('#urllight').val(); 
         let ushow_cashier = $('#urlshowcashier').val(); 
         
            let categoryId = sessionStorage.getItem("urlscategory_id");

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    categoryId: categoryId,
                    ucategoryName: ucategoryName,
                    ushow_cashier: ushow_cashier,
                    updateExpenseCategory: 1
                },
                success: function(response) {
                    if (response == 1) {
                        toastr.success('Category updated successfully!');
                        $('#updateCatexp')[0].reset();
                        $('#editCategoryModal').modal('hide');
                        showOffExpenseCategories();
                    } else if (response == 12) {
                        toastr.error('Category already exists!');
                        $('#ucategoryName').css('border', '2px solid red').focus();
                    } else {
                        toastr.error(response);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error: ' + error);
                }
            });

    }); 

    $('#saveExpenseCategory').on('submit',function(e){
        e.preventDefault();
        let categoryName= $('#categoryName').val(); 
        let show_cashier = $('#show_cashier').val(); 

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
            categoryName: categoryName,
            show_cashier: show_cashier,
            expenseCategorysection: 44
            },
            success: function(response) {
            if (response == 1) {
                toastr.success('Category saved successfully!');
                $('#saveExpenseCategory')[0].reset();
               $('#categoryName').focus();
              showOffExpenseCategories();

            } else if (response == 12) {
                toastr.error('Category already exists!');
                $('#categoryName').css('border', '2px solid red').focus();

            } else {
                toastr.error(response);
            }
            },
            error: function(xhr, status, error) {
            toastr.error('Error: ' + error);
            }
        });

    }); 



}); //End of script 