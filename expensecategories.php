<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">

             <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add Expense Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="saveExpenseCategory" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="">Category Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" required name="customer_name" id="categoryName" required>
                              </div>
                              <div class="form-group">
                                <label for="">Show Cashier? <span class="text text-danger fw-bold">*</span></label>
                             <select name="show_cashier" id="show_cashier" class="form-control">
                                <option value="0">No</option>
                                 <option value="1">Yes</option>
                              </select>
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



            
             <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Update Expense Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateCatexp" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="">Category Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" required name="customer_name" id="urllight" required>
                              </div>
                              <div class="form-group">
                                <label for="">Show Cashier? <span class="text text-danger fw-bold">*</span></label>
                             <select name="show_cashier" id="urlshowcashier" class="form-control">
                                <option value="0">No</option>
                                 <option value="1">Yes</option>
                              </select>
                              </div>
                                
                           </div>
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            

          

              
            <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Expense Categories</h4>

               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> ADD Expebse Category
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
                        <th>Category Name</th>
                           <th>Cashier Show status</th>
                       </tr>
                    </thead>
                   <tbody id="showexpcat">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                      <tr>
                      <th>Actions</th>
                         <th>#</th>
                        <th>Category Name</th>
                           <th>Cashier Show status</th>
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

 <script src="js/exp_cat.js" defer></script>