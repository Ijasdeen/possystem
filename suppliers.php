<?php
require_once('layouts/header.php')
?>

<style>
@media print {
    body, html {
        width: 80mm;
        margin: 0;
        padding: 0;
    }

    #printArea {
        width: 72mm; /* Leave some margin for borders */
        padding: 5mm;
    }

    button {
        display: none;
    }
}
</style>


<div class="content-wrapper">



<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Bank details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div id="allbankdetails">
         <div class="text-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body" id="accountNamesection">
                 
                </div>
              </div>
            </div>
         </div>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


             <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add Expense categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="supplierSaveform" method="POST">
                           <div class="modal-body">
                             <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                 <label for="">Name <span class="text text-danger fw-bold">*</span></label>
                                 <input type="text" name="" required id="supplier_name" class="form-control">
                                </div> 
                                <div class="form-group">
                                 <label for="">Address</label>
                                   <input type="text" class="form-control" id="address">
                                </div>
                
                                <div class="form-group">
                                 <label for="">Mobile <span class="text text-danger fw-bold">*</span></label>
                                  <input type="tel" required class="form-control" id="mobile" />
                                </div>
                                <div class="form-group">
                                 <label for="">Telephone</label>
                                 <input type="tel" class="form-control" id="telephone" />
                                </div>
                                <div class="form-group">
                                 <label for="">Short Name</label>
                                 <input type="text" class="form-control" id="short_name" />
                                </div>
                                <div class="form-group">
                                 <label for="">Email</label>
                                 <input type="text" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact person name</label>
                                 <input type="text" class="form-control" id="contactperson_name">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact Number 1</label>
                                 <input type="text" class="form-control" id="contactperson_mobile">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact number 2</label>
                                 <input type="text" class="form-control" id="contactperson_mobile2">
                                </div>
                                <div class="form-group">
                                 <label for="">Warehouse Address</label>
                                 <input type="text" class="form-control" id="warehouse_address">
                                </div>
                                 <div class="form-group">
                                    <label for="">Supplier Type</label>
                                    <select name="supplier_type" id="supplier_type" class="form-control">
                                       <option value="">--Choose supplier type--</option>
                                       <option value="Local">Local</option>
                                       <option value="Overseas">Overseas</option>
                                    </select>
                                 </div>
                                </div>
                                <div class="col-md-6">
                                 <h4>Add bank details</h4>
                                 <hr/>
                                  <div class="text-end">
                                    <button class="btn btn-dark btn-sm my-2" type="button" id="addedBank">ADD NEW BANK ACCOUNT</button>
                                  </div>

                                   <div id="addedBankdetailssection" style="max-height: 600px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
    
                                    </div>


                                </div>
                             </div> 

                           </div>
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


       <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Update Suppliers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="supplierUpdateForm" method="POST">
                           <div class="modal-body">
                             <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                 <label for="">Name <span class="text text-danger fw-bold">*</span></label>
                                 <input type="text" name="uaddress" required id="usupplier_name" class="form-control">
                                </div> 
                                <div class="form-group">
                                 <label for="">Address</label>
                                   <input type="text" class="form-control" id="uaddress">
                                </div>
                                 <div class="form-group">
                                 <label for="">Mobile <span class="text text-danger fw-bold">*</span></label>
                                  <input type="tel" required class="form-control" id="umobile" />
                                </div>
                                <div class="form-group">
                                 <label for="">Telephone</label>
                                 <input type="tel" class="form-control" id="utelephone" />
                                </div>
                                <div class="form-group">
                                 <label for="">Short Name</label>
                                 <input type="text" class="form-control" id="ushort_name" />
                                </div>
                                <div class="form-group">
                                 <label for="">Email</label>
                                 <input type="text" class="form-control" id="eumail">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact person name</label>
                                 <input type="text" class="form-control" id="ucontactperson_name">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact Number 1</label>
                                 <input type="text" class="form-control" id="ucontactperson_mobile">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact number 2</label>
                                 <input type="text" class="form-control" id="ucontactperson_mobile2">
                                </div>
                                <div class="form-group">
                                 <label for="">Warehouse Address</label>
                                 <input type="text" class="form-control" id="uwarehouse_address">
                                </div>
                                 <div class="form-group">
                                    <label for="">Supplier Type</label>
                                    <select name="supplier_type" id="usupplier_type" class="form-control">
                                       <option value="">--Choose supplier type--</option>
                                       <option value="Local">Local</option>
                                       <option value="Overseas">Overseas</option>
                                    </select>
                                 </div>
                                </div>
                                <div class="col-md-6">
                                 <h4>Add bank details</h4>
                                 <hr/>
                                  <div class="text-end">
                                    <button class="btn btn-dark btn-sm my-2" type="button" id="uaddedBank">ADD NEW BANK ACCOUNT</button>
                                  </div>
            
                                  <div id="uaddedBankdetailssection" style="max-height: 600px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
    
                                    </div>

                                 </div>
                             </div> 

                           </div>
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
 
       
            <div class="container-xxl flex-grow-1 container-p-y">

      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Suppliers</h4>
          <input type="search" placeholder="Search suppliers by mobile number, name, short name, email" 
          class="form-control" id="searchSuppliers">
             <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> ADD Suppliers
                </button>
               </div>
              <div class="card">
                <h5 class="card-header"></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                          <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Telephone</th>
                        <th>Address</th>
                         <th>Short Name</th>
                        <th>Email</th>
                        <th>Contact name</th>
                        <th>Contact number 1</th>
                        <th>Contact number 2</th>
                        <th>Supplier category</th>
                        <th>Warehouse Address</th>
                        <th>Action</th>
                       </tr>
                    </thead>
                   <tbody id="extractsuppliers">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                         <tr>
                     
                         <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Telephone</th>
                        <th>Address</th>
                         <th>Short Name</th>
                        <th>Email</th>
                        <th>Contact name</th>
                        <th>Contact number 1</th>
                        <th>Contact number 2</th>
                        <th>Supplier category</th>
                        <th>Warehouse Address</th>
                        <th>Action</th>
                         
                      </tr>

                    </tfoot>
                  </table>
                </div>
              </div>
            
            </div>
           
            <div class="content-backdrop fade"></div>
          </div>


         
      
<?php
require_once('layouts/footer.php');
?>

 <script src="js/supplier.js" defer></script>
 <script>
function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
