<?php
require_once('layouts/header.php')
?>
 
<div class="content-wrapper">
          
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="addCategoryModalLabel">Assign</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="saveAssigntask">
                            <div class="modal-body">
                               <div class="form-group">
                                <label for="">Branch <span class="text text-danger fw-bold">*</span></label>
                                <select required name="branch" id="branch" class="form-control">
                                    
                                </select>
                              </div>

                               <div class="form-group">
      <label for="Cashier">Cashier</label>
<div class="input-group mb-3">
  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Cashier list
  </button>
  <ul class="dropdown-menu" id="cashierssection">
    
  </ul>
  <input type="text" class="form-control" id="dropdownInput" aria-label="Text input with dropdown button">
</div>


                               </div>

                               <div class="form-group">
                                <label for="warehouseInput">Warehouse</label> 
<div class="input-group mb-3">
  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Warehouse list
  </button>
  <ul class="dropdown-menu" id="warehouseDropdown">
   
  </ul>
  <input type="text" class="form-control" id="warehouseInput" aria-label="Text input with dropdown button">
</div>

                                
                               </div>

                               
                               <div class="form-group">
                                <label for="store">Store</label> 
<div class="input-group mb-3">
  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Store list
  </button>
  <ul class="dropdown-menu" id="storeDrodown">
   
  </ul>
  <input type="text" class="form-control" id="storeInputbox" aria-label="Text input with dropdown button">
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

            <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Assign</h4>

               <div class="my-3">
                <button class="btn btn-primary btn-sm" data-bs-target="#addCategoryModal" data-bs-toggle="modal">
                <i class="menu-icon tf-icons bx bx-plus"></i> Assign
                </button>
               </div>
              <div class="card">
                <h5 class="card-header">All Assign</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>#</th>
                        <th>Branch</th>
                        <th>Cashier</th>
                        <th>Warehouse</th>
                         <th>Store</th>
                          <th>Action</th>
                       </tr>
                    </thead>
                   <tbody id="assignedproducts">

                   </tbody>
                    <tfoot class="table-border-bottom-0">
                      <tr>
                          <th>#</th>
                        <th>Branch</th>
                        <th>Cashier</th>
                        <th>Warehouse</th>
                         <th>Store</th>
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

 <script src="js/assign.js" defer></script>
  
 <script>
  // ======== Cashier Section ========
  const input = document.getElementById('dropdownInput');
  let selectedItems = [];
  let selectedIds = [];

  $(document).on('click', '.cashierdropdown', function (e) {
    e.preventDefault();
    const name = $(this).text().trim();
    const myid = $(this).attr('myid');
    if (!selectedItems.includes(name)) {
      selectedItems.push(name);
      selectedIds.push(myid);
      input.value = selectedItems.join(', ');
    }
  });

  input.addEventListener('input', function () {
    const typedNames = input.value.split(',').map(n => n.trim()).filter(n => n);
    const newItems = [];
    const newIds = [];
    selectedItems.forEach((item, index) => {
      if (typedNames.includes(item)) {
        newItems.push(item);
        newIds.push(selectedIds[index]);
      }
    });
    selectedItems = newItems;
    selectedIds = newIds;
    input.value = selectedItems.join(', ');
  });

  // ======== Warehouse Section ========
  const warehouseInput = document.getElementById('warehouseInput');
  let warehouseItems = [];
  let warehouseIds = [];

  $(document).on('click', '.warehousedrrpdown', function (e) {
    e.preventDefault();
    const name = $(this).text().trim();
    const myid = $(this).attr('myid');
    if (!warehouseItems.includes(name)) {
      warehouseItems.push(name);
      warehouseIds.push(myid);
      warehouseInput.value = warehouseItems.join(', ');
    }
  });

  warehouseInput.addEventListener('input', function () {
    const typedNames = warehouseInput.value.split(',').map(n => n.trim()).filter(n => n);
    const newItems = [];
    const newIds = [];
    warehouseItems.forEach((item, index) => {
      if (typedNames.includes(item)) {
        newItems.push(item);
        newIds.push(warehouseIds[index]);
      }
    });
    warehouseItems = newItems;
    warehouseIds = newIds;
    warehouseInput.value = warehouseItems.join(', ');
  });

  // ======== Store Section ========
  const storeInput = document.getElementById('storeInputbox');
  let storeItems = [];
  let storeIds = [];

  $(document).on('click', '.storewarehousedrpdown', function (e) {
    e.preventDefault();
    const name = $(this).text().trim();
    const myid = $(this).attr('myid');
    if (!storeItems.includes(name)) {
      storeItems.push(name);
      storeIds.push(myid);
      storeInput.value = storeItems.join(', ');
    }
  });

  storeInput.addEventListener('input', function () {
    const typedNames = storeInput.value.split(',').map(n => n.trim()).filter(n => n);
    const newItems = [];
    const newIds = [];
    storeItems.forEach((item, index) => {
      if (typedNames.includes(item)) {
        newItems.push(item);
        newIds.push(storeIds[index]);
      }
    });
    storeItems = newItems;
    storeIds = newIds;
    storeInput.value = storeItems.join(', ');
  });

  // ======== Submit Form ========
  $('#saveAssigntask').on('submit', function (e) {
    e.preventDefault();

    let branch_id = $('#branch').val();
    let branch_name = $('#branch option:selected').text();

    if (!branch_id) {
      toastr.info("Please enter the branch");
      return false;
    }

    console.clear();
    console.log("Branch ID:", branch_id);
    console.log("Branch Name:", branch_name);
    console.log("Cashier IDs:", selectedIds);
    console.log("Warehouse IDs:", warehouseIds);
    console.log("Store IDs:", storeIds);

    $.ajax({
      url: 'action.php',
      method: 'POST',
      data: {
        branch_id: branch_id,
        branch_name: branch_name,
        cashierIds: selectedIds,
        warehouseIds: warehouseIds,
        storeIds: storeIds, 
        assigntobranches:55
      },
      success: function (data) {
        console.log(data); 
      },
      error: function (err) {
        alert("Error occurred: " + err.responseText);
      }
    });
  });
</script>



