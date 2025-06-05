<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">
          
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Branches</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="saveBranches">
                            <div class="modal-body">
                              
                              <div class="form-group">
                                <label for="">Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" required class="form-control" id="name">
                              </div>

                                <div class="form-group">
                                <label for="">Address</label>
                                <input type="text"  class="form-control" id="address">
                              </div> 
                                <div class="form-group">
                                <label for="">Mobile</label>
                                <input type="tel"  class="form-control" id="mobile">
                              </div>  
                              
                               <div class="form-group">
                                <label for="">Landline</label>
                                <input type="tel"  class="form-control" id="landline">
                              </div>  

                               <div class="form-group">
                                <label for="">Email</label>
                                <input type="tel"  class="form-control" id="email">
                              </div>  
                                 
                      
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
 
                        <div class="modal fade" id="brancheditModalsection" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Branches</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateBranches">
                            <div class="modal-body">
                              
                              <div class="form-group">
                                <label for="">Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" required class="form-control" id="uname">
                              </div>

                                <div class="form-group">
                                <label for="">Address</label>
                                <input type="text"  class="form-control" id="uaddress">
                              </div> 
                                <div class="form-group">
                                <label for="">Mobile</label>
                                <input type="tel"  class="form-control" id="umobile">
                              </div>  
                              
                               <div class="form-group">
                                <label for="">Landline</label>
                                <input type="tel"  class="form-control" id="ulandline">
                              </div>  

                               <div class="form-group">
                                <label for="">Email</label>
                                <input type="tel"  class="form-control" id="uemail">
                              </div>  
                                 
          
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



              <div class="modal fade" id="editBrandsection" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Brands</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateBrands">
                            <div class="modal-body">
                              
                              <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" required class="form-control" id="uname">
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

 
            <div class="modal fade" id="editCategorymodal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add Sub category Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="subcategoryupdatedform">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" required class="form-label">Category Name</label>
                                    
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="categoryCode" class="form-label">Sub category 1 </label>
                                    <input type="text" 
                                    class="form-control" id="usubcategory1name" name="categoryCode" required>
                                </div>

                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 1 Code </label>
                                    <input type="text"  class="form-control" 
                                    id="usubcategoryCode" name="categoryCode">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Branches</h4>

              <div class="my-3">
                <div class="container">
                  <div class="row">
                    <div class="col-md-3">
                                      <input type="search" placeholder="Search by name, address,mobile, landline, email" 
                name="" id="branchesSearchlineup" class="form-control">
                    </div>
                  </div>
                </div>

              </div>
               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> Branches
                </button>
              
               </div>
              <div class="card">
                <h5 class="card-header">All Branches</h5>
                <div class="container">
                  
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Landline</th>
                        <th>Email</th>
                         <th>Action</th>
                       </tr>
                    </thead>
                   <tbody id="showbranches">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                     <tr>
                          <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Landline</th>
                        <th>Email</th>
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

 <script src="js/branches.js" defer></script>