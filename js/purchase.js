$(document).ready(function () {
    const showOffSuppliers = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { showOffSuppliers: true },
            success: function (response) {
                console.log(response); 
                $('#chooseSupplierDropdown').html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Failed to load suppliers. Please try again.");
            }
        });
    };


        const showoffColors = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { showoffColors: 232 },
            success: function (response) {
                console.log(response); 
                $('#color').html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Failed to load suppliers. Please try again.");
            }
        });
    };


    
        const showoffBrands = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { showoffBrands: 232 },
            success: function (response) {
               
                $('#brand').html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Failed to load suppliers. Please try again.");
            }
        });
    };


    
        const showoffUnits = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { showoffUnits: 232 },
            success: function (response) {
               
                $('#unit').html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Failed to load suppliers. Please try again.");
            }
        });
    };

      $('#sizeName').on('keydown', function (e) {
      if (e.key === 'Enter') {
        let value = $(this).val().trim();
        if(value=='' || !value){
            toastr.error("Please enter the size name");
            return false;
        }
        e.preventDefault(); // Prevent form submission
        $('#warehouseName').focus();
      }
    });


  totalQuantity = 0;

$('#warehouseName').on('keydown', function (e) {
  if (e.key === 'Enter') {
    let warehouse = $(this).val().trim();
    let sizeName = $('#sizeName').val().trim();
    let quantity = $('#warehouseName').val().trim();

    if (!warehouse) {
      toastr.error("Please enter the warehouse name");
      return false;
    }
    if (!sizeName) {
      toastr.error("Please enter the size name");
      $('#sizeName').focus();
      return false;
    }
    if (!quantity || isNaN(quantity) || quantity <= 0) {
      toastr.error("Please enter a valid quantity");
      $('#quantity').focus();
      return false;
    }

    e.preventDefault();

    // Get current row count and increment for serial number
    let rowCount = $('#sizeTable tbody tr').length + 1;

    // Update total quantity
    totalQuantity += parseInt(quantity);

 $('#myquantity').val(totalQuantity); // Update the total quantity input

    // Build row HTML
    let html = `<tr>
                  <td>${rowCount}</td>
                  <td>${sizeName}</td>
                  <td>${warehouse}</td>
                
                  <td>
                    <button class="btn btn-danger btn-sm deleteRow">Delete</button>
                  </td>
                </tr>`;

    // Append to table
    $('#sizeTable tbody').append(html);

    // Clear inputs and refocus
    $('#sizeName').val('').focus();
    $('#warehouseName').val('');
    $('#quantity').val('');
  }
});


 
// Delete row and update total quantity
$('#sizeTable').on('click', '.deleteRow', function () {
  // Get the quantity of the row being deleted (4th column = index 3)
  let qty = parseInt($(this).closest('tr').find('td:eq(3)').text()) || 0;

  // Subtract from totalQuantity
  totalQuantity -= qty;

  // Remove the row
  $(this).closest('tr').remove();

  // Reorder serial numbers
  $('#sizeTable tbody tr').each(function (index) {
    $(this).find('td:first').text(index + 1);
  });

 
  $('#myquantity').val(totalQuantity); // optional live update
});


