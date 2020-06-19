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
                                    <li class="address">
                                        <p>Swarnnedu Ghosh</p><p class="chk-email">Swarnendu@abc.com</p></li>
                                    <button class="change-btn" onclick="changelogin()">Change</button>
                                    <div class="edit-frm">
                                        <p>Change Login</p>
                                        <div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="email" placeholder="Email Id">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="password" placeholder="password">
                                            </div>
                                            <p>Do Not Have Account? <a onclick="window.location.href='index.php'">Register Now</a></p>
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
                                    <li class="address">
                                        <p>Swarnnedu Ghosh, 9874563210</p>
                                        <p>address</p>
                                    </li>
                                    <button class="change-btn" onclick="editaddress()">Edit</button>
                                    <div class="edit-frm">
                                        <p>Edit Address</p>
                                        <div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="Full Name">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="Mobile Number">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="Location">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="City">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="State">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="Country">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="Pin Code">
                                            </div>
                                            <div class="col-xs-6 form-group">
                                                <!-- <label>Full Name</label> -->
                                                <input type="text" placeholder="Landmark">
                                            </div>
                                            <div class="col-xs-12 form-group">
                                                <button class="save-btn" onclick="saveaddress()">Save</button>
                                            </div>

                                        </div>
                                    </div>
                                    <script>
                                        function editaddress() {
                                            $("#edit-address").addClass("edit");
                                        }

                                        function saveaddress() {
                                            $("#edit-address").removeClass("edit");
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