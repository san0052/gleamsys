<? include_once("includes/function.php"); ?>
<!DOCTYPE html>
<html lang="en">
<? pagesource() ?>

<body>
    <? include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <div class="item">
            <img src="images/web-development.jpg">
            <div class="banner-text">
                Linux hosting
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 cm-tr-up">
                    <div class="cm-tr-pic mb-app">
                        <img src="images/linux-side.png">
                    </div>
                    <ul class="mobile-app-accrdan web-design-accrdn">
                        <li>
                            <button class="accrdian-btn">Our Servers
                            </button>
                            <ul class="accrdian-menu show">
                                <li>We take great pride in the hardware we use for our dedicated servers. We only use the latest and thoroughly tested Blade servers manufactured by SuperMicro.To take the greatest care of your data, all our servers come with two hard disks by default with RAID1 enabled. Making sure, even when one hard disk completely breaks down, your data is still intact and your server will remain online.</li>
                            </ul>
                        </li>
                        <li>
                            <button class="accrdian-btn">Our Platform
                            </button>
                            <ul class="accrdian-menu hide">
                                <li>We are committed to customer satisfaction and want to make sure that every programmer feels right at home. Keeping this in mind, we support PHP 5.2/5.3, Perl, Python and Ruby on Rails. Coming now to databases, We support an unlimited number of MySQL databases which will deliver several breakthrough capabilities that will enable your organization to scale database operations with confidence.</li>
                            </ul>
                        </li>
                        <li>
                            <button class="accrdian-btn">cPanel/WHM
                            </button>
                            <ul class="accrdian-menu hide">
                                <li>Customers can easily manage their shared account from a web browser thanks to our intuitive control panel. With cPanel & WHM, kickstarting your Hosting business has never been simpler! Whether you are managing one, or hundreds, of servers and/or websites, cPanel’s user-friendly interface allows you to customize your web hosting experience to fit your needs.</li>
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
                <div class="col-xs-12 cm-tr-contents linux-hosting-price">
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>ZENXSOFT ADVANCED DS1</h4>
                        <h3>INR 28,507.96</h3>
                        <p>Per Month</p>
                        <ul class="why-us-content">
                            <p>Enjoy All The Features</p>
                            <li>ntel E3-1220LV2</li>
                            <li>2.30 GHz Dual Core w/HT</li>
                            <li>4 GB RAM</li>
                            <li>1000 GB HDD in RAID 1</li>
                            <li>5 TB Bandwidth</li>
                            <li>2 Free IP(s)</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>ZENXSOFT ADVANCED DS2</h4>
                        <h3>INR 30,646.05</h3>
                        <p>Per Month</p>
                        <ul class="why-us-content">
                            <p>Enjoy All The Features</p>
                            <li>Intel E3-1265LV2</li>
                            <li>2.50 GHz Quad Core w/HT</li>
                            <li>4 GB RAM</li>
                            <li>1000 GB HDD in RAID 1</li>
                            <li>5 TB Bandwidth</li>
                            <li>2 Free IP(s)</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>ZENXSOFT ADVANCED DS3</h4>
                        <h3>INR 32,071.45</h3>
                        <p>Per Month</p>
                        <ul class="why-us-content">
                            <p>Enjoy All The Features</p>
                            <li>Intel E3-1265LV2</li>
                            <li>2.50 GHz Quad Core w/HT</li>
                            <li>8 GB RAM</li>
                            <li>1000 GB HDD in RAID 1</li>
                            <li>10 TB Bandwidth</li>
                            <li>2 Free IP(s)</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 it-sr-content-box">
                        <h4>ZENXSOFT ADVANCED DS4</h4>
                        <h3>INR 32,071.45</h3>
                        <p>Per Month</p>
                        <ul class="why-us-content">
                            <p>Enjoy All The Features</p>
                            <li>Intel E3-1265LV2</li>
                            <li>2.50 GHz Quad Core w/HT</li>
                            <li>8 GB RAM</li>
                            <li>1000 GB HDD in RAID 1</li>
                            <li>10 TB Bandwidth</li>
                            <li>2 Free IP(s)</li>
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