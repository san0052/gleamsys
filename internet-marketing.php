<?php include_once("includes/links_frontend.php"); ?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php'); ?>
<body>

    <? include_once('includes/header.php') ?>

    <div class="container-fluid slide_container">
        <?php $banner = ItBanners('10'); ?>
        <div class="item">
            <?php if (!empty($banner['bannerImg'])) { ?>
            <!-- <img src="images/web-design-banner.jpg"> -->
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>">
            <?php } ?>
            <div class="banner-text">
                <!-- INTERNET MARKETING (SEO, SEM) -->
                <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 service-inner-up" style="border-bottom: 1px solid #0000004f;">

                    <div class="col-xs-12 about-content">

                        Without the right promotional campaigns in place it becomes very hard for any business to flourish and see good sales. And it yet it may prove to be quite expensive to see effective advertising towards promoting your business, unless of course you decide to deal with internet marketing.

                        <br><br>In fact internet marketing offers a number of advantages towards promoting your business successfully.<br><br>

                    </div>

                    <ul class="why-us-content">

                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Internet marketing is pretty cheap</li>

                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Forget about your printing, publishing and postage costs</li>

                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Internet marketing generally shows quicker results</li>

                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>There are a huge number of free tools available over the internet to help promote your business online</li>

                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>Online promotions cover a much wider consumer base than offline marketing techniques</li>

                        <li><span class="chk-tick"><i class="fa fa-check"></i></span>The ROI is seen to be much higher in case of internet marketing</li>

                    </ul>



                </div>

            </div>

        </div>

    </div>

    <div class="container-fluid">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 service-inner-up">

                    <div class="col-xs-12 heading">

                        <h2>Our Offer</h2>

                    </div>

                    <div class="col-xs-12 about-content">

                        Definitely you would want to pay more attention towards your business management and production than study the new techniques involved with any internet marketing campaign. This is why we have some great plans for your business to show you a wider market and a better brand recognition quite quickly.

                        <br><br>

                        In fact, when you deal with us,<br><br>

                        <ul class="why-us-content">

                            <li><span class="chk-tick">1.</span>You get the knowledge of some of the most experienced internet marketers to help your business</li>

                            <li><span class="chk-tick">2.</span>Your business gets the benefits of a huge resource base through working with us</li>

                            <li><span class="chk-tick">3.</span>We constantly keep you updated about our progress</li>

                            <li><span class="chk-tick">4.</span>You can approach us for a wide number of web development services that often form an important part of internet marketing</li>

                            <li><span class="chk-tick">5.</span>We can even offer you tailor-made plans to suit your business's requirements particularly</li>

                        </ul>

                        <br><br>

                        On top of these features, get to work with a very friendly technical support and customer care team who will be at your service when you need them. And being a company based in India, our internet marketing services are very cost effective without comprising in the least on the quality.

                        <br><br>

                        So why miss out on such great offers? Get in touch with us today and learn all you need to know about how we can offer your business with the best internet marketing services to show you success!<br><br>

                    </div>

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