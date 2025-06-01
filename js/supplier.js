$(document).ready(function(){


    const showOffSuppliers = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { fetchSuppliers: 44 },
            success: function(response) {
                 $('#extractsuppliers').html(response);
            },
            error: function(xhr, status, error) {
                toastr.error('Failed to fetch suppliers.');
            }
        });
    }

    showOffSuppliers(); 

   $('#searchSuppliers').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#extractsuppliers tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });



    $('body').on('click', '.viewbankdetailssection', function() {
    let bank_id = Number($(this).attr('bank_id'));
       $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { bank_id: bank_id, viewbankdetails:55 },
            success: function(response) {
                 $('#myModal').modal('show'); 
                 $('#accountNamesection').html(response); 

             
            },
            error: function(xhr, status, error) {
                toastr.error('Failed to fetch suppliers.');
            }
        });
    
});

    const getBankdetailsdata = (supplier_id_fk) => {
       
        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                getBankdetailsdata:55, 
                supplier_id_fk:supplier_id_fk
            },
            success:function(data){
                 $('#uaddedBankdetailssection').html(data); 

            },
            error:function(err){
                alert("Error found in"  +err); 
            }
        })
    }
 


  
    $('body').delegate('.suppliereditbuttonsection', 'click', function () {
    let supplier_name = $(this).attr('supplier_name');
    let mobile = $(this).attr('mobile');
    let telephone = $(this).attr('telephone');
    let address = $(this).attr('address');
    let short_name = $(this).attr('short_name');
    let email = $(this).attr('email');
    let contact_name = $(this).attr('contact_name');
    let contact_number1 = $(this).attr('contact_number1');
    let contact_number2 = $(this).attr('contact_number2');
    let supplier_category = $(this).attr('supplier_category');
    let warehouse_address = $(this).attr('warehouse_address');

    sessionStorage.setItem('supplier_id',$(this).attr('myid')); 
    getBankdetailsdata($(this).attr('myid')); 

     
    $('#usupplier_name').val(supplier_name);
    $('#umobile').val(mobile);
    $('#utelephone').val(telephone);
    $('#uaddress').val(address);
    $('#ushort_name').val(short_name);
    $('#eumail').val(email);
    $('#ucontactperson_name').val(contact_name);
    $('#ucontactperson_mobile').val(contact_number1);
    $('#ucontactperson_mobile2').val(contact_number2);
    $('#uwarehouse_address').val(warehouse_address);
    $('#usupplier_type').val(supplier_category);

 
    $('#editModal').modal('show'); 
});


    $('body').on('click','.uremoveBankdetails',function(){
          let myid = $(this).attr('myid'); 
          let supplier_id_fk = $(this).attr('supplier_id_fk'); 

         if(confirm("Are you sure you want to delete it?")){
                $.ajax({
                    url : 'action.php', 
                    method:'POST', 
                    data:{
                        myid:myid, 
                        removeBankdetails:55 
                    },
                    success:function(data){
                        if(data==1){
                            toastr.error("Bank detail has been removed"); 
                            getBankdetailsdata(supplier_id_fk); 
                           
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

    $('body').delegate('.deleteSupplier','click',function(){
        let supplier_id_fk =$(this).attr('supplier_id_fk'); 
        if(confirm("Are you sure you want to delete it?")){
             $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { supplier_id_fk: supplier_id_fk, deleteSuppliersection:55 },
            success: function(response) {
                    if(response==1){
                        toastr.error("Deleted successfully");
                        showOffSuppliers(); 
                    } 
                    else {
                        alert(response); 
                    }
                
            },
            error: function(xhr, status, error) {
                toastr.error('Failed to fetch suppliers.');
            }
        });
        
        }
    }); 

       const updateBankDetails = (supplier_id) => {
         let bankDetails = [];
        $('.ubank-detail-entry').each(function() {
            let accountName = $(this).find('.ubankAccountName').val();
            let accountNo = $(this).find('.ubankAccountNo').val();
            let bankName = $(this).find('.ubankname').val();
            let branchName = $(this).find('.ubranchName').val();
            if (accountName && accountNo && bankName && branchName) {
                bankDetails.push({
                    accountName: accountName,
                    accountNo: accountNo,
                    bankName: bankName,
                    branchName: branchName
                });
            }
        });

        if (bankDetails.length > 0) {
            
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    updateBankaccount: 1,
                    supplierId: supplier_id,
                    bankDetails: JSON.stringify(bankDetails)
                },
                success: function(response) {
                     console.log(response); 
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to save bank details: ' + error);
                }
            });
        }
            
      }

    function saveBankDetails(supplierId) {
        let bankDetails = [];
        $('.bank-detail-entry').each(function() {
            let accountName = $(this).find('.bankAccountName').val();
            let accountNo = $(this).find('.bankAccountNo').val();
            let bankName = $(this).find('.bankname').val();
            let branchName = $(this).find('.branchName').val();
            if (accountName && accountNo && bankName && branchName) {
                bankDetails.push({
                    accountName: accountName,
                    accountNo: accountNo,
                    bankName: bankName,
                    branchName: branchName
                });
            }
        });

        if (bankDetails.length > 0) {
            
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    saveBankDetailssectionlineup: 1,
                    supplierId: supplierId,
                    bankDetails: JSON.stringify(bankDetails)
                },
                success: function(response) {
                   
                    console.log(response);

                 
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to save bank details: ' + error);
                }
            });
        }
    }



    function saveBankDetailsinupdatesection(supplierId) {
        let bankDetails = [];
        $('.ulsubank-detail-entry').each(function() {
            let accountName = $(this).find('.ulsbankAccountName').val();
            let accountNo = $(this).find('.ulsbankAccountNo').val();
            let bankName = $(this).find('.ulsbankname').val();
            let branchName = $(this).find('.ulsbranchName').val();
            if (accountName && accountNo && bankName && branchName) {
                bankDetails.push({
                    accountName: accountName,
                    accountNo: accountNo,
                    bankName: bankName,
                    branchName: branchName
                });
            }
        });

        if (bankDetails.length > 0) {
            
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    saveBankDetailssectionlineup: 1,
                    supplierId: supplierId,
                    bankDetails: JSON.stringify(bankDetails)
                },
                success: function(response) {
                    console.clear(); 
                    console.log(response);

                    $('#supplierUpdateForm')[0].reset();
                    $('#uaddedBankdetailssection').empty();
                    $('#editModal').modal('hide'); 
                   
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to save bank details: ' + error);
                }
            });
        }
    }

    

    $('#supplierSaveform').on('submit',function(e){
        e.preventDefault(); 
        let supplier_name = $("#supplier_name").val(); 
        let address = $('#address').val(); 
        let mobile = $("#mobile").val(); 
        let telephone = $('#telephone').val(); 
        let short_name = $('#short_name').val(); 
        let email= $('#email').val(); 
        let contactperson_name = $('#contactperson_name').val(); 
        let contactperson_mobile2 = $('#contactperson_mobile2').val(); 
        let warehouse_address = $('#warehouse_address').val(); 
        let supplier_type = $('#supplier_type').val();
        let contactperson_mobile = $('#contactperson_mobile').val(); 


        if(contactperson_mobile!=''){
            if(contactperson_mobile.length!=10){
            toastr.info('Contact person mobile number should be 10 digits.');
            $('#contactperson_mobile').css('border', '2px solid red').focus();
            return;
        }
        if(isNaN(contactperson_mobile)){
            toastr.info('Please enter a valid contact person mobile number.');
            $('#contactperson_mobile').css('border', '2px solid red').focus();
            return;
        }

        }
 

        if(contactperson_mobile2!=''){
            if(contactperson_mobile2.length!=10){
            toastr.info('Contact person mobile number 2 should be 10 digits.');
            $('#contactperson_mobile2').css('border', '2px solid red').focus();
            return;
        }
        if(isNaN(contactperson_mobile2)){
            toastr.info('Please enter a valid contact person mobile number 2.');
            $('#contactperson_mobile2').css('border', '2px solid red').focus();
            return;
        }
        }

 
        $('.bankAccountName').each(function() {
            let bankAccountName = $(this).val();
            if (bankAccountName === '') {
                $(this).css('border', '2px solid red').focus();
                toastr.error('Please fill in all bank account names.');
                return false;
            }
        });
        $('.bankAccountNo').each(function() {
            let bankAccountNo = $(this).val();
            if (bankAccountNo === '') {
                $(this).css('border', '2px solid red').focus();

                toastr.error('Please fill in all bank account numbers.');
                return false;
            }
        });

        $('.bankname').each(function() {
            let bankname = $(this).val();
            if (bankname === '') {
                $(this).css('border', '2px solid red').focus();

                toastr.error('Please fill in all bank names.');
                return false;
            }
        });
        $('.branchName').each(function() {
            let branchName = $(this).val();
            if (branchName === '') {
                $(this).css('border', '2px solid red').focus();
                 toastr.error('Please fill in all branch names.');
                return false;
            }
        });

        if(supplier_name == '') {
            toastr.error('Please enter supplier name.');
            $('#supplier_name').css('border', '2px solid red').focus();
            return false;
        }

        if(mobile == '') {
            toastr.error('Please enter mobile number.');
            $('#mobile').css('border', '2px solid red').focus();
            return false;
        }

        $.ajax({
            url : 'action.php', 
            method:'POST', 
            data:{
                saveSupplierSectionslength22: 11,
                supplier_name: supplier_name,
                address: address,
                mobile: mobile,
                telephone: telephone,
                short_name: short_name,
                email: email,
                contactperson_name: contactperson_name,
                contactperson_mobile2: contactperson_mobile2,
                warehouse_address: warehouse_address,
                contactperson_mobile:contactperson_mobile, 
                supplier_type: supplier_type
            },
            success:function(data){
                    if(data == "exist") {
                    toastr.info('Supplier already exists with same mobile number!');
                    $('#mobile').css('border', '2px solid red').focus();
                } else {
                      saveBankDetails(data);
                       $('#supplierSaveform')[0].reset();
                    $('#addedBankdetailssection').empty();
                    toastr.success('Supplier saved successfully!');
                    $('#supplier_name').focus(); 
                }
            },
            error:function(xhr, status, error){
                toastr.error('Error saving supplier: ' + error);
            }
        })

    }); 

   

     $(document).on('submit', '#supplierUpdateForm', function(e) {
    e.preventDefault();

    // Get form values
    var usupplier_name = $('#usupplier_name').val();
    var uaddress = $('#uaddress').val();
    var umobile = $('#umobile').val();
    var utelephone = $('#utelephone').val();
    var ushort_name = $('#ushort_name').val();
    var eumail = $('#eumail').val();
    var ucontactperson_name = $('#ucontactperson_name').val();
    var ucontactperson_mobile = $('#ucontactperson_mobile').val();
    var ucontactperson_mobile2 = $('#ucontactperson_mobile2').val();
    var uwarehouse_address = $('#uwarehouse_address').val();
    var usupplier_type = $('#usupplier_type').val();
    var supplier_id = sessionStorage.getItem('supplier_id'); 
  
    var formData = {
        updateSuppliersection22: 22,
        usupplier_name,
        supplier_id, 
        uaddress,
        umobile,
        utelephone,
        ushort_name,
        eumail,
        ucontactperson_name,
        ucontactperson_mobile,
        ucontactperson_mobile2,
        uwarehouse_address,
        usupplier_type,
        
    };

    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
           if (response.status == 'success') {
            let supplierId = response.supplier_id;  
             updateBankDetails(supplierId); 
            saveBankDetailsinupdatesection(supplierId); 

               toastr.info("Supplier Updated successfully"); 
              
                    $('#supplierUpdateForm')[0].reset();
                    $('#uaddedBankdetailssection').empty();
                    $('#editModal').modal('hide'); 
                    showOffSuppliers();
           
        } else {
            toastr.error(response.message || 'Update failed');
        }
        },
        error: function(xhr, status, error) {
            toastr.error('Something went wrong: ' + error);
        }
    });
});


    $('body').on('click','.editSuppliers',function(){
            let myid = $(this).attr('myid');
            let supplier_name = $(this).attr('supplier_name');
            let supplier_mobile = $(this).attr('supplier_mobile');
            let supplier_company = $(this).attr('supplier_company');
            let supplier_credit = $(this).attr('supplier_credit');
            let supplier_debit = $(this).attr('supplier_debit');
            let supplier_city = $(this).attr('supplier_city');

            $('#usupplier_name').val(supplier_name);
            $('#usupplier_mobile').val(supplier_mobile);
            $('#usupplier_company').val(supplier_company);
            $('#usupplier_credit').val(supplier_credit);
            $('#usupplier_debit').val(supplier_debit);
            $('#uusupplier_city').val(supplier_city);
            sessionStorage.setItem("supplier_id",myid);
            $('#updateSuppliersModal').modal('show');
    }); 
 
 
    $(document).on('click', '.removeBankdetails', function() {
        if(confirm('Are you sure you want to remove this bank detail?')) {
            $(this).closest('.bank-detail-entry').remove();
        }
 
}

);


    $(document).on('click', '.ulsremoveBankdetails', function() {
        if(confirm('Are you sure you want to remove this bank detail?')) {
            $(this).closest('.ubank-detail-entry').remove();
        }
 
}

);


    $('#uaddedBank').on('click',function(){

         let html = `
    <div class="ubank-detail-entry" style="position: relative; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <button type="button" class="btn btn-danger btn-sm ulsremoveBankdetails" style="position: absolute; top: 5px; right: 5px;">X</button>
        <div class="form-group">
            <label for="">Bank Account Name</label>
            <input type="text" name="accountNo"  class="form-control ubankAccountName">
        </div>
        <div class="form-group">
            <label for="">Account NO</label>
            <input type="tel" class="form-control ubankAccountNo" >
        </div>
        <div class="form-group">
            <label for="">Bank</label>
            <input type="tel" name="bankname"  class="form-control ubankname">
        </div>
        <div class="form-group">
            <label for="">Branch</label>
            <input type="tel" name="branchName"  class="form-control ubranchName">
        </div>
    </div>`;
    
    $('#uaddedBankdetailssection').append(html);

    }); 


        $('#addedBank').on('click', function() {
    let html = `
    <div class="bank-detail-entry" style="position: relative; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <button type="button" class="btn btn-danger btn-sm removeBankdetails" style="position: absolute; top: 5px; right: 5px;">X</button>
        <div class="form-group">
            <label for="">Bank Account Name</label>
            <input type="text" name="accountNo"  class="form-control bankAccountName">
        </div>
        <div class="form-group">
            <label for="">Account NO</label>
            <input type="tel" class="form-control bankAccountNo" >
        </div>
        <div class="form-group">
            <label for="">Bank</label>
            <input type="tel" name="bankname"  class="form-control bankname">
        </div>
        <div class="form-group">
            <label for="">Branch</label>
            <input type="tel" name="branchName"  class="form-control branchName">
        </div>
    </div>`;
    
    $('#addedBankdetailssection').append(html);
});

 
 
    $('#updateSupplierform').on('submit',function(e){
            e.preventDefault(); 

            let supplier_name = $('#usupplier_name').val();
            let supplier_mobile = $('#usupplier_mobile').val();
            let supplier_company = $('#usupplier_company').val();
            let supplier_credit = $('#usupplier_credit').val();
            let supplier_debit = $('#usupplier_debit').val();
            let supplier_city = $('#uusupplier_city').val();
            let supplier_id = sessionStorage.getItem("supplier_id");

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    updateSupplier: 22,
                    supplier_id: supplier_id,
                    supplier_name: supplier_name,
                    supplier_mobile: supplier_mobile,
                    supplier_company: supplier_company,
                    supplier_credit: supplier_credit,
                    supplier_debit: supplier_debit,
                    supplier_city: supplier_city
                },
                success: function(response) {
                    if(response == 1) {
                        toastr.success('Supplier updated successfully!');
                        $('#updateSuppliersModal').modal('hide');
                        showOffSuppliers();
                        return false; 
                    } else if(response == 12) {
                        toastr.info('Supplier already exists with same mobile number!');
                        $('#usupplier_mobile').css('border', '2px solid red').focus();
                        return false; 
                    } else {
                        toastr.error(response);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error updating supplier: ' + error);
                }
            });

    }); 

    $('body').on('click','.deleteSuppliers',function(){
            let myid = $(this).attr('myid'); 

            if(confirm('Are you sure you want to delete this supplier?')) {
                $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: { deleteSupplier: 111, myid: myid },
                    success: function(response) {
                        if(response == 1) {
                            toastr.success('Supplier deleted successfully!');
                            showOffSuppliers();
                        } else {
                            toastr.error('Failed to delete supplier.');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error deleting supplier: ' + error);
                    }
                });
            }

    }); 

   
}); 