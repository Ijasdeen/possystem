<?php
require_once('layouts/header.php')
?>
 <?php
 $query = "SELECT admin_name, shop_name, shop_logo, mobilenumber FROM `admin`";
$result = mysqli_query($connection, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Do something with $row, e.g.:
        // echo $row['admin_name'];
    } else {
        echo "No records found.";
    }
} else {
    echo "Query error: " . mysqli_error($connection);
}

 ?>
 
<div class="content-wrapper">
 
 
      
            <div class="container-xxl flex-grow-1 container-p-y">
 
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Update profile</h4>
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
                 <div class="card-body">
                  <form method="POST" id="shopLogoform" enctype="multipart/form-data">
  <div class="container">
    <div class="text-center mb-4">
      <img src="uploads/<?php echo $row['shop_logo'] ?? '' ?>" id="logoset" class="img-responsive" style="max-width:200px; max-height:200px;" alt="">
    </div>
    <div class="row">
      <div class="col-md-3">
        <label for="admin_name">Admin Name</label>
        <input type="text" name="admin_name" 
        required value="<?php echo $row['admin_name'] ?? '' ?>" class="form-control" 
        id="admin_name">
      </div>
      <div class="col-md-3">
        <label for="shop_name">Shop Name</label>
        <input type="text" name="shop_name" required value="<?php echo $row['shop_name'] ?? '' ?>" 
        class="form-control" id="shop_name">
      </div>
      <div class="col-md-3">
        <label for="shop_mobile">Admin Mobile</label>
        <input type="text" name="shop_mobile" required value="<?php echo $row['mobilenumber'] ?? '' ?>" 
        class="form-control" id="shop_mobile">
      </div>
      <div class="col-md-3">
        <label for="admin_logo">Shop Logo</label>
       <input type="file" name="admin_logo" accept="image/*" class="form-control" id="admin_logo">
       </div>
      <div class="col-md-12 my-2">
        <button type="submit" class="btn btn-primary btn-sm">UPDATE details</button>
      </div>
    </div>
  </div>
</form>

                 </div>
              </div>
            
            </div>
           
            <div class="content-backdrop fade"></div>
          </div>


         
      
<?php
require_once('layouts/footer.php');
?>

 <script src="js/customers.js" defer></script>

 <script>
 

$(document).ready(function(){
      $('#shopLogoform').on('submit', function(e) {
  e.preventDefault(); // Prevent default form submission

  var formData = new FormData(this); // Collect all form fields including file
    formData.append('Updateform', 5); // Add custom field

  $.ajax({
    url: 'action.php',
    type: 'POST',
    data: formData,
    contentType: false, // Required for FormData
    processData: false, // Required for FormData
    success: function(response) {
      console.log(response); // Log the response
     
      alert('Profile updated successfully!');
    },
    error: function(xhr, status, error) {
      console.error(error);
      alert('Something went wrong!');
    }
  });
});

})
</script>
<script>
    $(document).ready(function () {
  const $inputs = $("#shopLogoform input");
  const totalInputs = $inputs.length;

  $inputs.each(function (index) {
    $(this).on("keydown", function (e) {
      if (e.key === "Enter") {
        e.preventDefault();

        if ($(this).attr("id") === "admin_logo") {
          $("#shopLogoform").submit();
        } else {
          const nextIndex = index + 1;
          if (nextIndex < totalInputs) {
            $inputs.eq(nextIndex).focus();
          } else {
            $("#shopLogoform").submit();
          }
        }
      }
    });
  });
});

</script>