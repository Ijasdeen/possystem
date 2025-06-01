<?php
require_once('layouts/header.php')
?>


<div class="content-wrapper">
            <!-- Content -->

            <!-- Edit Category Modal -->
            <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="editCategoryModalLabel">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editCategoryForm">
                            <div class="modal-body">
                                <input type="hidden" id="editCategoryId" name="categoryId">
                                <div class="mb-3">
                                    <label for="editCategoryName" class="form-label">Category Name</label>
                                    <input type="text" required class="form-control" id="editCategoryName" name="categoryName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCategoryCode" class="form-label">Category Code</label>
                                    <input type="text" class="form-control" id="editCategoryCode" name="categoryCode" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add Category Modal -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="addCategoryFormsectionss">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input type="text" required class="form-control" id="categoryName" name="categoryName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryCode" class="form-label">Category Code</label>
                                    <input type="text" class="form-control" id="categoryCode" name="categoryCode" required>
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


            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Categories</h4>

               <div class="my-3">
                <input type="search" name="" placeholder="Search By name or category code" id="searchCategories" class="form-control">
               </div>
               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> ADD CATEGORY
                </button>
               </div>
              <div class="card">
                <h5 class="card-header">Main Categories</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                      <th>Actions</th>
                         <th>#</th>
                        <th>Category Name</th>
                        <th>Category Code</th>
                       </tr>
                    </thead>
                   <tbody id="showcategories">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                      <tr>
                      <th>Actions</th>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Category Code</th>
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

 <script src="js/category.js" defer></script>

 <script>
    $(document).ready(function(){
        
   $('#searchCategories').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#showcategories tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });

    }); 
 </script>