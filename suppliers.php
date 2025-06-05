<?php
require_once('layouts/header.php')
?>

<style>
@media print {
    body, html {
        width: 80mm;
        margin: 0;
        padding: 0;
    }

    #printArea {
        width: 72mm; /* Leave some margin for borders */
        padding: 5mm;
    }

    button {
        display: none;
    }
}


 
 
</style>

 

<div class="content-wrapper">
 



<div class="modal fade" style="z-index: 9999;" id="entersuppliertype">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-dark">
        <h4 class="modal-title text-white">Supplier Type</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body --> 
      <div class="modal-body">
       <div id="allbankdetails">
         <div class="text-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body" id="accountNamesection">
                  <form method="POST" id="saveAccountNameform">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" placeholder="Supplier type here" id="Suppliertypename" class="form-control">
                    </div>
                    <div class="form-group my-2">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="text-center">
                              <input type="submit" value="ADD +" class="form-control btn btn-primary btn-sm">
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
         </div>
       </div>
      </div>

      <!-- Modal footer -->
      
    </div>
  </div>
</div>



<div class="modal fade" id="myModalsection">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Bank details</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div id="allbankdetails">
         <div class="text-center">
            <div class="my-3">
              <div class="container">
                <div class="row">
                  <div class="col-md-4">
                    <input type="search" placeholder="Search.... 🔍" name="" id="searchbankdetailsbank" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-body" id="accountNamesection">
                 <div class="table table-responsive">
                  <table class="table table-striped table-responsive" id="printArea">
                    <thead>
                      <tr>
                         <th>A/C holder name</th>
                        <th>NO</th>
                        <th>Bank</th>
                        <th>Branch</th>
                        <th>-</th>
                      </tr>
                    </thead>
                    <tbody id="accountNamesectionlineup">

 
                    </tbody>
                  </table>
                 </div>
                </div>
              </div>
            </div>
         </div>
       </div>
      </div>

      <!-- Modal footer -->
      
    </div>
  </div>
