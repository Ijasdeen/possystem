 
$(document).ready(function(){
    const showoffemployees = () => {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { fetchEmployees: 44 },
            success: function(response) {
            // Handle the response, e.g., display customers
            $('#showemployees').html(response);
            },
            error: function(xhr, status, error) {
            toastr.error('Failed to fetch customers.');
            }
        });
    }

    showoffemployees(); 

      $('body').on('.editEmployees','click',function(e){
        
      }); 

     $('#saveEmployeessformsection').on('keydown', 'input:visible, select:visible, textarea:visible', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();

            const focusable = $('#saveEmployeessformsection').find('input:visible, select:visible, textarea:visible').filter(':not([readonly]):not([disabled])');
            const index = focusable.index(this);

            if (index > -1 && index + 1 < focusable.length) {
                focusable.eq(index + 1).focus();
            } else {
                $('#saveEmployeessform').submit(); // Submit if it's the last field
            }
        }
    });

  

    $('#saveEmployeessformsection').on('submit', function(e){
    e.preventDefault();
   

    let fullname = $('#fullnamesection').val().trim(); 
    let nicnumber = $('#nicnumber').val().trim(); 
    let workingdays = $('#workingdays').val().trim(); 
    let basicsalary = $('#basicsalary').val().trim(); 
    let epfchecks = $('#flexCheckDefault').is(':checked') ? 1 : 0; 
    let epfbasicsalary = $('#epfbasicsalary').val().trim(); 
    let myaddress = $("#myaddress").val().trim(); 

    const now = new Date();
const year = now.getFullYear();
const month = now.getMonth(); // 0-indexed (0 = January, 11 = December)

// Get number of days in current month
const daysInMonth = new Date(year, month + 1, 0).getDate();
  

    if(fullname=='' || !fullname){
       toastr.info("Please enter the full name");
       $('#fullnamesection').css('border','2px solid red').focus(); 
       return false; 
    }

    if(basicsalary=='' || !basicsalary || basicsalary==0){
        basicsalary = daysInMonth; 
    }

 
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            fullname: fullname,
            nicnumber: nicnumber,
            workingdays: workingdays,
            basicsalary: basicsalary,
            epfchecks: epfchecks,
            epfbasicsalary: epfbasicsalary, 
            myaddress:myaddress, 
            saveemployeesection:55
        },
        success: function(response) {
            if(response==1){
                toastr.success("Saved successfully");
                $('#addCategoryModal').modal('hide'); 
                $('#saveEmployeessformsection')[0].reset();  
            }
            else if(response==12){

            }
            else {
                alert(response); 
            }
         
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
            alert('Something went wrong. Please try again.');
        }
    });
});



}); 
