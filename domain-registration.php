<?php include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<body>
    <? include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <?php $banner = ItBanners('16'); ?>
        <div class="item">
            <?php if (!empty($banner['bannerImg'])) { ?>
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>" alt="<?php echo !empty($banner['altTag'])?$banner['altTag']:''; ?>">
            <!-- <img src="images/web-development.jpg"> -->
            <?php } ?>
            <div class="banner-text">
            <!-- DOMAIN REGISTRATION -->
            <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
        </div>
    </div>
    <!-- <div class="container-fluid cm-tr-content-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 cm-tr-contents domain-price">
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>.com / .net / .org</h4>
                        <h3>INR 950</h3>
                        <p>Per Year</p>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>.info / .biz /.us/.name</h4>
                        <h3>INR 950</h3>
                        <p>Per Year</p>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>.in</h4>
                        <h3>INR 950</h3>
                        <p>Per Year</p>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>.co.in/ .net.in / .org.in / .gen.in / .firm.in/ .ind.in</h4>
                        <h3>INR 950</h3>
                        <p>Per Year</p>
                    </div>
                </div>

            </div>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 service-inner-up" style="border-bottom: 1px solid #0000004f;">
                    <div class="col-xs-12 heading">
                        <h2>Domain Names</h2>
                    </div>
                    <div class="col-xs-12 about-content">
                        Booking a domain name involves a lot – your brand name, SEO, marketing and promotions, popularity, and much more. Get the most reliable services from Gleamsys with regards to choosing a domain name for your business.
                        <br><br>Coming up with an inefficient domain name for your business site may
                        render it completely useless. Consider the following points with regards to
                        selecting an effective domain name:<br><br>
                    </div>
                    <ul class="why-us-content">
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Make sure your domain name is catchy and easy to spell</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Your domain name should be completely relevant for your business</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Pay careful attention to the TLDs based on your targeted customer base</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Try domain names with keywords to help you with SEO</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Don’t get into copyright issues!</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 service-inner-up" style="border-bottom: 1px solid #0000004f;">
                    <div class="col-xs-12 heading">
                        <h2>Our Domain Name Services</h2>
                    </div>
                    <div class="col-xs-12 about-content">
                        Dealing with Zenxsoft lets you see a number of benefits where domain names are concerned. If you are not sure about the right domain name to go for, let us know your business details, and we will actually suggest a number of domain names that can be perfect.
                        <br><br>
                        If you already have some ideas on the domain names, check out their availability on this page, and book the most relevant example according to your requirements.
                        <br><br>
                        There are a number of other options for you to check out with our domain name services as well. Consider:<br><br>
                    </div>
                    <ul class="why-us-content">
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Bulk purchase prices</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Domain auction help</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Offers / Sales on Domains</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Domain transfers</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Reliable services with extensions</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Immediate activation</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 service-inner-up">
                    <div class="col-xs-12 about-content">
                    Get in touch with our sales team today, and we will show you a whole new aspect of getting the most effective domain names for your business site!<br><br>
                    </div>
                    <ul class="why-us-content">
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>SEO and Domain Names</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Tips on selecting the right Domain Names</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Parked domain Businesses</li>
                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Auctions and latest news.</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <? include_once('includes/footer.php') ?>
</body>
<script>
    $(".accrdian-btn").click(function(event) {
        event.stopPropagation();
        var clicked = this;
        var parent_li = $(clicked).parent("li");
        var child_ul = parent_li.find(".accrdian-menu");
        console.log(child_ul);
        if (child_ul.hasClass("hide")) {
            child_ul.removeClass("hide").addClass("show");
            $(".accrdian-btn").each(function() {
                var next_li = this;
                if (next_li != clicked) {
                    var parent_li_other = $(next_li).parent("li");
                    var child_ul_other = parent_li_other.find("ul");
                    child_ul_other.removeClass("show").addClass("hide");
                }
            });
        } else if ((child_ul.hasClass("show"))) {
            child_ul.removeClass("show").addClass("hide");

        }
    })
</script>

</html>