</div>
  
             <div class="modal fade" id="addCategoryModal"  aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add suppliers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="supplierSaveform" method="POST">
                           <div class="modal-body">
                             <div class="row">
                                <div class="col-md-6">
                                 <div class="form-group">
                                  <label for="">Name <span class="text text-danger fw-bold">*</span></label>
                                 <input type="text" name="" 
                                 required id="supplier_name" class="form-control">
                                </div> 
                               </div>
                                <div class="col-md-6">
                                       <div class="form-group">
                                 <label for="">Short Name</label>
                                 <input type="text" class="form-control" id="short_name" />
                                </div>
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Address</label>
                                      <input type="text" class="form-control" id="supplieraddress">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">City</label>
                                      <input type="text" class="form-control" id="citylineup">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                 <label for="">Mobile <span class="text text-danger fw-bold">*</span></label>
                                  <input type="tel" required class="form-control" id="mobile" />
                                </div>
                                   </div>
                            <div class="col-md-4">
                           <div class="form-group">
                                 <label for="">Telephone</label>
                                 <input type="tel" class="form-control" id="telephone" />
                                </div>
                                   </div>
                                 <div class="col-md-4">
                                 <div class="form-group">
                                 <label for="">Email</label>
                                 <input type="text" class="form-control" id="email">
                                </div>
                                 </div>
                                 <div class="col-md-6">
                                  <div class="form-group">
                                 <label for="">Contact person name</label>
                                 <input type="text" class="form-control" id="contactperson_name">
                                </div>
                                 </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                 <label for="">Contact Number 1</label>
                                 <input type="text" class="form-control" id="contactperson_mobile">
                                </div>

                                </div>
                                     
                          <div class="col-md-6">
                                  <div class="form-group">
                                 <label for="">Warehouse Address</label>
                                 <input type="text" class="form-control" id="warehouse_address">
                                </div>
                                 </div>
                                 <div class="col-md-6">

                                <div class="form-group">
                                 <label for="">Warehouse Number</label>
                                 <input type="text" class="form-control" id="contactperson_mobile2">
                                </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                    <label for="">Supplier Type</label>
                                    <div class="input-group">
                                      <select name="supplier_type" id="supplier_type" class="form-control">
                                        <option value="">--Choose supplier type--</option>
                                        <option value="Local">Local</option>
                                        <option value="Overseas">Overseas</option>
                                      </select>
                                      <button class="btn btn-primary btn-sm" id="addthesuppliertypess" type="button">+</button>
                                    </div>
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Map location</label>
                                    <input type="url" class="form-control" id="location">
                                  </div>
                               </div>
                                 <div class="col-md-12 my-2">
                                 <h4>Add bank details</h4>
                                 <hr/>
                                  <div class="text-end">
                                    <button class="btn btn-dark btn-sm my-2" type="button" id="addedBank">ADD NEW BANK ACCOUNT</button>
                                  </div>

                                   <div id="addedBankdetailssection" style="max-height: 600px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
    
                                    </div>
 
                                </div>
                             </div> 

                           </div>
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" id="cleartheform">Clear</button>
                                <button type="submit" class="btn btn-primary">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <div class="modal fade" id="editModal"  aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Add suppliers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="supplierSaveform" method="POST">
                           <div class="modal-body">
                             <div class="row">
                                <div class="col-md-6">
                                 <div class="form-group">
                                  <label for="">Name <span class="text text-danger fw-bold">*</span></label>
                                 <input type="text" name="" 
                                 required id="usupplier_name" class="form-control">
                                </div> 
                               </div>
                                <div class="col-md-6">
                                       <div class="form-group">
                                 <label for="">Short Name</label>
                                 <input type="text" class="form-control" id="ushort_name" />
                                </div>
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Address</label>
                                      <input type="text" class="form-control" id="usupplieraddress">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">City</label>
                                      <input type="text" class="form-control" id="ucitylineup">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                 <label for="">Mobile <span class="text text-danger fw-bold">*</span></label>
                                  <input type="tel" required class="form-control" id="umobile" />
                                </div>
                                   </div>
                            <div class="col-md-4">
                           <div class="form-group">
                                 <label for="">Telephone</label>
                                 <input type="tel" class="form-control" id="utelephone" />
                                </div>
                                   </div>
                                 <div class="col-md-4">
                                 <div class="form-group">
                                 <label for="">Email</label>
                                 <input type="text" class="form-control" id="uemail">
                                </div>
                                 </div>
                                 <div class="col-md-6">
                                  <div class="form-group">
                                 <label for="">Contact person name</label>
                                 <input type="text" class="form-control" id="ucontactperson_name">
                                </div>
                                 </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                 <label for="">Contact Number 1</label>
                                 <input type="text" class="form-control" id="ucontactperson_mobile">
                                </div>

                                </div>
                                     
                          <div class="col-md-6">
                                  <div class="form-group">
                                 <label for="">Warehouse Address</label>
                                 <input type="text" class="form-control" id="uwarehouse_address">
                                </div>
                                 </div>
                                 <div class="col-md-6">

                                <div class="form-group">
                                 <label for="">Warehouse Number</label>
                                 <input type="text" class="form-control" id="ucontactperson_mobile2">
                                </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                    <label for="">Supplier Type</label>
                                    <div class="input-group">
                                      <select name="supplier_type" id="usupplier_type" class="form-control">
                                        <option value="">--Choose supplier type--</option>
                                        <option value="Local">Local</option>
                                        <option value="Overseas">Overseas</option>
                                      </select>
                                      <button class="btn btn-primary btn-sm" id="uaddthesuppliertypess" type="button">+</button>
                                    </div>
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Map location</label>
                                    <input type="url" class="form-control" id="ulocation">
                                  </div>
                               </div>
                                 <div class="col-md-12 my-2">
                                 <h4>Add bank details</h4>
                                 <hr/>
                                  <div class="text-end">
                                    <button class="btn btn-dark btn-sm my-2" type="button" id="addedBank">ADD NEW BANK ACCOUNT</button>
                                  </div>

                                   <div id="uaddedBankdetailssection" style="max-height: 600px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
    
                                    </div>
 
                                </div>
                             </div> 

                           </div>
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" id="cleartheform">Clear</button>
                                <button type="submit" class="btn btn-primary">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


       <div class="modal fade" id="editModalss" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Update Suppliers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="supplierUpdateForm" method="POST">
                           <div class="modal-body">
                             <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                 <label for="">Name <span class="text text-danger fw-bold">*</span></label>
                                 <input type="text" name="uaddress" required id="usupplier_name" class="form-control">
                                </div> 
                                <div class="form-group">
                                 <label for="">Address</label>
                                   <input type="text" class="form-control" id="uaddress">
                                </div>
                                 <div class="form-group">
                                 <label for="">Mobile <span class="text text-danger fw-bold">*</span></label>
                                  <input type="tel" required class="form-control" id="umobile" />
                                </div>
                                <div class="form-group">
                                 <label for="">Telephone</label>
                                 <input type="tel" class="form-control" id="utelephone" />
                                </div>
                                <div class="form-group">
                                 <label for="">Short Name</label>
                                 <input type="text" class="form-control" id="ushort_name" />
                                </div>
                                <div class="form-group">
                                 <label for="">Email</label>
                                 <input type="text" class="form-control" id="eumail">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact person name</label>
                                 <input type="text" class="form-control" id="ucontactperson_name">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact Number 1</label>
                                 <input type="text" class="form-control" id="ucontactperson_mobile">
                                </div>
                                <div class="form-group">
                                 <label for="">Contact number 2</label>
                                 <input type="text" class="form-control" id="ucontactperson_mobile2">
                                </div>
                                <div class="form-group">
                                 <label for="">Warehouse Address</label>
                                 <input type="text" class="form-control" id="uwarehouse_address">
                                </div>
                                 <div class="form-group">
                                    <label for="">Supplier Type</label>
                                    <select name="supplier_type" id="usupplier_type" class="form-control">
                                       <option value="">--Choose supplier type--</option>
                                       <option value="Local">Local</option>
                                       <option value="Overseas">Overseas</option>
                                    </select>
                                 </div>
                                </div>
                                <div class="col-md-6">
                                 <h4>Add bank details</h4>
                                 <hr/>
                                  <div class="text-end">
                                    <button class="btn btn-dark btn-sm my-2" type="button" id="uaddedBank">ADD NEW BANK ACCOUNT</button>
                                  </div>
                            <div id="uaddedBankdetailssection" style="max-height: 600px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
    
                                    </div>

                                 </div>
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
              

      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Suppliers</h4>
           