const getInvoiceNumber = () => {
     let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth() + 1; // Months are zero-based
    let day = date.getDate();
    let formattedMonth = month < 10 ? '0' + month : month;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: { getLastPurchaseId: 44 },
        success: function(response) {
            console.log("Last Purchase ID:", response);
             $('#purchaseInvoiceNo').val(`1${year}${formattedMonth}${day}` + response);
          
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}



getInvoiceNumber(); 
    showoffColors(); 
    showoffBrands(); 
    showoffUnits(); 
     showOffSuppliers();


    const saveOffSizes = (myid) => {
        let sizes = [];
        $('#sizeTable tbody tr').each(function () {
            let sizeName = $(this).find('td:eq(1)').text().trim();
            let warehouse = $(this).find('td:eq(2)').text().trim();
            sizes.push({ sizeName, warehouse });
        });
        if (sizes.length == 0) {
            toastr.info("No data found"); 
            return false;
        }

        // Send AJAX request if sizes exist
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { saveSizes: 44, sizes: JSON.stringify(sizes),myid: myid },
            success: function(response) {
                toastr.success("Sizes saved successfully!");
                console.log(response);
            },
            error: function(xhr, status, error) {
                toastr.error("Failed to save sizes. Please try again.");
                console.error("AJAX Error:", status, error);
            }
        });

       
    }

    const showoffcategory = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { showoffcategory: 232 },
            success: function (response) {
                $('#category').html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Failed to load categories. Please try again.");
            }
        });
    }

    showoffcategory(); 

    $('#category').on('change', function () {
        let categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { showoffsubcategory1: 55, categoryId: categoryId },
                success: function (response) {
                    $('#subcategory1').html(response);
                },
                error: function (status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("Failed to load subcategories. Please try again.");
                }
            });
        }  
        else {
            $('#subcategory1').html('<option value="">Select Subcategory 1</option>');
            $('#subCategory2').html('<option value="">Select Subcategory 2</option>');
            $('#subcategory_3').html('<option value="">Select Subcategory 3</option>');
        }
    });

    $('#subcategory1').on('change', function () {
        let subcategory1Id = $(this).val();
        if (subcategory1Id) {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { showoffsubcategory2: 55, subcategory1Id: subcategory1Id },
                success: function (response) {
                    $('#subCategory2').html(response);
                },
                error: function (status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("Failed to load subcategories. Please try again.");
                }
            });
        }  else {
            $('#subCategory2').html('<option value="">Select Subcategory 2</option>');
            $('#subcategory_3').html('<option value="">Select Subcategory 3</option>');
        }
    });

    $('#subCategory2').on('change', function () {
        let subCategory2Id = $(this).val();
    
        if (subCategory2Id) {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { showoffsubcategory322: 55, subCategory2Id: subCategory2Id },
                success: function (response) {
                    $('#subcategory_3').html(response);
                },
                error: function (status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("Failed to load subcategories. Please try again.");
                }
            });
        } else {
            $('#subcategory_3').html('<option value="">Select Subcategory 3</option>');
        }
    });

    
    const showoffSavedItems = (myid) => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { showoffSavedItems: 44,myid:myid },
            success: function (response) {
                $('#addedProducts').html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Failed to load saved items. Please try again.");
            }
        });
    }

    $('#savePurchaseform').on('submit',function(e){
        e.preventDefault(); 
        const barcode = $('#barcode').val();
        const itemCode = $('#itemCode').val();
        const invoiceItemName = $('#invoiceItemName').val();
        const itemName = $('#itemName').val();
        const tagName = $('#tagName').val();
        const category = $('#category').val();
        const subcategory1 = $('#subcategory1').val();
        const subCategory2 = $('#subCategory2').val();
        const subcategory3 = $('#subcategory_3').val();
        const color = $('#color').val();
        const brand = $('#brand').val();
        const unit = $('#unit').val();

        const quantity = $('#myquantity').val();
        const costPrice = $('#costPrice').val();
        const retailMiniPrice = $('#retailMiniPrice').val();
        const retailPrice = $('#retailPrice').val();
        const retailDiscount = $('#retailDiscount').val();
        const retailDiscountPercent = $('#retailDiscountPercent').val();
        const salePrice = $('#salePrice').val();

        let supplierInvoiceDate = $('#supplierInvoiceDate').val();
        let chooseSupplierDropdown = $("#chooseSupplierDropdown").val();
        let tagNames = $('#tagName').val();
        let supplierInvoiceNumber = $('#supplierInvoiceNo').val(); 
        let purchaseInvoiceNo = $('#purchaseInvoiceNo').val();
        
      
        if(chooseSupplierDropdown=='' || !chooseSupplierDropdown){
            toastr.error("Please select a supplier");
            $('#chooseSupplierDropdown').focus();
            return false;
        }



        // Validate required fields

        if(quantity === '' || isNaN(quantity) || parseInt(quantity) <= 0) {
            toastr.error("Please enter a valid quantity greater than 0");
            $('#myquantity').focus();
            return false;
        }

        if(costPrice === '' || isNaN(costPrice) || parseFloat(costPrice) <= 0) {
            toastr.error("Please enter a valid cost price greater than 0");
            $('#costPrice').focus();
            return false;
        }
        if(retailMiniPrice === '' || isNaN(retailMiniPrice) || parseFloat(retailMiniPrice) < 0) {
            toastr.error("Please enter a valid retail mini price");
            $('#retailMiniPrice').focus();
            return false;
        }
        if(retailPrice === '' || isNaN(retailPrice) || parseFloat(retailPrice) < 0) {
            toastr.error("Please enter a valid retail price");
            $('#retailPrice').focus();
            return false;
        }

        if(salePrice === '' || isNaN(salePrice) || parseFloat(salePrice) < 0) {
            toastr.error("Please enter a valid sale price");
            $('#salePrice').focus();
            return false;
        }

        

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                barcode:barcode,
                itemCode:itemCode,
                invoiceItemName:invoiceItemName,
                itemName:itemName,
                tagName:tagName,
                category:category,
                subcategory1:subcategory1,
                subCategory2:subCategory2,
                subcategory3:subcategory3,
                color:color,
                brand:brand,
                unit:unit,
                quantity: quantity,
                costPrice: costPrice,
                retailMiniPrice: retailMiniPrice,
                retailPrice: retailPrice,
                retailDiscount: retailDiscount,
                retailDiscountPercent: retailDiscountPercent,
                salePrice: salePrice,
                supplierInvoiceDate:supplierInvoiceDate,
                chooseSupplierDropdown:chooseSupplierDropdown,
                tagNames:tagNames,
                supplierInvoiceNumber:supplierInvoiceNumber,
                purchaseInvoiceNo:purchaseInvoiceNo, 
                savePurchase: 44
            },
            success: function(response) {
                console.log(response);
                toastr.success("Purchase saved successfully!");
              
                $('#myquantity').val('');
                totalQuantity = 0;
                saveOffSizes(response); 
                showoffSavedItems(purchaseInvoiceNo); 
                $('#addCategoryModal').modal('hide'); 

            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                toastr.error("Failed to save purchase. Please try again.");
            }
        });

     }); 

});
