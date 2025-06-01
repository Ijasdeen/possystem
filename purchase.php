<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">
          
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Purchase</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="savePurchaseform" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Barcode</label>
                                    <input type="text" name="" id="barcode" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="item">Item Code</label>
                                    <input type="text" class="form-control" id="itemCode" name="itemCode" placeholder="Item Code">
                                </div>
                                <div class="form-group">
                                    <label for="">Invoice Item Name</label>
                                    <input type="text" class="form-control" id="invoiceItemName" name="invoiceItemName" placeholder="Invoice Item Name">
                                </div>
                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Item Name">
                                </div>
                                <div class="form-group">
                                    <label for="">Tag Name</label>
                                    <input type="text" class="form-control" id="tagName" name="tagName" placeholder="Tag Name">
                                </div>
                               <div class="form-group">
                                <label for="">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">--Choose one--</option>
                                </select>
                               </div>
                               <div class="form-group">
                                <label for="">Sub Category 1</label>
                                <select name="subcategory1" id="subcategory1" class="form-control">
                                    <option value="">--Choose one--</option>
                                </select>
                               </div>
                               <div class="form-group">
                                <label for="">Sub Category 2</label>
                                 <select name="" id="subCategory2" class="form-control">

                                 </select>
                               </div>

                               <div class="form-group">
                                <label for="">Sub Category 3</label>
                                <select name="subcategory3" id="subcategory_3" class="form-control">

                                </select>
                               </div>
                               <div class="form-group">
                                <label for="">Color</label>
                                <select name="color" id="color" class="form-control"></select>
                               </div>
                               <div class="form-group">
                                <label for="">Brand</label>
                                <select name="brand" id="brand" class="form-control"></select>
                               </div>
                               <div class="form-group">
                                <label for="">Unit</label>
                                <select name="unit" id="unit" class="form-control">
                                    
                                </select>
                               </div>
                               <hr/>
                               
                                            <div class="text-center">
                                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">ADD VARIATION</button>
                                            </div>
                               <br>
                                <hr/>
                                <div class="container">
                                    <span class="text text-danger fw-bold">Price Details</span>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Quantity</label>
                                                <input type="tel" class="form-control" id="myquantity" name="quantity" placeholder="Quantity">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Cost Price</label>
                                                <input type="text" class="form-control" id="costPrice" name="costPrice" placeholder="Cost Price">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Retail Mini Price</label>
                                                <input type="text" class="form-control" id="retailMiniPrice" name="retailMiniPrice" placeholder="Retail Mini Price">
                                            </div>
                                            <div class="form-group">
                                                <label for=""></label>
                                            </div>


                                        </div>
                                        <div class="col-md-4">
                                            <span class="text text-danger fw-bold">Retail Price</span>
                                            <div class="form-group">
                                                <label for="">Retail Price</label>
                                                <input type="text" class="form-control" id="retailPrice" name="retailPrice" placeholder="Retail Price">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Retail Discount</label>
                                                <input type="text" class="form-control" id="retailDiscount" name="retailDiscount" placeholder="Retail Discount">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Retail Discount %</label>
                                                <input type="text" class="form-control" id="retailDiscountPercent" name="retailDiscountPercent" placeholder="Retail Discount %">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="text text-danger fw-bold">Sale Price</span>
                                            <div class="form-group">
                                                <label for="">Sale Price</label>
                                                <input type="text" class="form-control" id="salePrice" name="salePrice" placeholder="Sale Price">
                                            </div>

                                        </div>
                                    </div>
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

 <div class="offcanvas offcanvas-end text-white" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
     style="background: linear-gradient(135deg, #0f2027, #2c5364); color: #ffffff;">
  <div class="offcanvas-header border-bottom" style="border-color: rgba(255,255,255,0.15);">
    <h5 id="offcanvasRightLabel" class="mb-0" style="color: #4dd0e1;">Sizes</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <form method="POST">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Size</label>
                        <input type="text" class="form-control" id="sizeName" name="sizeName" placeholder="Size Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="">QTY</label>
                    <input type="tel" class="form-control" id="warehouseName" name="warehouseName" placeholder="Warehouse Name">
                </div>
            </div>
        </div>
      </form>
      <div class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="sizeTable" class="table table-striped table-responsive text-white" style="color:white;">
                        <thead>
                            <tr>
                            <thead>
                                <th class="text-white">#</th>
                                <th class="text-white">Size</th>
                                <th class="text-white">QTY</th>
                                <th class="text-white">Action</th>

                            </thead>
                        </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    
    
  </div>
</div>





            <div class="modal fade" id="editModalsectionlineup" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">ADD ITEM</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateCashiers">
                            <div class="modal-body">
                               <div class="form-group">
                                <label for="">Store Name <span class="text text-danger fw-bold">*</span></label>
                                <input type="text" required class="form-control" id="uname">
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
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Warehouses</h5>
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
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Warehouse</h5>
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


            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Purcahse</h4>

               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> Purcahse
                </button>
               </div>
              <div class="card">
                <h5 class="card-header">All Purcahse</h5>
                 <div class="container">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="row">
                                <div class="col">
                                    <label for="">Supplier Invoice Date</label>
                                    <input type="date" class="form-control" id="supplierInvoiceDate" name="supplierInvoiceDate" required>
                                </div>
                                <div class="col">
                               <label for="Name"> Name </label>
                                <select name="Supplier" class="form-control" id="chooseSupplierDropdown">
                                    <!-- <option value="">-- Choose Supplier--</option> -->
                                </select>
                             
                                </div>
                                <div class="col">
                                    <label for="Tagname">Tag name</label>
                                    <input type="text" class="form-control" id="tagName" name="tagName" placeholder="Tag Name">
                                </div>
                                <div class="col">
                                   <label for=""> Supplier Invoice NO</label>
                                   <input type="text" class="form-control" id="supplierInvoiceNo" name="supplierInvoiceNo" placeholder="Supplier Invoice No">
                                </div>
                                <div class="col">
                                    <label for="">Purchase Invoice No</label>
                                    <input type="text" class="form-control" id="purchaseInvoiceNo" name="purchaseInvoiceNo" placeholder="Purchase Invoice No">
                                </div>

                                     <table class="table table-striped table-responsive my-2">
                                        <thead>
                                            <tr>
                                              
                                                <th>Code</th>
                                                <th>Barcode</th>
                                                <th>Batch ID</th>
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Cost price</th>
                                                <th>Min. Price</th>
                                                <th>S. Discount</th>
                                                <th>Sale Price</th>
                                                <th>Line Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addedProducts">

                                        </tbody>
                                    </table>

                                
                                
                            </div>
                           
                        </div>

                      
                    </div>
                    
                 </div>
              </div>
             </div>

          
           
            <div class="content-backdrop fade"></div>
          </div>

     
<?php
require_once('layouts/footer.php');
?>

 <script src="js/purchase.js" defer></script>