<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">

             <div class="modal fade" id="addstaffs" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add Expense categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="supplierSaveform" method="POST">
                           <div class="modal-body">
                             <div class="form-group">
                                <label for="">Supplier Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" name="supplier_name" id="supplier_name" require>
                             </div>

                             <div class="form-group">
                                <label for="">Supplier Mobile <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" required name="supplier_mobile" id="supplier_mobile">
                             </div>

                             <div class="form-group">
                                <label for="">Supplier Company</label>
                                <input type="text" class="form-control" name="supplier_company" id="supplier_company">
                             </div>
                             <div class="form-group">
                                <label for="">Supplier City</label>
                                <input type="text" class="form-control" name="supplier_city" id="supplier_city">
                             </div>

                               <div class="form-group">
                                <label for="">Supplier Credit</label>
                                <input type="text" class="form-control" name="credit" id="supplier_credit" value="0">
                             </div>

                               <div class="form-group">
                                <label for="">Supplier Debit</label>
                                <input type="text" class="form-control" name="debit" id="supplier_debit" value="0" >
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



             

             



           

       
            <div class="container-xxl flex-grow-1 container-p-y">

      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Staffs</h4>

               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> ADD EXPENSES
                </button>
               </div>
              <div class="card">
                <h5 class="card-header"></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                      <th>Actions</th>
                         <th>#</th>
                        <th>Supplier Name</th>
                        <th>Supplier Mobile</th>
                        <th>Supplier Company</th>

                        <th>Supplier City</th>
                        <th>Supplier Credit</th>
                        <th>Supplier Debit</th>
                         
                      </tr>
                    </thead>
                   <tbody id="showoffsuppliers">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                         <tr>
                      <th>Actions</th>
                         <th>#</th>
                        <th>Supplier Name</th>
                        <th>Supplier Mobile</th>
                          <th>Supplier Company</th>
                        <th>Supplier City</th>
                        <th>Supplier Credit</th>
                        <th>Supplier Debit</th>
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