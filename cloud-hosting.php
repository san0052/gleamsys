<?php include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<body>
    <? include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <?php $banner = ItBanners('11'); ?>
        <div class="item">
            <?php if (!empty($banner['bannerImg'])) { ?>
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>" alt="<?php echo !empty($banner['altTag'])?$banner['altTag']:''; ?>">
            <!-- <img src="images/web-development.jpg"> -->
            <?php } ?>
            <div class="banner-text">
                <!-- cloud hosting -->
                <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 cm-tr-up">
                    <div class="cm-tr-pic mb-app">
                        <img src="images/cloud-side.png">
                    </div>
                    <ul class="mobile-app-accrdan web-design-accrdn">
                        <li>
                            <button class="accrdian-btn">Blazing-Fast Load Time
                            </button>
                            <ul class="accrdian-menu show">
                                <li>With top-of-the-line hardware, Varnish caching - which stores your site’s most used pages, and a globally distributed CDN, your site is served upto 2x faster.</li>
                            </ul>
                        </li>
                        <li>
                            <button class="accrdian-btn">Instant Scaling
                            </button>
                            <ul class="accrdian-menu hide">
                                <li>No need to move your hosting as your traffic grows. Ramp up your resources at the click of a button - instantly add RAM and CPU without a reboot.</li>
                            </ul>
                        </li>
                        <li>
                            <button class="accrdian-btn">Your Data - Safeguarded
                            </button>
                            <ul class="accrdian-menu hide">
                                <li>Our industry-leading Ceph-based storage system stores your website data across 3 distinct devices to ensure redundancy and safety.</li>
                            </ul>
                        </li>
                        <li>
                            <button class="accrdian-btn">Automatic Failover
                            </button>
                            <ul class="accrdian-menu hide">
                                <li>If we detect a hardware issue, we automatically move your site to another server, ensuring that your site is always up and you never lose traffic.</li>
                            </ul>
                        </li>
                        <li>
                            <button class="accrdian-btn">cPanel for Management
                            </button>
                            <ul class="accrdian-menu hide">
                                <li>Just like Shared Hosting - manage your website and associated services like Email and sub-domains with the simplicity and ease of cPanel.</li>
                            </ul>
                        </li>
                        <li>
                            <button class="accrdian-btn">Resource Management
                            </button>
                            <ul class="accrdian-menu show">
                                <li>An intuitive dashboard helps you keep an eye on the resources your website is using and its performance. You can ramp up whenever required.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container-fluid cm-tr-content-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 cm-tr-contents cloud-hosting-price">
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>PERSONAL CLOUD</h4>
                        <h3>INR 10000</h3>
                        <p>Per Month</p>
                        <ul class="why-us-content">
                            <p>Enjoy All The Features</p>
                            <li>2 CPU cores</li>
                            <li>Unlimited Disk Space</li>
                            <li>2 GB RAM</li>
                            <li>Unlimited Bandwidth</li>
                            <li>Host 1 Website</li>
                            <li>Unlimited Email Storage</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>BUSINESS CLOUD</h4>
                        <h3>INR 10000</h3>
                        <p>Per Month</p>
                        <ul class="why-us-content">
                            <p>Enjoy All The Features</p>
                            <li>2 CPU cores</li>
                            <li>Unlimited Disk Space</li>
                            <li>2 GB RAM</li>
                            <li>Unlimited Bandwidth</li>
                            <li>Host 1 Website</li>
                            <li>Unlimited Email Storage</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>PRO CLOUD</h4>
                        <h3>INR 10000</h3>
                        <p>Per Month</p>
                        <ul class="why-us-content">
                            <p>Enjoy All The Features</p>
                            <li>2 CPU cores</li>
                            <li>Unlimited Disk Space</li>
                            <li>2 GB RAM</li>
                            <li>Unlimited Bandwidth</li>
                            <li>Host 1 Website</li>
                            <li>Unlimited Email Storage</li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div> -->
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