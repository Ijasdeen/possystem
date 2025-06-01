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
 
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Customers</h4>
            <input type="search" placeholder="Searc by Customer name, Customer mobile, NIC, Gender" name="addcustomers" id="customersSearchdetails" class="form-control">

               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> ADD Customers
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
                        <th>Customer Name</th>
                        <th>Customer Mobile</th>
                        <th>Date of Birth</th>
                        <th>NIC</th>
                        <th>Gender</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        
                      </tr>
                    </thead>
                   <tbody id="showCustomers">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                    <tr>
                      <th>Actions</th>
                        <th>#</th>
                       <th>Customer Name</th>
                        <th>Customer Mobile</th>
                        <th>Date of Birth</th>
                        <th>NIC</th>
                        <th>Gender</th>
                        <th>Credit</th>
                        <th>Debit</th>
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

 <script src="js/customers.js" defer></script>