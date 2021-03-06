<?php include_once("includes/links_frontend.php"); ?>
<div class="col-xs-12 side-modal-box" id="side-modal">
    <div class="col-xs-12 side-modal-main-box">
        <div class="login-box" id="login">
            <div class="book-header">
                <p>LOGIN</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <form class="book-content" method="POST">
                <div class="book-content-inner">
                     <p class="error_msg" style="font-size: 16px;text-align: center;margin-bottom: 35px;box-shadow: 0 0 15px #00000033;padding: 10px;color: red;display:none"> </p>
                    <div class="col-xs-12 form-group">
                       <input type="email" placeholder="Email Id" class="login_email" name="email" autocomplete="off">
                       <small class="login_error_email" style="color:red"></small>
                    </div>
                    <div class="col-xs-12 form-group">
                       <input type="password" placeholder="Password" class="login_password" name="password" autocomplete="off">
                       <small class="login_error_password" style="color:red"></small>
                    </div>
                   
                    <div class="col-xs-12 form-group">
                        <a onclick="forgetpass()" style="cursor:pointer;">Forgot Password</a>
                    </div>
                    <div class="col-xs-12 form-group forget-password-item" dep="forget-password">
                        <!-- <label>Full Name</label> -->
                        <input type="text" placeholder="Email Id">
                        <button type="button">SUBMIT</button>
                    </div>
                    <style>
                        .forget-password-item
                        {
                            display: none;
                        }
                    </style>
                    <script>
                        function forgetpass()
                        {
                            $("div[dep=forget-password]").slideToggle();
                        }
                    </script>
                </div>
                <div class="book-footer">
                    <div class="total">

                        <p class="prd-price">Do Not have Account?</p>
                        <a onclick="openregi()" style="cursor: pointer;">Register Now</a>
                    </div>
                    <div style="float:right;">
                        <!-- <button type="button" id="nextBtn" onclick="nextPrev(1)" class="demo-class">LOGIN</button> -->
                        <button type="button" class="demo-class loginBtn">LOGIN</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="regi-box" id="regi">
            <div class="book-header">
                <p>REGISTRATION</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <form class="book-content" method="POST">
                <div class="book-content-inner">
                      
                        <div class="col-xs-12 form-group">
                            <input type="text" placeholder="Full Name"  name="name" class="reg_fullname">
                            <small class="error_reg_fullname" style="color:red"></small>
                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="text" placeholder="Mobile Number" name="mobile" class="reg_mobile" onkeypress=" return isNumber(event)">
                            <small class="error_reg_mobile" style="color:red"></small>
                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="email" placeholder="Email Id" name="email" class="reg_email">
                            <small class="error_reg_email" style="color:red"></small>

                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="text" placeholder="Location" name="location" class="reg_location">
                            <small class="error_reg_location" style="color:red"></small>

                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="text" placeholder="City" name="city" class="reg_city">
                            <small class="error_reg_city" style="color:red"></small>
                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="text" placeholder="State" name="state" class="reg_state">
                            <small class="error_reg_state" style="color:red"></small>
                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="text" placeholder="Country" name="country" class="reg_country">
                            <small class="error_reg_country" style="color:red"></small>
                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="text" placeholder="Pin Code" name="pincode" class="reg_pincode" onkeypress=" return isNumber(event)">
                            <small class="error_reg_pincode" style="color:red"></small>
                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="password" placeholder="Password" name="password" class="reg_password">
                             <small class="error_reg_password" style="color:red"></small>
                        </div>
                        <div class="col-xs-12 form-group">
                            <input type="password" placeholder="Confirm Password" class="reg_confirm_password">
                            <small class="error_reg_confirm_password" style="color:red"></small>
                        </div>
                        <div>
                        <p class="reg_success" style="font-size: 16px;text-align: center;margin-bottom: 35px;box-shadow: 0 0 15px #00000033;padding: 10px;color: #207da4;dispay:none"></p>
                    </div>
                </div>

                <div class="book-footer">
                    <div class="total">

                        <p class="prd-price">Already have Account?</p>
                        <a onclick="openlogin()" style="cursor: pointer;">Login Now</a>
                    </div>
                    <div style="float:right;">
                        <button type="button" class="demo-class registerBtn">REGISTER</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-box" id="enquery">
            <div class="book-header">
                <p>ENQUIRY</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <form method="post" action="mail-process.php" class="book-content enquiry_form">
                <div class="book-content-inner">
                     <p class="enq_success" style="font-size: 16px;text-align: center;margin-bottom: 35px;box-shadow: 0 0 15px #00000033;padding: 10px;color: #207da4;display:none"> </p>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Full Name" name="name" id="fname">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Email Id" name="email" id="userEmail">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Mobile Number" name="mobile" id="userMobile">
                        </div>
                        <div class="col-xs-12 form-group pl pr">
                            <div class="col-xs-4 rc pl">
                                <label>BEGINNER
                                    <div>
                                        <input type="radio" name="enquiry" value="BEGINNER" checked="" id="BEGINNER">
                                        <span class="checkmark"></span>
                                    </div>

                                </label>
                            </div>
                            <div class="col-xs-4 rc pr">
                                <label>ADVANCED
                                    <input type="radio" name="enquiry" value="ADVANCED" id="ADVANCED">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-xs-4 rc pr">
                                <label>PROFESSIONAL
                                    <input type="radio" name="enquiry" value="PROFESSIONAL" id="PROFESSIONAL">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-12 form-group">
                            <textarea placeholder="Message" name="message" id="message"></textarea>
                        </div>
                   
                </div>
                <div class="book-footer">

                    <div style="float:right;">
                        <button type="button" id="nextBtn" class="demo-class" onclick="return enquiryForm();">SUBMIT</button>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="login-box" id="techbook">
            <div class="book-header">
                <p>BOOKING</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <form class="book-content" method="post" action="mail-process.php">
                <div class="book-content-inner">
                    
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Full Name" name="fullname" id="fullname">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Email Id" name="emailId" id="emailId">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Mobile Number" name="mobileNo" id="mobileNo">
                        </div>
                        <div class="col-xs-12 form-group">
                            <select name="support_option" id="support_option">
                                <option value=''>Support Option</option>
                                <option value='Desktop Computer, Laptop, and Printer Repairs'>Desktop Computer, Laptop, and Printer Repairs</option>
                                <option value='Network configuration, fix problems, and upgrades'>Network configuration, fix problems, and upgrades</option>
                                <option value='Fix Security and Printer problems'>Fix Security and Printer problems</option>
                                <option value='Fix Slow PC problem'>Fix Slow PC problem</option>
                                <option value='Virus and Spyware protection &amp; removal'>Virus and Spyware protection &amp; removal</option>
                                <option value='Software installation'>Software installation</option>
                                <option value='Email services (Set up and Configure)'>Email services (Set up and Configure)</option>
                                <option value='Fix Hard drive issues, data back-up, and recovery'>Fix Hard drive issues, data back-up, and recovery</option>
                                <option value='Fix hardware problem and upgrades for better performance'>Fix hardware problem and upgrades for better performance</option>
                            </select>
                        </div>
                        <div class="col-xs-12 form-group">
                            <textarea placeholder="Message" name="msg" id="msg"></textarea>
                        </div>
                    

                </div>
                <div class="book-footer">

                    <div style="float:right;">
                        <button type="button" id="nextBtn" class="demo-class" onclick="return validate();">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-box" id="cartbox">
            <div class="book-header">
                <p>CART</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>

            <form class="book-content">
                <div class="book-content-inner cartItems">
