<?php
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<body>

    <? include_once('includes/header.php') ?>

    <div class="container-fluid slide_container">
        <?php 
            $sql =   "SELECT * FROM ".$cfg['DB_CONTACT_US']."
                                     WHERE  
                                    `status` ='A' ORDER BY `id` DESC";
            $res        =   $mycms->sql_query($sql);
            $row        =   $mycms->sql_fetchrow($res);
            $address    =   $row['address'];
        ?>

        <div class="item">

            <img src="images/<?php echo $row['image']?>" alt="<?php echo $row['imgAlt'];?>">

            <div class="banner-text">

                <?php echo $row['heading']?><br>

            </div>

        </div>

    </div>



    <div class="container-fluid" style="padding: 0">

        <div class="container">

            <div class="row">

                <div class="contact-map">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2923.5169241037233!2d147.32408371525779!3d-42.883039348404125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xaa6e751fef321173%3A0xe629349a5a80275e!2sGleamsys!5e0!3m2!1sen!2sin!4v1591444220363!5m2!1sen!2sin" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> 

                <!--  <iframe width="100%" height="534.15" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" src="https://maps.google.it/maps?q=<?php //echo str_replace(" ", "+", $address); ?>&output=embed"></iframe>  -->



                    <div class="col-xs-12 requer-form-box">

                        <div class="col-xs-12 heading">

                            <h2>Quick Quote</h2>
                              <?php
                            if($_REQUEST['m']=='1')
                            {
                            ?>
                            <!-- <p style="font-size: 16px;text-align: center;margin-bottom: 35px;box-shadow: 0 0 15px #00000033;padding: 10px;color: #207da4;">We have received your query, will get back to you soon.</p> -->
                            <script type="text/javascript">
                             swal({
                                title: "Query submitted successfully",
                                text: "We have received your query, will get back to you soon.",
                                icon: "success",
                                button: true,
                              })
                             .then((yes) => {
                                 window.location='contact.php';
                             });

                          </script>
                            <?php } ?>

                        </div>
                      
                         
                        <form method="post" action="mail-process.php" onsubmit="return validate();">
                            <input type="hidden" name="act" value="Contact"/>

                            <div class="col-xs-12 form-group">

                                <!-- <label>Full Name</label> -->

                                <input type="text" placeholder="Full Name" id="name" name="name">

                            </div>

                             <div class="col-xs-12 form-group">

                                <!-- <label>Full Name</label> -->

                                <input type="text" placeholder="Email" name="email" id="email">

                            </div>

                            <div class="col-xs-12 form-group">

                                <!-- <label>Full Name</label> -->

                                <input type="text" placeholder="Mobile Number" name="mobileno" id="mobileno">

                            </div>

                            <div class="col-xs-12 form-group">

                                <!-- <label>Full Name</label> -->

                                <textarea placeholder="Requerments" id="message" name="mess"></textarea>

                            </div>

                            <div class="col-xs-12 form-group">

                                <button type="submit">submit</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function validate()
        {
            if($('#name').val()=='')
            {
                alert('Please enter your name');
                $('#name').focus();
                return false;
            }
            if($('#email').val()=='')
            {
                alert('Please enter your email address');
                $('#email').focus();
                return false;
            }
            if($('#mobileno').val()=='')
            {
                alert('Please enter your mobile number');
                $('#mobileno').focus();
                return false;
            }
            if($('#mess').val()=='')
            {
                alert('Please enter your query');
                $('#message').focus();
                return false;
            }
        }
    </script>


    <? include_once('includes/footer.php') ?>

</body>







</html>