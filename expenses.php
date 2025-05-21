<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">

             <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add Expense categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="expensessave" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="">Expense Category <span class="text text-danger fw-bold">*</span></label>
                                <select name="expensecategory" id="exp_cat" class="form-control">
                                      <option value="">--Select expense category--</option>
                                      <?php
                                      $query = "SELECT * FROM expense_categories";
                                        $result = mysqli_query($connection,$query);
                                        if(mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <option value="<?php echo $row['id']?>"><?php echo $row['expense_categories_name']?></option>
                                                <?php
                                            }
                                        }
                                        else {
                                            ?>
                                            <option value="">No categories found</option>
                                            <?php
                                        }
                                      ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="">Amount <span class="text text-danger fw-bold">*</span></label>
                                <input type="tel" required name="amount" id="amount" class="form-control">
                              </div>

                              <div class="form-group">
                                <label for="">Reason</label>
                                <input type="text" name="reason" id="reason" class="form-control">
                              </div>


                                <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" name="reason"  id="date" class="form-control">
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
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Update Expense categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="expenseUpdate" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="">Expense Category <span class="text text-danger fw-bold">*</span></label>
                                <select name="expensecategory" id="uexp_cat" class="form-control">
                                      <option value="">--Select expense category--</option>
                                      <?php
                                      $query = "SELECT * FROM expense_categories";
                                        $result = mysqli_query($connection,$query);
                                        if(mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <option value="<?php echo $row['id']?>"><?php echo $row['expense_categories_name']?></option>
                                                <?php
                                            }
                                        }
                                        else {
                                            ?>
                                            <option value="">No categories found</option>
                                            <?php
                                        }
                                      ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="">Amount <span class="text text-danger fw-bold">*</span></label>
                                <input type="tel" required name="amount" id="uamount" class="form-control">
                              </div>

                              <div class="form-group">
                                <label for="">Reason</label>
                                <input type="text" name="reason" id="ureason" class="form-control">
                              </div>

                                 <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" name="reason"  id="udate" class="form-control">
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

      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Expenses</h4>

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
                        <th>Expense Categories</th>
                        <th>Expense Reason</th>
                        <th>Expense Amount</th>
                        <th>Date</th>
                         
                      </tr>
                    </thead>
                   <tbody id="showExpenses">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                        <tr>
                      <th>Actions</th>
                         <th>#</th>
                        <th>Expense Categories</th>
                        <th>Expense Reason</th>
                        <th>Expense Amount</th>
                        <th>Date</th>
                         
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

 <script src="js/expenses.js" defer></script>