<div class="container">
            <div class="row">
              <div class="col-md-4">
                   <input type="search" placeholder="Search  mobile number, name, short name, email" 
          class="form-control" id="searchSuppliers">
              </div>
            </div>
           </div> 
             <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> ADD Suppliers
                </button>
               </div>
              <div class="card">
                <h5 class="card-header"></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                          <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Telephone</th>
                        <th>Bank details</th>
                           <th>Location map</th>
                        <th>Address</th>
                     
                         <th>Short Name</th>
                        <th>Email</th>
                        <th>Contact name</th>
                        <th>Contact number 1</th>
                        <th>Contact number 2</th>
                        <th>Supplier category</th>
                        <th>Warehouse Address</th>
                        <th>Action</th>
                       </tr>
                    </thead>
                   <tbody id="extractsuppliers">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                         <tr>
                          <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Telephone</th>
                        <th>Location map</th>
                         <th>Bank details</th>
                        <th>Address</th>
                         <th>Short Name</th>
                        <th>Email</th>
                        <th>Contact name</th>
                        <th>Contact number 1</th>
                        <th>Contact number 2</th>
                        <th>Supplier category</th>
                        <th>Warehouse Address</th>
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

 <script src="js/supplier.js" defer></script>
 <script>
function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>


<script>
  $(document).ready(function () {

    $('#addthesuppliertype').click(function(){
      
      Swal.fire({
  title: "Submit your Github username",
  input: "text",
  inputAttributes: {
    autocapitalize: "off"
  },
  showCancelButton: true,
  confirmButtonText: "Look up",
  showLoaderOnConfirm: true,
  preConfirm: async (login) => {
    try {
      const githubUrl = `
        https://api.github.com/users/${login}
      `;
      const response = await fetch(githubUrl);
      if (!response.ok) {
        return Swal.showValidationMessage(`
          ${JSON.stringify(await response.json())}
        `);
      }
      return response.json();
    } catch (error) {
      Swal.showValidationMessage(`
        Request failed: ${error}
      `);
    }
  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: `${result.value.login}'s avatar`,
      imageUrl: result.value.avatar_url
    });
  }
});

    }); 

 
 
});

</script>

<script>
  $(document).ready(function() {
  $('#supplierSaveform').on('keydown', 'input, select', function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
      let focusable = $('#supplierSaveform').find('input:visible:enabled, select:visible:enabled');
      let idx = focusable.index(this);
      if (idx >= 0 && idx < focusable.length - 1) {
        e.preventDefault();          // prevent submit only if next field exists
        focusable.eq(idx + 1).focus();
      }
      // else: last input, do not preventDefault so form submits normally
    }
  });
});

</script>

 
 