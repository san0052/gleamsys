<div class="col-xs-12 side-modal-box" id="side-modal">
    <div class="col-xs-12 side-modal-main-box">
        <div class="login-box" id="login">
            <div class="book-header">
                <p>LOGIN</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <form class="book-content">
                <div class="book-content-inner">
                    <div class="col-xs-12 form-group">
                        <!-- <label>Full Name</label> -->
                        <input type="text" placeholder="Email Id">
                    </div>
                    <div class="col-xs-12 form-group">
                        <!-- <label>Full Name</label> -->
                        <input type="password" placeholder="Password">
                    </div>
                    <div class="col-xs-12 form-group pl pr">
                        <div class="col-xs-12 rc">
                            <label>Remember Me
                                <div>
                                    <input type="checkbox" name="loginType" value="student">
                                    <span class="checkmark"></span>
                                </div>

                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 form-group">
                        <a onclick="forgetpass()" style="cursor:pointer;">Forget Password</a>
                    </div>
                    <div class="col-xs-12 form-group forget-password-item" dep="forget-password">
                        <!-- <label>Full Name</label> -->
                        <input type="text" placeholder="Email Id">
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
                        <a onclick="openregi()">Register Now</a>
                    </div>
                    <div style="float:right;">
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="demo-class">LOGIN</button>
                    </div>
                </div>
                
            </form>
        </div>
        <div class="regi-box" id="regi">
            <div class="book-header">
                <p>REGISTRATION</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <form class="book-content">
                <div class="book-content-inner">
               
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Full Name">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Mobile Number">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Email Id">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Location">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="City">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="State">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Country">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Pin Code">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="password" placeholder="Password">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="password" placeholder="Confirm Password">
                        </div>
                    
                </div>
                <div class="book-footer">
                    <div class="total">

                        <p class="prd-price">Already have Account?</p>
                        <a onclick="openlogin()">Login Now</a>
                    </div>
                    <div style="float:right;">
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="demo-class">REGISTER</button>
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

                            alert('Email Send successfully');
                            window.location.href="computer-training.php";
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