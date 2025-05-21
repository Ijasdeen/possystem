$(document).ready(function(){


    const showoffExpenses = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { fetchExpenses: 44 },
            success: function(response) {
                $('#showExpenses').html(response);
            },
            error: function(xhr, status, error) {
                toastr.error('Failed to fetch expenses.');
            }
        });
    }

    showoffExpenses(); 


 $('body').on('click', '.editExpenses', function () {
    let myid = $(this).attr('myid'); 
   
    let amount = $(this).attr('amount');
    let reason = $(this).attr('reason');
    let date = $(this).attr('date');
    let expcat_id_fk = $(this).attr('expcat_id_fk');

 
     $("#uexp_cat").val(expcat_id_fk); 
     $('#uamount').val(amount);
    $('#ureason').val(reason);
    $('#udate').val(date);

    sessionStorage.setItem("expense_id", myid);

    $("#editModal").modal('show'); 
});

$('#expenseUpdate').on('submit',function(e){
    e.preventDefault(); 
    let uamount = $('#uamount').val(); 
    let ureason = $('#ureason').val(); 
    let udate = $('#udate').val(); 
    let uexp_cat = $('#uexp_cat').val(); 

    if (isNaN(uamount)) {
        toastr.error("Amount must be a number.");
        return; 
    }

    if (uamount <= 0) {
        toastr.error("Amount must be greater than zero.");
        return; 
    }
    if (!uexp_cat) {
        toastr.error("Expense category is required.");
        return; 
    }

    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            updateExpense: 6545,
            uamount: uamount,
            ureason: ureason,
            udate: udate,
            uexp_cat: uexp_cat,
            myid: sessionStorage.getItem("expense_id")
        },
        success: function(response) {
            if (response == 1) {
                toastr.success("Expense updated successfully.");
                $('#expenseUpdate')[0].reset();
                $('#uexp_cat').focus();
                $("#editModal").modal('hide');
                showoffExpenses(); 
            } else {
                toastr.error(response || "Failed to update expense.");
            }
        },
        error: function(xhr, status, error) {
            toastr.error("An error occurred while updating the expense.");
        }
    });
}); 


    $('body').on('click','.deleteExpenses',function(){
        let myid= $(this).attr('myid'); 
        if (confirm('Are you sure you want to delete this expense?')) {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { myid: myid, deleteExpenses:55 },
                success: function(response) {
                    if (response == 1) {
                        toastr.success('Expense deleted successfully!');
                        showoffExpenses();
                    } else {
                        toastr.error(response || 'Failed to delete expense.');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error: ' + error);
                }
            });
        }
    }); 
    $('#expensessave').on('submit',function(e){
        e.preventDefault(); 
        let exp_cat = $('#exp_cat').val(); 
        let amount = $('#amount').val(); 
        let reason = $('#reason').val(); 
        let date= $('#date').val(); 
 
        if(isNaN(amount)){
            toastr.error("Amount must be a number.");
            return; 
        }

        if (amount <= 0) {
            toastr.error("Amount must be greater than zero.");
            return; 
        }
        if (!exp_cat) {
            toastr.error("Expense category is required.");
            return; 
        }

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
            sendactionlineupsaveform: 6545,
            exp_cat: exp_cat,
            amount: amount,
            reason: reason,
            date: date
            },
            success: function(response) {
            if (response ==1) {
                toastr.success("Expense saved successfully.");
                $('#expensessave')[0].reset();
                $('#exp_cat').focus();
                showoffExpenses(); 
            } else {
                toastr.error(response || "Failed to save expense.");
            }
            },
            error: function(xhr, status, error) {
            toastr.error("An error occurred while saving the expense.");
            }
        });

    }); 
}); 