<!--                     <div class="order-list">
                        <div class="item-pic">
                            <img src="images/prd-1.png">
                            <input type="number" min="1" max="10" value="1">
                        </div>
                        <div class="item-details">
                            <p class="prd-name">Product name</p>
                            <p class="prd-id">product id</p>
                            <p class="deliver-date">Delivery by Sun 21 Jun | Free</p>
                            <p class="prd-price">$200</p>
                            <button class="rmv-btn">Remove</button>
                        </div>
                    </div>
                    <div class="order-list">
                        <div class="item-pic">
                            <img src="images/prd-1.png">
                            <input type="number" min="1" max="10" value="1">
                        </div>
                        <div class="item-details">
                            <p class="prd-name">Product name</p>
                            <p class="prd-id">product id</p>
                            <p class="deliver-date">Delivery by Sun 21 Jun | Free</p>
                            <p class="prd-price">$200</p>
                            <button class="rmv-btn">Remove</button>
                        </div>
                    </div> -->
      <!--               <table class="table totalpayble">
                        <thead>
                            <tr>
                                <th colspan="2">Price Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Price( 2 Items )
                                </td>
                                <td>
                                    $400
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Delivery Charge
                                </td>
                                <td>
                                   Free
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Payble
                                </td>
                                <td>
                                    $400
                                </td>
                            </tr>
                        </tfoot>
                    </table> -->
                </div>
                <div class="book-footer cartFooter">
                    <div class="total">
                        <h5>Total Payble</h5>
                        <p class="prd-price totalPayableAmount">
                            <!-- $200  -->
                             <!-- <a href="">view details</a> -->
                        </p>
                        
                    </div>
                    <div style="float:right;">
                        <button type="button" id="nextBtn" class="demo-class" onclick="window.location.href='checkout.php'">Proceed</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function validate()
    {
      var fullname           =   $('#fullname').val();
      var emailId            =   $('#emailId').val();
      var mobileNo           =   $('#mobileNo').val();
      var support_option     =   $('#support_option').val();

      var msg                =   $('#msg').val();
    
      var flag = 0;
      if(fullname =='')
        {
            alert('Please enter your name');
            $('#name').focus();
            flag++;
        }
        if(emailId =='')
        {
            alert('Please enter your email address');
            $('#email').focus();
            flag++;
        }
        if(mobileNo =='')
        {
            alert('Please enter your mobile number');
            $('#mobileno').focus();
            flag++;
        }
        if(support_option =='')
        {
            alert('Please enter your Support Option');
            flag++;
        }
        if(msg =='')
        {
            alert('Please enter your query');
            $('#message').focus();
            flag++;
        }

      
      if(flag>0)
      {
        return false;
      }else{
            $.ajax({
                url :"<?php echo $cfg['base_url'].'mail-process.php?act=booking'?>",
                type: "POST",
                data : { name : fullname, email: emailId, mobileno: mobileNo,support: support_option, massage:msg},
                success : function(response){
                    if (response !='') {
                        response = response.trim();
                       if(response == 'true') {
                            alert('Email Send successfully');
                            window.location.href="tech-support.php";
                       } else {
                            alert('Something went wrong');
                       } 
                    }
                   
                    event.preventDefault();
                }
            });
      }
      
    }
