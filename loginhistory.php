<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">

             <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add Customers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="saveCustomersform" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="">Customer Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" required name="customer_name" id="customer_name" required>
                              </div>
                              <div class="form-group">
                                <label for="">Customer Mobile <span class="text text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" name="customer_mobile" id="customer_mobile" required>
                              </div>
                              <div class="form-group">
                                <label for="">Customer Date of Birth</label>
                                <input type="date" name="dob" id="dob" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="">Customer NIC</label>
                                <input type="text" class="form-control" name="customer_nic" id="customer_nic" >
                              </div>
                          <div class="form-group">
                            <label for="">Credit</label>
                            <input type="number" class="form-control" name="credit" id="credit" value="0">
                          </div>
                          <div class="form-group">
                            <label for="">Debit</label>
                            <input type="number" class="form-control" name="debit" id="debit" value="0">
                          </div>

                              <div class="form-group">Gender</div>
                              <select name="gender" id="gender"  class="form-control">
                                <option value="">--Select one--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                           </div>
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="openingbalancePanel" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Opening Balance</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="addtheamountform" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="">Amount <span class="text text-danger fw-bold">*</span></label>
                                <input type="tel" class="form-control" required name="customer_amount" id="customer_amount" required>
                              </div>
 
                              <div class="form-group">

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



            

            <div class="modal fade" id="fixHtmlsection" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Bad debt</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                         <div class="container my-2">
                          <div class="row">
                            <div class="col-md-6">Outstanding Amount : <span class="text text-danger fw-bold" id="outstnadingamounthtml"></span></div>
                          </div>
                         </div>
                        <form id="uaddtheamountform" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="customer_amount">Amount <span class="text text-danger fw-bold">*</span></label>
                                <input type="tel" class="form-control" required name="customer_amount" id="ucustomer_amount" required>
                              </div>
 
                              <div class="form-group">
                                
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








                         <div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Update Customers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateCustomersform" method="POST">
                           <div class="modal-body">
                              <div class="form-group">
                                <label for="">Customer Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" required name="customer_name" 
                                id="ucustomer_name" required>
                              </div>
                              <div class="form-group">
                                <label for="">Customer Mobile <span class="text text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" name="customer_mobile"
                             id="ucustomer_mobile" required>
                              </div>
                              <div class="form-group">
                                <label for="">Customer Date of Birth</label>
                                <input type="date" name="dob" id="udob" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="">Customer NIC</label>
                                <input type="text" class="form-control" name="customer_nic" 
                                id="ucustomer_nic" >
                              </div>
                          <div class="form-group">
                            <label for="">Credit</label>
                            <input type="number" class="form-control" name="credit"
                             id="ucredit">
                          </div>
                          <div class="form-group">
                            <label for="">Debit</label>
                            <input type="number" class="form-control" name="debit" id="udebit">
                          </div>

                              <div class="form-group">Gender</div>
                              <select name="gender" id="ugender"  class="form-control">
                                <option value="">--Select one--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
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
 
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Login History</h4>
<div class="container">
  <div class="row">
    <div class="col-md-4">

    </div>
  </div>
</div>
               <div class="my-3">
                 
               </div>
              <div class="card">
                <h5 class="card-header"></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                         <th>#</th>
                        <th>Operating System</th>
                        <th>Browser</th>
                        <th>Date and time</th>
                         
                      </tr>
                    </thead>
                   <tbody id="loginhistory">

                   </tbody>
                    
                  </table>
                </div>
              </div>
            
            </div>
           
            <div class="content-backdrop fade"></div>
          </div>


         
      
<?php
require_once('layouts/footer.php');
?>

 <script src="js/loginhistory.js" defer></script>