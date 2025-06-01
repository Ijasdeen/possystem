
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by B.M. Ijas deen (0774605737) 
                </div>
                <div>
                 
 
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


        <div class="modal fade" id="changePasswordmodal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-dark">
                                <h5 class="modal-title text-white" id="exampleModalLabel1">Change Password</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                 <form id="changeOldpasswordform" method="POST">
                                  <div class="form-group">
                                    <label for="">OLD password</label>
                                    <input type="password" class="form-control" id="oldpassword">
                                  </div>
                                  <div class="form-group">
                                    <label for="">New password</label>
                                    <input type="password" name="newpassword" id="newpassword" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                                  </div>
                                  <div class="form-group my-2">
                                    <button type="submit" class="form-control btn btn-primary">Change password</button>
                                  </div>
                                 </form>
                            
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                               
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.all.min.js
"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
      $(document).ready(function() {


         $('#changeOldpasswordform').on('submit',function(e){
            e.preventDefault();
            let oldpassword = $('#oldpassword').val().trim(); 
            let newpassword = $('#newpassword').val().trim(); 
            let confirmpassword = $('#confirmpassword').val().trim(); 

            if(oldpassword==''){
              toastr.info("Please enter the old password"); 
              $('#oldpassword').css('border','2px solid red').focus(); 
              return false; 
            }
            if(newpassword==''){
              toastr.info("Please enter the new password");
              $("#newpassword").css('border','2px solid').focus(); 
              return false;  
            }

            if(confirmpassword==''){
               toastr.info("Please enter the confirm password"); 
               $('#confirmpassword').css('border','2px solid red').focus(); 
               return false; 
            }

            if(newpassword!=confirmpassword){
                toastr.info("Confirm password mismatches");
                $('#confirmpassword').css('border','2px solid red').focus(); 
                return false; 
            }

            $.ajax({
              url:'action.php', 
              method:'post',
              data:{
                oldpassword:oldpassword, 
                  confirmpassword:confirmpassword, 
                  changepassword:55
              },
              success:function(data){
                   if(data==1){
                      $('#changeOldpasswordform')[0].reset(); 
                      $('#changePasswordmodal').modal('hide'); 
                      toastr.success("Updated successfully"); 
                   }
                   else if(data==12)
                      {
                        toastr.error("Old password is incorrect"); 
                        $('#oldpassword').css('border','2px solid').focus();
                        return false; 
                      }
                   else {
                     toastr.error(data); 
                   }
              },
              error:function(err){
                alert("Error found" + err); 
              }
            })

         }); 

        $('#changePaswordtrigger').on('click',function(){
           $("#changePasswordmodal").modal('show'); 
        }); 
    // When the close button is clicked
    $('.close').on('click', function() {
        $('#myModal').modal('hide');
    });
});

    </script>
  </body>
</html>
