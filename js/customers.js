$(document).ready(function() {
    // Initialize customer-related functionality here

     const showOffCustomers = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { fetchCustomers: 44 },
            success: function(response) {
            // Handle the response, e.g., display customers
            $('#showCustomers').html(response);
            },
            error: function(xhr, status, error) {
            toastr.error('Failed to fetch customers.');
            }
        });
     }

     showOffCustomers(); 


       $('body').on('click','.editCustomers',function(){
        let customerId = $(this).attr('myid'); 
        let customerName = $(this).attr('customer_name'); 
        let customerMobile = $(this).attr('customer_mobile'); 
        let customerNic = $(this).attr('customer_nic'); 
        let customerCredit = $(this).attr('credit'); 
        let customerDebit = $(this).attr('debit'); 
        let customerGender = $(this).attr('gender'); 

        let dob= $(this).attr('dob'); 

 
        $('#ucustomer_name').val(customerName);
        $('#ucustomer_mobile').val(customerMobile);
        $('#ucustomer_nic').val(customerNic);
        $('#ucredit').val(customerCredit);
        $('#udebit').val(customerDebit);
        $('#udob').val(dob); 
        $('#ucustomer_nic').val(customerNic);
        $('#ugender').val(customerGender);
        sessionStorage.setItem("customer_id",customerId);

        $('#updateCategoryModal').modal('show');


       }); 


       
   $('#customersSearchdetails').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#showCustomers tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });



       $('#updateCustomersform').on('submit',function(e){
            e.preventDefault();
             let customer_name = $('#ucustomer_name').val(); 
             let customer_mobile = $('#ucustomer_mobile').val(); 
                let customer_nic= $('#ucustomer_nic').val();
                let credit = $('#ucredit').val();
                let debit= $('#udebit').val();
                let dob = $('#udob').val();
             
                let ugender = $('#ugender').val();
                let customer_id = sessionStorage.getItem("customer_id");

                if(isNaN(customer_mobile)){
                    toastr.info('Please enter a valid mobile number.');
                    $('#ucustomer_mobile').css('border', '2px solid red').focus();
                    return;
                }
                if(customer_mobile.length !=10){
                    toastr.info('Mobile number should be 10 digits.');
                    $('#ucustomer_mobile').css('border', '2px solid red').focus();
                    return;
                }

 
                $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: {
                        customer_id: customer_id,
                        customer_name: customer_name,
                        customer_mobile: customer_mobile,
                        dob: dob,
                        customer_nic: customer_nic,
                        credit: credit,
                        debit: debit,
                        gender: ugender,
                        updateCustomersection: 554
                    },
                    success: function(response) {
                        if (response == 1) {
                            toastr.success('Customer updated successfully!');
                            $('#updateCustomersform')[0].reset();
                            $('#updateCategoryModal').modal('hide');
                            showOffCustomers();
                        } else if (response == 12) {
                            toastr.info('Customer already exists!');
                            $('#ucustomer_mobile').css('border', '2px solid red').focus();
                        } else {
                            toastr.error(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred while updating the customer.');
                    }
                });


       }); 

     $('body').on('click','.deleteCustomers',function(){
        let myid = $(this).attr('myid'); 
        if(confirm("Are you sure you want to delete it?")){
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { deleteCustomer: myid, customerDelete:55 },
                success: function(response) {
                    if (response == 1) {
                        toastr.info("Customer deleted successfully.");
                        showOffCustomers(); // Refresh the customers list
                    } 
                   
                    else {
                        toastr.error(response);
                    }
                },
                error: function() {
                    toastr.error("An error occurred while deleting the customer.");
                }
            });
        }
     }); 

     

    $('#saveCustomersform').on('submit',function(e){
            e.preventDefault(); 
            let customer_name = $('#customer_name').val(); 
            let customer_mobile = $('#customer_mobile').val();
            let dob= $('#dob').val(); 
            let customer_nic= $('#customer_nic').val(); 
            let credit = $('#credit').val(); 
            let debit= $('#debit').val(); 
            let gender= $('#gender').val(); 

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    customer_name: customer_name,
                    customer_mobile: customer_mobile,
                    dob: dob,
                    customer_nic: customer_nic,
                    credit: credit,
                    debit: debit,
                    gender: gender,
                    saveCustomersection: 553
                },
                success: function(response) {
                    if (response == 1) {
                       toastr.success('Customer saved successfully!');
                    $('#saveCustomersform')[0].reset();
                    $('#customer_name').focus();
                      $('#customer_mobile').css('border', '');   

                    } 
                    else if(response==12){
                        toastr.info('Customer already exists!');
                        $('#customer_mobile').css('border', '2px solid red').focus();   


                    }
                    else {
                        toastr.error(response);
                    }
                   
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while saving the customer.');
                    $('#customer_name').focus();
                }
            });

    }); 


    // Add your customer-specific code below
});