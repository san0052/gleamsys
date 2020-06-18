<?php
include_once("includes/links_frontend.php");
if (empty($_SESSION['gleam_users_session'])) { 
     $returnLink  =   $cfg['base_url'];
     $mycms->redirect($cfg['base_url']);
}else{
    $userId = $_SESSION['gleam_users_session']['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php'); ?>

<body class="online-store-inner">
    <?php include_once('includes/header.php'); ?>
    <div class="container-fluid profile-box">
        <div class="container">
            <div class="row">
            <?php include_once('includes/profile-left-menu.php'); ?>
            <?php 
                $sqlgetUser = "SELECT * FROM ".$cfg['DB_USERS']."  WHERE `status`='A' AND `id` = ".$userId."  ";
                $res    =   $mycms->sql_query($sqlgetUser);
                $row    =   $mycms->sql_fetchrow($res);

            ?>
                <div class="col-xs-12 col-md-9 prf-right-box">
                    <div class="prf-right-content">
                        <div class="applied-box">
                            <div id="detail-header" class="teacherlisting-about-text-left">
                                <h4>Personal Details</h4>
                                <h4>Edit Details</h4>
                            </div>
                            <div class="applied-items-box">
                                <div id="detailbox" class="applied-items">
                                    <div class="teacherlisting-class">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Full Name<span class="colon">:</span></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email Id<span class="colon">:</span></td>
                                                    <td style="text-transform: lowercase;">
                                                        <?php echo $row['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Number<span class="colon">:</span></td>
                                                    <td><?php echo $row['mobile']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>State<span class="colon">:</span></td>
                                                    <td><?php echo $row['state']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>City<span class="colon">:</span></td>
                                                    <td><?php echo $row['city']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Country<span class="colon">:</span></td>
                                                    <td><?php echo $row['country']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pincode<span class="colon">:</span></td>
                                                    <td><?php echo $row['pincode'] ;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Address<span class="colon">:</span></td>
                                                    <td><?php echo $row['location'] ;?></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="applied">
                                        <button class="hidden-xs hidden-sm" onclick="editopen()">Edit Details</button>
                                    </div>
                                    <div id="successMessage"></div>
                                </div>
                                <div id="editbox" class="applied-items edit-details" style="display:none;">
                                    <form enctype="multipart/form-data" method="post" onsubmit="return formValidator()" action="http://localhost/theteachershub/dev/student/model/student-model.php">
                                        <div class="teacherlisting-class">
                                            <input type="hidden" id="studentId" name="studentId" value="">
                                            <input type="hidden" id="act" name="act" value="studentProfileEdit">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td>Profile Image<span class="colon">:</span></td>
                                                    <td><input type="file"></td>
                                                </tr>
                                                    <tr>
                                                        <td>Full Name<span class="colon">:</span></td>
                                                        <td><input type="text" id="name" onkeypress="return /^[a-zA-Z ]*$/i.test(event.key)" style="text-transform: capitalize;" name="name" value="<?php echo $row['name']; ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email Id<span class="colon">:</span></td>
                                                        <td><input type="text" id="email" onkeypress="return /^[a-zA-Z0-9.@]*$/i.test(event.key)" name="email" value="<?php echo $row['email']; ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile Number<span class="colon">:</span></td>
                                                        <td><input type="text" id="mobile" name="mobile" maxlength="10" onkeypress="return /^[0-9]*$/i.test(event.key)" value="<?php echo $row['mobile'] ;?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>State<span class="colon">:</span></td>
                                                        <td>
                                                            <input type="text" id="state" name="state"  value="<?php echo $row['state'] ;?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>City<span class="colon">:</span></td>
                                                        <td><input type="text" id="city" name="city"  value="<?php echo $row['city']; ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pin Code<span class="colon">:</span></td>
                                                        <td>
                                                            <input type="text" id="pincode" name="pincode"  value="<?php echo $row['pincode']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address<span class="colon">:</span></td>
                                                        <td><input type="text" id="address" name="address" style="text-transform: capitalize;" value="<?php echo $row['location'] ;?>"></td>
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-12 col-md-12 form-group">
                                            <div id="errorRegister" style="float: right;"></div>
                                        </div>
                                        <div class="applied">
                                            <button type="submit" class="hidden-xs hidden-sm">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>
    <script>
        function editopen() {
            $("#detailbox").hide();
            $("#editbox").show();
            $("#detail-header h4:first-child").hide();
            $("#detail-header h4:last-child").show();
        }

        function closeedit() {
            $("#detailbox").show();
            $("#editbox").hide();
            $("#detail-header h4:first-child").show();
            $("#detail-header h4:last-child").hide();
        }

        function editclassopen() {
            $("#detailclassbox").hide();
            $("#editclassbox").show();
        }

        function closeclassedit() {
            $("#detailclassbox").show();
            $("#editclassbox").hide();
        }

        function getCity() {
            var stateId = $("#state").val();
            $.ajax({
                type: "POST",
                url: "http://localhost/theteachershub/dev/student/model/student-model.php?act=getCity&stateId=" + stateId,
                dataType: "html",
                async: false,
                success: function(res) {
                    console.log(res);
                    $("#city").html(res);
                    $("#pincode").html("");

                }

            })
        }

        function getPincode() {
            var cityId = $("#city").val();
            $.ajax({
                type: "POST",
                url: "http://localhost/theteachershub/dev/student/model/student-model.php?act=getPincode&cityId=" + cityId,
                dataType: "html",
                async: false,
                success: function(res) {
                    $("#pincode").html(res);
                }

            })
        }

        function formValidator() {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


            var name = $('#name').val().trim();
            var email = $('#email').val().trim();
            var mobile = $('#mobile').val().trim();
            var state = $('#state').val();
            var city = $('#city').val();
            var pincode = $('#pincode').val();
            var address = $('#address').val().trim();
            var classId = $('#class').val();

            if (name == '') {
                $('#errorRegister').html('Please enter name').css('color', 'red');
                $('#name').focus();
                return false;
            } else if (email == '') {
                $('#errorRegister').html('Please enter email id').css('color', 'red');
                $('#email').focus();
                return false;
            } else if (!regex.test(email)) {
                $('#errorRegister').html('Please enter valid email id').css('color', 'red');
                $('#email').focus();
                return false;
            } else if (mobile == '') {
                $('#errorRegister').html('Please enter mobile number').css('color', 'red');
                $('#mobile').focus();
                return false;
            } else if (mobile.length !== 10) {
                $('#errorRegister').html('Please enter 10 digits mobile number').css('color', 'red');
                $('#mobile').focus();
                return false;
            } else if (state == '' || state == null) {
                $('#errorRegister').html('Please select state').css('color', 'red');
                $('#state').focus();
                return false;
            } else if (city == '' || city == null) {
                $('#errorRegister').html('Please select city').css('color', 'red');
                $('#city').focus();
                return false;
            } else if (pincode == '') {
                $('#errorRegister').html('Please select pincode').css('color', 'red');
                $('#pincode').focus();
                return false;
            } else if (address == '') {
                $('#errorRegister').html('Please enter address').css('color', 'red');
                $('#address').focus();
                return false;
            } else if (classId == '' || classId == null) {
                $('#errorRegister').html('Please select class').css('color', 'red');
                $('#class').focus();
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>

</html>