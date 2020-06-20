<?php
include_once("includes/links_frontend.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once('includes/pagesources.php'); ?>

<body style="background:#fafafa;">
    <div class="container-fluid chk-header">
        <div class="container">
            <div class="row">
                <div class="logo-item">
                    <img src="images/logo.png">
                </div>
                <div class="chk-head-rt">
                    <button onclick="window.location.href='index.php'">Back to Home</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid chk-body">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 checkout-items">
                    <ul class="chkout-accr">
                        <li>
                            <div>
                                <span class="checkout-option-number">1</span>
                            </div>
                            <div class="chk-inner-rt">
                                <button>LOGIN</button>
                                <ul id="chklogin" class="show">
                                <?php 
                                    $userId     = $_SESSION['gleam_users_session']['user_id'];
                                    if($userId){ 
                                        $sqlgetUser = "SELECT * FROM ".$cfg['DB_USERS']."  WHERE `status`='A' AND `id` = ".$userId."  ";
                                        $res        =   $mycms->sql_query($sqlgetUser);
                                        $row        =   $mycms->sql_fetchrow($res); ?>
                                
                                    <li class="address">
                                        <p><?php echo $row['name'];?></p><p class="chk-email"><?php echo $row['email'];?></p>
                                    </li>
                               <?php }else{ ?>
                                <li class="address">
                                        <p>Please Login / Register</p>
                                    </li>
                                <?php } ?>
                                <button class="change-btn" onclick="changelogin()">Change</button>
                                    <div class="edit-frm">
                                        <p>Change Login</p>
                                        <div>
                                            <div class="col-xs-6 form-group">
                                                <input type="email" placeholder="Email Id" class="login_email">
                                                <small class="login_error_email" style="color:red"></small>
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <input type="password" placeholder="password" class="login_password">
                                                <small class="login_error_password" style="color:red"></small>
                                            </div>
                                            <p>Do Not Have Account? <a onclick="window.location.href='index.php'" style="cursor: pointer;">Register Now</a></p>
                                            <div class="col-xs-12 form-group">
                                                <button class="save-btn" onclick="logindone()">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function changelogin() {
                                            $("#chklogin").addClass("edit");
                                        }

                                        function logindone() {
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
                                            }else{
                                                $.ajax({
                                                    url : "<?php echo 'mail-process.php?act=login'; ?>",
                                                    dataType : 'JSON',
                                                    type : 'POST',
                                                    data : { email : login_email, password : login_password },
                                                    success : function(response) {
                                                        if(response != '') {
                                                            if(response.status) {
                                                                location.reload();
                                                            } else {
                                                                alert(response.message);
                                                            }
                                                        } else {
                                                            alert('Something went wrong. Please went wrong');
                                                        }
                                                    }
                                                });
                                            }
                                            $("#chklogin").removeClass("edit");
                                        }
                                    </script>
                                </ul>
                            </div>
                        </li>

                        <li>
                        <div>
                            <span class="checkout-option-number">2</span>
                        </div>
                        <div class="chk-inner-rt">
                            <button>Delivery Address</button>
                                <ul id="edit-address" class="show">
                                <?php 
                                   if($row['email']){
                                    $sqlgetUser = "SELECT * FROM ".$cfg['DB_SHIPPING_ADDRESS']."  WHERE `status`='A' AND `email` = '".$row['email']."'  ";
                                    $res        =   $mycms->sql_query($sqlgetUser);
                                    $rows       =   $mycms->sql_fetchrow($res);
                                }else{
                                     $sqlgetUser = "SELECT * FROM ".$cfg['DB_SHIPPING_ADDRESS']."  WHERE `status`='A' AND `id` = '".$_GET['id']."'  ";
                                    $res        =   $mycms->sql_query($sqlgetUser);
                                    $rows       =   $mycms->sql_fetchrow($res);
                                }
                                if($userId && $rows['email']){ ?>
                                    <p style="color:#b8171d">Your Registered Shipping address</p>
                                    <li class="address">
                                        <p><?php echo ucfirst($rows['name']).','.$row['mobile'];?> </p>
                                        <p><?php echo $rows['location'].','.' '.$row['pincode']; ?></p>
                                        <p><?php echo $rows['city'].','.' '.$row['state']; ?></p>
                                        <p><?php echo $rows['country']; ?></p>
                                    </li>
                                <?php } else if($userId){ ?>
                                        <p><?php echo ucfirst($row['name']).','.$row['mobile'];?> </p>
                                        <p><?php echo $row['location'].','.' '.$row['pincode']; ?></p>
                                        <p><?php echo $row['city'].','.' '.$row['state']; ?></p>
                                        <p><?php echo $row['country']; ?></p>

                                   <?php }else if($_GET['id']){?>
                                        <p><?php echo ucfirst($rows['name']).','.$row['mobile'];?> </p>
                                        <p><?php echo $rows['location'].','.' '.$row['pincode']; ?></p>
                                        <p><?php echo $rows['city'].','.' '.$row['state']; ?></p>
                                        <p><?php echo $rows['country']; ?></p>
                                   <?php }else{?>
                                    <p>Please Add your shipping/delivery address</p>
                                  <?php } ?>
                                    <button class="change-btn" onclick="editaddress()">Edit</button>
                                    <div class="edit-frm">
                                        <p>Edit Address</p>
                                        <?php if($userId && $row['id']){ ?>
                                            <div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Full Name" name="name" id="fname" class="ship_fullname" value="<?php echo $rows['name']; ?>">
                                                     <small class="error_ship_fullname" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Mobile Number" name="mobile" id="mobNo" class="ship_mobile" value="<?php echo $rows['mobile']; ?>">
                                                    <small class="error_ship_mobile" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Email" name="email" id="email" class="ship_email" value="<?php echo $rows['email']; ?>">
                                                    <small class="error_ship_email" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Location" name="location" id="location"  class="ship_location" value="<?php echo $rows['location']; ?>">
                                                    <small class="error_ship_loaction" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="City" name="city" id="city" class="ship_city" value="<?php echo $rows['city']; ?>">
                                                    <small class="error_ship_city" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="State" name="state" id="state"  class="ship_state" value="<?php echo $rows['state']; ?>">
                                                    <small class="error_ship_state" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Country" name="country" class="ship_country" value="<?php echo $rows['state']; ?>">
                                                    <small class="error_ship_country" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Pin Code" name="pincode" id="pincode" class="ship_pincode" value="<?php echo $rows['pincode']; ?>">
                                                    <small class="error_ship_pincode" style="color:red"></small>
                                                </div>
                                                
                                                <div class="col-xs-12 form-group">
                                                    <button class="save-btn" onclick="updateAddress()">Save</button>
                                                </div>

                                            </div>
                                        <?php } else{ ?>
                                            <div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Full Name" name="name" id="f_name" class="ship_fullname" >
                                                     <small class="error_ship_fullname" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Mobile Number" name="mobile" id="mob_No" class="ship_mobile" >
                                                    <small class="error_ship_mobile" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Email" name="email" id="email_id" class="ship_email" onblur="getAlldata();">
                                                    <small class="error_ship_email" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Location" name="location" id="add_location"  class="ship_location" >
                                                    <small class="error_ship_loaction" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="City" name="city" id="add_city" class="ship_city" value="<?php echo $rows['city']; ?>">
                                                    <small class="error_ship_city" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="State" name="state" id="add_state"  class="ship_state" >
                                                    <small class="error_ship_state" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Country" name="add_country" class="ship_country" >
                                                    <small class="error_ship_country" style="color:red"></small>
                                                </div>
                                                <div class="col-xs-6 form-group">
                                                    <input type="text" placeholder="Pin Code" name="add_pincode" id="pincode" class="ship_pincode">
                                                    <small class="error_ship_pincode" style="color:red"></small>
                                                </div>
                                                
                                                <div class="col-xs-12 form-group">
                                                    <button class="save-btn" onclick="saveAddress()">Save</button>
                                                </div>

                                            </div>
                                        <?php }?>
                                    </div>
                                    <script>
                                        function editaddress() {
                                            $("#edit-address").addClass("edit");
                                        }

                                        function updateAddress() {
                                            
                                            let error = 0;
                                            $('.error_ship_fullname, .error_ship_mobile, .error_ship_email, .error_ship_location, .error_ship_city, .error_ship_state, .error_ship_country, .error_ship_pincode, .error_ship_password, .error_ship_confirm_password').text('');
                                            let ship_fullname            =   $('.ship_fullname').val().trim();
                                            let ship_mobile              =   $('.ship_mobile').val().trim();
                                            let ship_email               =   $('.ship_email').val().trim();
                                            let ship_location            =   $('.ship_location').val().trim();
                                            let ship_city                =   $('.ship_city').val().trim();
                                            let ship_state               =   $('.ship_state').val().trim();
                                            let ship_country             =   $('.ship_country').val();
                                            let ship_pincode             =   $('.ship_pincode').val().trim();
                                            

                                            if(ship_fullname == '') {
                                                $('.error_ship_fullname').text('Name is required');
                                                error++;   
                                            }
                                            if(ship_mobile == '') {
                                                $('.error_ship_mobile').text('Mobile number is required');
                                                error++;   
                                            }
                                            if(ship_mobile != '' && ship_mobile.length != 10) {
                                                $('.error_ship_mobile').text('Mobile number should be 10 digit');
                                                error++;   
                                            }
                                            if(ship_email == '') {
                                                $('.error_ship_email').text('Email address is required');
                                                error++;  
                                            }
                                            if(ship_email != '' && (isEmail(ship_email) == false)) {
                                                $('.error_ship_email').text('Email address is invalid');
                                                error++;   
                                            }
                                            if(ship_location == '') {
                                                $('.error_ship_location').text('Location is required');
                                                error++;   
                                            }
                                            if(ship_city == '') {
                                                $('.error_ship_city').text('City is required');
                                                error++;   
                                            }
                                            if(ship_state == '') {
                                                $('.error_ship_state').text('State is required');
                                                error++;   
                                            }
                                            if(ship_country == '') {
                                                $('.error_ship_country').text('Country is required');
                                                error++;   
                                            }
                                            if(ship_pincode == '') {
                                                $('.error_ship_pincode').text('Pincode is required');
                                                error++;   
                                            }
                                            
                                            
                                            if(error>0) {
                                                event.preventDefault();
                                            }else{
                                                $.ajax({
                                                    url : "<?php echo 'shipping-process.php?act=updateShipAddress'; ?>",
                                                    dataType : 'JSON',
                                                    type : 'POST',
                                                    data : { name:ship_fullname, mobile:ship_mobile, email:ship_email,
                                                        location:ship_location, city:ship_city, state:ship_state,
                                                        country: ship_country, pincode: ship_pincode
                                                    },
                                                    success : function(response) {
                                                        console.log(response);
                                                        if(response != '') {
                                                            if(response.status) {
                                                                alert(response.message);
                                                                /*setTimeout(function() {
                                                                    location.reload();
                                                                },1200);*/
                                                            } else {
                                                                alert(response.message);
                                                            }
                                                        } else {
                                                            alert('Something went wrong. Please went wrong');
                                                        }
                                                    }
                                                });
                                            }
                                            $("#edit-address").removeClass("edit");
                                        }

                                        function saveAddress() {
                                            
                                            let error = 0;
                                            $('.error_ship_fullname, .error_ship_mobile, .error_ship_email, .error_ship_location, .error_ship_city, .error_ship_state, .error_ship_country, .error_ship_pincode, .error_ship_password, .error_ship_confirm_password').text('');
                                            let ship_fullname            =   $('.ship_fullname').val().trim();
                                            let ship_mobile              =   $('.ship_mobile').val().trim();
                                            let ship_email               =   $('.ship_email').val().trim();
                                            let ship_location            =   $('.ship_location').val().trim();
                                            let ship_city                =   $('.ship_city').val().trim();
                                            let ship_state               =   $('.ship_state').val().trim();
                                            let ship_country             =   $('.ship_country').val();
                                            let ship_pincode             =   $('.ship_pincode').val().trim();
                                            

                                            if(ship_fullname == '') {
                                                $('.error_ship_fullname').text('Name is required');
                                                error++;   
                                            }
                                            if(ship_mobile == '') {
                                                $('.error_ship_mobile').text('Mobile number is required');
                                                error++;   
                                            }
                                            if(ship_mobile != '' && ship_mobile.length != 10) {
                                                $('.error_ship_mobile').text('Mobile number should be 10 digit');
                                                error++;   
                                            }
                                            if(ship_email == '') {
                                                $('.error_ship_email').text('Email address is required');
                                                error++;  
                                            }
                                            if(ship_email != '' && (isEmail(ship_email) == false)) {
                                                $('.error_ship_email').text('Email address is invalid');
                                                error++;   
                                            }
                                            if(ship_location == '') {
                                                $('.error_ship_location').text('Location is required');
                                                error++;   
                                            }
                                            if(ship_city == '') {
                                                $('.error_ship_city').text('City is required');
                                                error++;   
                                            }
                                            if(ship_state == '') {
                                                $('.error_ship_state').text('State is required');
                                                error++;   
                                            }
                                            if(ship_country == '') {
                                                $('.error_ship_country').text('Country is required');
                                                error++;   
                                            }
                                            if(ship_pincode == '') {
                                                $('.error_ship_pincode').text('Pincode is required');
                                                error++;   
                                            }
                                            
                                            
                                            if(error>0) {
                                                event.preventDefault();
                                            }else{
                                                 $.ajax({
                                                    url : "<?php echo 'shipping-process.php?act=updateAddress'; ?>",
                                                    dataType : 'JSON',
                                                    type : 'POST',
                                                    data : { name:ship_fullname, mobile:ship_mobile, email:ship_email,
                                                        location:ship_location, city:ship_city, state:ship_state,
                                                        country: ship_country, pincode: ship_pincode
                                                    },
                                                    success : function(response) {
                                                        console.log(response);
                                                        if(response != '') {
                                                            if(response.status) {
                                                                alert(response.message);
                                                                setTimeout(function() {
                                                                    location.reload();
                                                                },1200);
                                                            } else if(response.status =='success'){
                                                                window.location.reload='checkout.php?id='+data_id;
                                                            }
                                                        } else {
                                                            alert('Something went wrong. Please went wrong');
                                                        }
                                                    }
                                                });
                                            }
                                            //$("#edit-address").removeClass("edit");
                                        }

                                        function getAlldata() {
            
                                            let error = 0;
                                            $('.error_ship_email').text('');
                                           
                                            let ship_email               =   $('.ship_email').val().trim();
                                            
                                            if(ship_email == '') {
                                                $('.error_ship_email').text('Email address is required');
                                                error++;  
                                            }
                                            if(error>0) {
                                                event.preventDefault();
                                            }else{
                                                 $.ajax({
                                                    url : "<?php echo 'shipping-process.php?act=fetchAddress'; ?>",
                                                    dataType : 'JSON',
                                                    type : 'POST',
                                                    data : { email:ship_email },
                                                    success : function(response) {
                                                        console.log(response);
                                                        event.preventDefault();
                                                        if(response != '') {
                                                            if(response.status) {
                                                                if (response.user_exist == 1) {
                                                                    putData(response.details);
                                                                }
                                                            }
                                                        } 
                                                    }
                                                });
                                                event.preventDefault();
                                            }
                                            //$("#edit-address").removeClass("edit");
                                        }

                                        function putData(data){
                                            console.log(data);
                                            $('.ship_fullname').val(data.name);
                                            $('.ship_mobile').val(data.mobile);
                                            $('.ship_email').val(data.email);
                                            $('.ship_location').val(data.location);
                                            $('.ship_city').val(data.city);
                                            $('.ship_state').val(data.state);
                                            $('.ship_country').val(data.country);
                                            $('.ship_pincode').val(data.pincode);
                                        }
                                    </script>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span class="checkout-option-number">3</span>
                            </div>
                            <div class="chk-inner-rt">
                                <button>Order Summery</button>
                                <ul class="order-summery show">
                                    <li>
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
                                            
                                        </div>
                                    </li>
                                    <li>
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
                                                <button class="rmv-btn ">Remove</button>
                                            </div>
                                            
                                        </div>
                                    </li>
                                    
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-4 total-checkout-items">
                    <table class="table totalpayble">
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
                    </table>
                    <button class="change-btn payment-procc">Procced to Payment</button>
                </div>
            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>
</body>

</html>