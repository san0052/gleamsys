<?
include_once("includes/function.php");
?>
<!DOCTYPE html>
<html lang="en">

<? pagesource() ?>

<body>
    <? include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <div class="item">
            <img src="images/contact-us-banner.png">
            <div class="banner-text">
                Contact Us<br>
            </div>
        </div>
    </div>

    <div class="container-fluied testimonial-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 heading">
                    <h2>Contact Information</h2>
                </div>
                <div class="col-xs-12 testimonial-content contact-details">
                    <div class="item">
                        <div class="col-xs-12 quote-left"><i class="fas fa-map-marker"></i></div>
                        <div class="col-xs-12 arrow_box">
                            <h4>Suit 209, 86 Murray Street, Hobart, Tasmania 7000, Australia</h4>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-xs-12 quote-left"><i class="fas fa-map-marker"></i></div>
                        <div class="col-xs-12 arrow_box">
                            <h4>Level 17, 570 Bourke Street, Melbourne, Victoria 3000, Australia</h4>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-xs-12 quote-left"><i class="fas fa-map-marker"></i></div>
                        <div class="col-xs-12 arrow_box">
                            <h4>Suite 5-7, 187 Brisbane Street, Launceston, Tasmania 7000, Australia</h4>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-xs-12 quote-left"><i style="transform: rotate(90deg)" class="fas fa-phone"></i></div>
                        <div class="col-xs-12 arrow_box">
                            <h4>+61 435 074 100</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="padding: 0">
        <div class="container">
            <div class="row">
                <div class="contact-map">


                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2923.5169241037233!2d147.32408371525779!3d-42.883039348404125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xaa6e751fef321173%3A0xe629349a5a80275e!2sGleamsys!5e0!3m2!1sen!2sin!4v1591444220363!5m2!1sen!2sin" width="100%" height="534.15" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                    <div class="col-xs-12 requer-form-box">
                        <div class="col-xs-12 heading">
                            <h2>Quick Quote</h2>
                        </div>
                        <form>
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
                                <textarea placeholder="Requerments"></textarea>
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
    <? include_once('includes/footer.php') ?>
</body>



</html>