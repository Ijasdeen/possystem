$(document).ready(function(){
  

   const showOffBrands = () => {
    fetch('action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            showOffBrands: 55
        })
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('showbrandssection').innerHTML = data;
    })
    .catch(error => {
        alert('Error found in: ' + error);
    });
};


    showOffBrands(); 

  $('body').on('click', '.editbrandsection', function(e) {
    e.preventDefault();

    let brandId = $(this).attr('myid');
    let name = $(this).attr('name'); 
    $('#uname').val(name); 
    sessionStorage.setItem('brand_id',brandId); 
    $('#editBrandsection').modal('show'); 

    
});

$('#updateBrands').on('submit',function(e){
    e.preventDefault(); 
    let brand_id = sessionStorage.getItem('brand_id'); 
    let name = $('#uname').val(); 

    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            action: 'update_brand',
            id: brand_id,
            name:name 
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                toastr.info("Updated successfully"); 
                showOffBrands(); 
                $('#editBrandsection').modal('hide');
            } 
            else if(response.status=='exist'){
                toastr.error("It already exists"); 
                $('#uname').css('border','2px solid red').focus(); 
                return false; 
            }
            else {
                toastr.error(response.message || 'Failed to fetch brand data');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Request failed: ' + error);
        }
    });


}); 

    $('body').on('click', '.deleteBrand', function(e) {
    e.preventDefault();

    let brandid = $(this).attr('myid');

    if (!confirm('Are you sure you want to delete this brand?')) return;

    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            action: 'delete_brand',
            id: brandid
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                toastr.success('Brand deleted successfully');
                showOffBrands(); 
                // Optionally remove the brand from UI
                // $(this).closest('tr').remove();
            } else {
                toastr.error(response.message || 'Failed to delete brand');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Request failed: ' + error);
        }
    });
});


    $('#saveBrands').on('submit', function(e) {
    e.preventDefault();

    let brandName = $('#name').val();

    if(brandName==''){
        toastr.error("Enter the brand name"); 
        $('#name').css('border','2px solid red').focus(); 
        return false; 
    }
 
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
             saveBrandssection:55, 
            name: brandName
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                toastr.success('Brand saved successfully');
                $('#saveBrands')[0].reset();
                    showOffBrands(); 
            } 
            else if(response.status=='exist'){
                toastr.error("Brand name already exists"); 
                $('#name').css('border','2px solid red').focus(); 

            }
            else {
                toastr.error(response.message || 'Something went wrong');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Request failed: ' + error);
        }
    });
});

}); 