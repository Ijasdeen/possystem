<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">

             <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add Sub category Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="subcategoryaddedform" method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" required class="form-label">Category Name</label>
                                    <select name="categoryName" class="form-control" id="categoryName">
                                    <option value="">--Select one--</option>

                                        <?php
                                    $query = "SELECT * FROM categories";
                                    $result = mysqli_query($connection,$query); 
                                    if(mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                                <?php
                                            }
                                    }
                                    else {
                                            ?>
                                        <option value="">--No data found--</option>

                                            <?php
                                    }
                                    ?>
                                    </select>
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="categoryCode" class="form-label">Sub category 1 </label>
                                   <select name="" class="form-control" id="subcategory1">
                                      <option value="">--Choose main category--</option>
                                   </select>
                                </div>

                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 2 Name </label>
                                    <input type="text"  class="form-control" id="subcategory2name" name="subcategory2" required>
                                </div>

                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 2 code </label>
                                    <input type="text"  class="form-control" id="subcategory2code" name="subcategory2code" required>
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


            <div class="modal fade" id="editCategoryModalsection" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Edit Sub category Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="subcategoryupdateform" method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" required class="form-label">Category Name</label>
                                    <select name="categoryName" class="form-control" id="ucategoryName">
                                    <option value="">--Select one--</option>
                                      <?php
                                    $query = "SELECT * FROM categories";
                                    $result = mysqli_query($connection,$query); 
                                    if(mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                                <?php
                                            }
                                    }
                                    else {
                                            ?>
                                        <option value="">--No data found--</option>

                                            <?php
                                    }
                                    ?>
                                    </select>
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="categoryCode" class="form-label">Sub category 1 </label>
                                   <select name="" class="form-control" id="usubcategory1">
                                      <option value="">--Choose main category--</option>
                                   </select>
                                </div>

                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 2 Name </label>
                                    <input type="text"  class="form-control" id="usubcategory2name" name="subcategory2" required>
                                </div>

                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 2 code </label>
                                    <input type="text"  class="form-control" id="usubcategory2code" name="subcategory2code" required>
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


              
            <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Sub category 2</h4>

               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> ADD CATEGORY
                </button>
               </div>
              <div class="card">
                <h5 class="card-header">Sub Categories</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                      <th>Actions</th>
                         <th>#</th>
                        <th>Main Category Name</th>
                        <th>Sub category 1 Name</th>
                        <th>Sub category 2 name</th>
                        <th>Sub Category 2 Code</th>
                        
                      </tr>
                    </thead>
                   <tbody id="showsubcategories11">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                    <tr>
                      <th>Actions</th>
                         <th>#</th>
                         <th>Main Category Name</th>
                        <th>Sub category 1 Name</th>
                        <th>Sub category 2 name</th>
                        <th>Sub Category 2 Code</th>
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

 <script src="js/subcategories2.js" defer></script>