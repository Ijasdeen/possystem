<?php
require_once('connection.php'); 
session_start(); 
if (isset($_SESSION['admin_name'])) {
    echo "<script>window.location.href='index.php';</script>"; 
    exit;
}
?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login to admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <svg
                      width="25"
                      viewBox="0 0 25 42"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs>
                        <path
                          d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                          id="path-1"
                        ></path>
                        <path
                          d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                          id="path-3"
                        ></path>
                        <path
                          d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                          id="path-4"
                        ></path>
                        <path
                          d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                          id="path-5"
                        ></path>
                      </defs>
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                          <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                              <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                              </mask>
                              <use fill="#696cff" xlink:href="#path-1"></use>
                              <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                              </g>
                              <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                              </g>
                            </g>
                            <g
                              id="Triangle"
                              transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                              <use fill="#696cff" xlink:href="#path-5"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Main Admin panel</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to Main admin panel! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>

              <form id="formAuthentication" class="mb-3"  method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Mobile Number</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="mobileNumber"
                    name="email-username"
                    placeholder="Enter your mobile number"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="forgotpassword.php">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
               
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

               
            </div>
          </div>
        
        </div>
      </div>
    </div>



    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-dark">
                                <h5 class="modal-title text-white" id="exampleModalLabel1">Quick login by Card</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Scan</label>
                                    <input type="password" id="nameBasicsection" class="form-control" placeholder="Scan your card for quick login" />
                                  </div>
                                </div>
                            
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

 
    <div class="buy-now">
      <a
        href="javascript:void(0);"
        class="btn btn-primary btn-buy-now"
        data-bs-toggle="modal"
        data-bs-target="#basicModal"
        >Login with ID card</a
      >
    </div>

     
    <div class="modal fade" id="exampleModaltitlesection">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

 

    
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
  

        $(document).ready(function(){

            $('#nameBasicsection').on('keypress', function(e) {
                if (e.which === 13) { // Enter key pressed
                    e.preventDefault(); // Prevent default action
                    var cardInput = $.trim($(this).val());

                    if (cardInput == '') {
                        toastr.error("Please scan your card for quick login");
                        $(this).css('border', '2px solid red').focus();
                        return false;
                    }

                    $.ajax({
                        url: 'action.php',
                        type: 'POST',
                        data: {
                            cardInput: cardInput,
                            quickLogin: 2323
                        },
                        success: function(response) {
                            if (response == 1) {
                                window.location.reload();
                            } else {
                                toastr.error('Invalid card. Please try again.');
                                $(this).css('border', '2px solid red').focus(); // Keep focus on the input
                                return false; 
                            }
                        },
                        error: function() {
                            toastr.error('An error occurred. Please try again later.');
                            $(this).css('border', '2px solid red').focus(); // Keep focus on the input
                            return false;
                        }
                    });
                }
            });


            function openFullScreen() {
    var elem = document.documentElement; // Whole page

    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { // Safari
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { // IE11
        elem.msRequestFullscreen();
    }
}


openFullScreen(); 



  $('input').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            var inputs = $('input[type="text"], input[type="email"], input[type="password"], input[type="tel"]');
            var index = inputs.index(this);
            if (index + 1 < inputs.length) {
                inputs.eq(index + 1).focus();
            } else {
                $('#formAuthentication').submit();
            }
        }
    });

     $('#password').on('keypress', function (e) {
        if (e.which === 13) { // Enter key
            e.preventDefault(); // Prevent default Enter key behavior
            $('#formAuthentication').submit(); // Submit the form
        }
    });

     function getReadableDeviceInfo() {
    const ua = navigator.userAgent;
    let os = "Unknown OS";
    let browser = "Unknown Browser";

    // Detect OS
    if (ua.indexOf("Windows NT 10.0") !== -1) os = "Windows 10";
    else if (ua.indexOf("Windows NT 6.3") !== -1) os = "Windows 8.1";
    else if (ua.indexOf("Windows NT 6.2") !== -1) os = "Windows 8";
    else if (ua.indexOf("Windows NT 6.1") !== -1) os = "Windows 7";
    else if (ua.indexOf("Mac OS X") !== -1) os = "macOS";
    else if (ua.indexOf("Android") !== -1) os = "Android";
    else if (ua.indexOf("iPhone") !== -1) os = "iOS";
    else if (ua.indexOf("Linux") !== -1) os = "Linux";

    // Detect Browser
    if (ua.indexOf("Chrome") !== -1 && ua.indexOf("Edg") === -1) {
        browser = "Google Chrome";
    } else if (ua.indexOf("Firefox") !== -1) {
        browser = "Mozilla Firefox";
    } else if (ua.indexOf("Safari") !== -1 && ua.indexOf("Chrome") === -1) {
        browser = "Safari";
    } else if (ua.indexOf("Edg") !== -1) {
        browser = "Microsoft Edge";
    } else if (ua.indexOf("MSIE") !== -1 || ua.indexOf("Trident/") !== -1) {
        browser = "Internet Explorer";
    }

    return {
        os: os,
        browser: browser,
        userAgent: ua
    };
}


                $('#formAuthentication').on('submit', function(e) {
                    e.preventDefault(); // Prevent the default form submission
                    var mobileNumber = $('#mobileNumber').val();
                    var password = $('#password').val();

                    if(mobileNumber==''){
                        toastr.error("Please enter the mobile number"); 
                        $('#mobileNumber').css('border','2px solid red').focus(); 
                        return false; 
                    }
                    if(password==''){
                        toastr.error("Please enter the password"); 
                        $('#password').css('border','2px solid red').focus(); 
                        return false; 
                    }

                    const deviceInfo = getReadableDeviceInfo();

                    $.ajax({
                        url: 'action.php',
                        type: 'POST',
                        data: {
                            mobileNumber: mobileNumber,
                            password: password,
                            operating : deviceInfo.os, 
                            browser:deviceInfo.browser, 
                            userAgent:deviceInfo.userAgent, 
                            loginnow:55
                        },
                        success: function(response) {
                            console.clear(); 
                            console.log(response);
                            if (response == 1) {
                               window.location.reload(); 
                            } else {
                                toastr.error('Invalid login credentials. Please try again.');
                            }
                        },
                       error: function(xhr, status, error) {
                console.error("AJAX Error Details:");
                console.error("Status: " + status);
                console.error("HTTP Code: " + xhr.status);
                console.error("Response Text: " + xhr.responseText);
                console.error("Error: " + error);

    alert('An error occurred:\n' + xhr.status + ' - ' + error + '\nPlease check the console for details.');
}

                    });
                   
                });

                
        }); 
    </script>

  </body>
</html>
