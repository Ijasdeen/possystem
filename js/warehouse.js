$(document).ready(function(){

    const showBranches = () => {
    fetch('action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'showarehouses=1'
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('showbranches').innerHTML = data;
    })
    .catch(error => {
        toastr.error('Error loading branches: ' + error);
    });
};

    showBranches(); 


    $('body').on('click', '.deleteBranch', function (e) {
    e.preventDefault();
    const id = $(this).attr('myid');
     
    if (confirm('Are you sure you want to delete this branch?')) {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { deleteWarehouse: true, id: id },
            success: function (response) {
                if (response.trim() === '1') {
                    toastr.success('Warehouse deleted successfully');
                    showBranches(); // Refresh the list
                } else {
                    toastr.error('Failed to delete branch');
                }
            },
            error: function () {
                toastr.error('An error occurred while deleting');
            }
        });
    }
});


$('#updateBranches').on('submit', function(e) {
    e.preventDefault();

    let id = $('#updateBranches').data('id'); // you must set this when opening modal
    let name = $('#uname').val().trim();
    let address = $('#uaddress').val().trim();
    let mobile = $('#umobile').val().trim();
    let landline = $('#ulandline').val().trim();
    let email = $('#uemail').val().trim();
 

    if (name === '') {
        toastr.error('Name is required.');
        return;
    }

    if (mobile !== '' && !/^\d{10}$/.test(mobile)) {
        toastr.error('Mobile number must be exactly 10 digits.');
        return;
    }

    if (landline !== '' && !/^\d{10}$/.test(landline)) {
        toastr.error('Mobile number must be exactly 10 digits.');
        return;
    }

    // You can add optional email format check
    if (email !== '' && !/^\S+@\S+\.\S+$/.test(email)) {
        toastr.error('Invalid email format.');
        return;
    }

    $.ajax({
        url: 'action.php',
        method: 'POST',
        data: {
            updatewarehouse: 143,
            id: sessionStorage.getItem('branch_id'),
            name: name,
            address: address,
            mobile: mobile,
            landline: landline,
            email: email
        },
        success: function(response) {
            if (response.trim() === '1') {
                toastr.success('Warehouse updated successfully');
                $('#updateBranches')[0].reset();
                $('#brancheditModalsection').modal('hide');
                showBranches();  
            } else {
                toastr.error('Update failed');
            }
        },
        error: function() {
            toastr.error('AJAX error');
        }
    });
});



$('body').on('click', '.editBranch', function (e) {
    e.preventDefault();
  
    sessionStorage.setItem('branch_id',$(this).attr('myid')); 
    $('#uname').val($(this).attr('name'));
    $('#uaddress').val($(this).attr('address'));
    $('#umobile').val($(this).attr('mobile'));
    $('#ulandline').val($(this).attr('landline'));
    $('#uemail').val($(this).attr('email'));

   
    $('#brancheditModalsection').modal('show');
});


    $('#saveBranches').on('submit', function(e) {
    e.preventDefault();

    let name = $('#name').val().trim();
    let address = $('#address').val().trim();
    let mobile = $('#mobile').val().trim();
    let landline = $('#landline').val().trim();
    let email = $('#email').val().trim();


    if (name === '') {
        toastr.warning('Name is required.');
        return;
    }

    if (mobile !== '' && !/^\d{10}$/.test(mobile)) {
        toastr.warning('Mobile number must be exactly 10 digits.');
        return;
    }

    if (landline !== '' && !/^\d{10}$/.test(landline)) {
        toastr.warning('Mobile number must be exactly 10 digits.');
        return;
    }

    // You can add optional email format check
    if (email !== '' && !/^\S+@\S+\.\S+$/.test(email)) {
        toastr.warning('Invalid email format.');
        return;
    }


    $.ajax({
        url: 'action.php',
        type: 'POST',
        dataType: 'json',
        data: {
            savewarehousesection: 1, // identifier for PHP
            name: name,
            address: address,
            mobile: mobile,
            landline: landline,
            email: email
        },
        success: function(response) {
            if (response.status === 'success') {
                     $('#name').focus(); 
                toastr.success("Warehouse saved successfully");
                $('#saveBranches')[0].reset();
                    showBranches(); // Refresh the list

            } else if (response.status === 'exist') {
                toastr.warning(response.message);
            } else {
                toastr.error(response.message || 'Something went wrong.');
            }
        },
        error: function(xhr, status, error) {
            toastr.error("AJAX Error: " + error);
        }
    });
});

}); 