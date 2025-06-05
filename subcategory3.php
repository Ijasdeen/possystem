<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">


             <div class="modal fade" id="showoffbankdetailssection" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Supplier Bank details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="subcategoryaddedform" method="POST">
                            <div class="modal-body">
                                 <div id="showoffbankdetails">

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
                                    <option required value="">--Select one--</option>

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
                                   <select name="" required class="form-control" id="subcategory11">
                                      <option value="">--Choose main category--</option>
                                   </select>
                                </div>

                                <div class="mb-3">
                                    <label for="categoryCode" class="form-label">Sub category 2 </label>
                                   <select name="" required class="form-control" id="subcategory2">
                                      <option value="">--Choose Sub category 1 --</option>
                                   </select>
                                </div>
 
                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 3 Name </label>
                                    <input type="text"  
                                    class="form-control" id="subcategory3name" name="subcategory2code" required>
                                </div>
 
                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 3 code (Optional) </label>
                                    <input type="text"  class="form-control" id="subcategory3code" name="subcategory2code" required>
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




            
             <div class="modal fade" id="editModalsection" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Update Sub category Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="subcategoryUpdateForm" method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" required class="form-label">Category Name</label>
                                    <select name="categoryName" class="form-control" id="uucategoryName">
                                    <option required value="">--Select one--</option>

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
                                   <select name="" required class="form-control" id="usubcategory11">
                                      <option value="">--Choose main category--</option>
                                   </select>
                                </div>

                                <div class="mb-3">
                                    <label for="categoryCode" class="form-label">Sub category 2 </label>
                                   <select name="" required class="form-control" id="usubcategory2">
                                      <option value="">--Choose Sub category 1 --</option>
                                   </select>
                                </div>
 
                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 3 Name </label>
                                    <input type="text"  
                                    class="form-control" id="uusubcategory3name" name="usubcategory3code" required>
                                </div>
 
                                <div class="mb-3">
                                    <label for="subCategorycode" class="form-label">Sub category 3 code (Optional) </label>
                                    <input type="text"  class="form-control" id="uusubcategory3code"
                                     name="uusubcategory3code">
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


            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Sub category 3</h4>

             <div class="container">
                <div class="row">
                    <div class="col-md-4">
                          <div class="my-3">
                <input type="search" name="" placeholder="Search By name or category code" id="searchCategories" class="form-control">
               </div>
                    </div>
                </div>
             </div>
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
                        <th>Sub category 2 Name</th>
                         
                         <th>Sub Category 3 Name</th>
                          <th>Sub Category 3 Code</th>
                        
                      </tr>
                    </thead>
                   <tbody id="showinglineuphell">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                    <tr>
                      <th>Actions</th>
                         <th>#</th>
                         <th>Main Category Name</th>
                        <th>Sub category 1 Name</th>
                        <th>Sub category 2 name</th>
                         
                         <th>Sub Category 3 Name</th>
                          <th>Sub Category 3 Code</th>
                        
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

 <script src="js/subcategories3.js" defer></script>

 
 <script>
    $(document).ready(function(){
        
   $('#searchCategories').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#showinglineuphell tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });

    }); 
 </script>