</script>

<script>
    function enquiryForm()
    {
      var fname              =   $('#fname').val().trim();
      var userEmail          =   $('#userEmail').val().trim();
      var userMobile         =   $('#userMobile').val().trim();
      var message            =   $('#message').val().trim();
    
      var flag = 0;
      if(fname =='')
        {
            alert('Please enter your name');
            $('#fname').focus();
            flag++;
        }
        if(userEmail =='')
        {
            alert('Please enter your email address');
            $('#userEmail').focus();
            flag++;
        }
        if(userMobile =='')
        {
            alert('Please enter your mobile number');
            $('#userMobile').focus();
            flag++;
        }
        
        if(message =='')
        {
            alert('Please enter your query');
            $('#message').focus();
            flag++;
        }

      
      if(flag>0)
      {
        return false;
      }else{
            $.ajax({
                url :"<?php echo $cfg['base_url'].'mail-process.php?act=Enquiry_training'?>",
                type: "POST",
                data : { name : fname, email: userEmail, mobileno: userMobile,enquiry: $('input[name="enquiry"]:checked').val(), massage:message},
                success : function(response){
                    if (response !='') {
                        response = response.trim();
                        $('.enquiry_form').trigger('reset');
                       if(response == 'true') {
                            // swal({
                            //     title: "Congratulation",
                            //     text: "Your enquiry submitted successfully",
                            //     timer: 3000
                            // }).
                            // alert('Email Send successfully');
                            // window.location.href="computer-training.php";
                            $('.enq_success').text('Your enquery has been submitted successfully').css('display','block');
                            setTimeout(function(){
                                location.reload();
                            },1500);
                       } else {
                            alert('Something went wrong');
                       } 
                    }
                   
                    event.preventDefault();
                }
            });
      }
      
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // fetch cart items
        $('.loginBtn').click(function(event){
            let error = 0;
            $('.login_error_email, .login_error_password').text('');
            let login_email = $('.login_email').val().trim();
            let login_password = $('.login_password').val().trim();

            if(login_email == '') {
                $('.login_error_email').text('Enter Email');
                error++;
            }

            if(login_email != '' && (isEmail(login_email) == false)) {
                $('.login_error_email').text('Invalid Email Format');
                error++;   
            }
            if(login_password == '') {
                $('.login_error_password').text('Enter Password');
                error++;
            }
            if (error>0) {
                event.preventDefault();
            } else {
                $.ajax({
                    url : "<?php echo 'mail-process.php?act=login'; ?>",
                    dataType : 'JSON',
                    type : 'POST',
                    data : { email : login_email, password : login_password },
                    success : function(response) {
                        if(response != '') {
                            if(response.status) {
                                // alert(response.message);
                                // setTimeout(function() {
                                //     location.reload();
                                // },1200);
                                location.reload();
                            } else {
                                //alert(response.message);
                                 $('.error_msg').text(response.message).css('display','block');
                            }
                        } else {
                            //alert('Something went wrong. Please went wrong');
                             $('.error_msg').text('Something went wrong. Please went wrong').css('display','block');
                        }
                    }
                });
            }
        });

        $('.registerBtn').click(function(event) {

            let error = 0;
            $('.error_reg_fullname, .error_reg_mobile, .error_reg_email, .error_reg_location, .error_reg_city, .error_reg_state, .error_reg_country, .error_reg_pincode, .error_reg_password, .error_reg_confirm_password').text('');
            let reg_fullname            =   $('.reg_fullname').val().trim();
            let reg_mobile              =   $('.reg_mobile').val().trim();
            let reg_email               =   $('.reg_email').val().trim();
            let reg_location            =   $('.reg_location').val().trim();
            let reg_city                =   $('.reg_city').val().trim();
            let reg_state               =   $('.reg_state').val().trim();
            let reg_country             =   $('.reg_country').val().trim();
            let reg_pincode             =   $('.reg_pincode').val().trim();
            let reg_password            =   $('.reg_password').val().trim();
            let reg_confirm_password    =   $('.reg_confirm_password').val().trim();

            if(reg_fullname == '') {
                $('.error_reg_fullname').text('Name is required');
                error++;   
            }
            if(reg_mobile == '') {
                $('.error_reg_mobile').text('Mobile number is required');
                error++;   
            }
            if(reg_mobile != '' && reg_mobile.length != 10) {
                $('.error_reg_mobile').text('Mobile number should be 10 digit');
                error++;   
            }
            if(reg_email == '') {
                $('.error_reg_email').text('Email address is required');
                error++;  
            }
            if(reg_email != '' && (isEmail(reg_email) == false)) {
                $('.error_reg_email').text('Email address is invalid');
                error++;   
            }
            if(reg_location == '') {
                $('.error_reg_location').text('Location is required');
                error++;   
            }
            if(reg_city == '') {
                $('.error_reg_city').text('City is required');
                error++;   
            }
            if(reg_state == '') {
                $('.error_reg_state').text('State is required');
                error++;   
            }
            if(reg_country == '') {
                $('.error_reg_country').text('Country is required');
                error++;   
            }
            if(reg_pincode == '') {
                $('.error_reg_pincode').text('Pincode is required');
                error++;   
            }
            if(reg_password == '') {
                $('.error_reg_password').text('Password is required');
                error++;   
            }
            if(reg_confirm_password == '') {
                $('.error_reg_confirm_password').text('Confirm password is required');
                error++;   
            }
            if(reg_password != '' && reg_confirm_password != '' && (reg_confirm_password != reg_password)) {
                $('.error_reg_password').text('Password and confirm password mismatch');
                error++;   
            }
            if(error>0) {
                event.preventDefault();
            } else {
                $.ajax({
                    url : "<?php echo 'mail-process.php?act=register'; ?>",
                    dataType : 'JSON',
                    type : 'POST',
                    data : { name:reg_fullname, mobile:reg_mobile, email:reg_email,
                        location:reg_location, city:reg_city, state:reg_state,
                        country: reg_country, pincode: reg_pincode, password: reg_password
                    },
                    success : function(response) {
                        if(response != '') {
                            if(response.status) {
                                //alert(response.message);
                                $('.reg_success').text(response.message).css('display','block');
                                setTimeout(function() {
                                    location.reload();
                                },1800);
                            } else {
                                alert(response.message);
                            }
                        } else {
                            alert('Something went wrong. Please went wrong');
                        }
                    }
                });
            }
        });
    });

/*function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true; 
}*/
</script>