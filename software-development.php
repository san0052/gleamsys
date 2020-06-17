<?php include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
   <?php include_once('includes/pagesources.php'); ?>

<body>
    <? include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <?php $banner = ItBanners('8'); ?>
        <div class="item">
           <?php if (!empty($banner['bannerImg'])) { ?>
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>" alt="<?php echo !empty($banner['altTag'])?$banner['altTag']:''; ?>">
             <!-- <img src="images/mb-app-banner.jpg"> -->
            <?php } ?>
            <div class="banner-text">
                <!-- software development -->
                <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 service-inner-up" style="border-bottom: 1px solid #0000004f;">
                    <div class="col-xs-12 about-content">
                        A huge number of software firms will offer you services related to product development and designing. What makes us different from the crowd?
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 cm-tr-up">
                        <div class="cm-tr-pic mb-app">
                            <img src="images/software-side.png">
                        </div>
                        <ul class="mobile-app-accrdan web-design-accrdn">
                            <li>
                                <button class="accrdian-btn">Let us look at some of the areas where we put in extra efforts:
                                </button>
                                <ul class="accrdian-menu show">
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span><b>Clear Communication:</b> to be able to understand clearly and accurately our clients - requirements and report about our position to let our clients know exactly where we are with regards to the project</li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span><b>Planning and Specifications:</b> this involves building prototypes from the data received from our clients, which are revised and re-revised till the design and architecture is perfect</li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span><b>Coding:</b> this will involve giving life to the prototype with easy to understand and clear coding suitable for modification and future development</li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span><b>Testing:</b> we drive the bugs away here as minutely as possible</li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span><b>Documentation and Help:</b> enough help and guidance is generated about using and implementing the product before it is finally handed over to our clients</li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span><b>JSP DevlopmentFuture Care:</b> we offer technical support and customer care along with our productsJavascript Devlopment</li>
                                    <li>Apart from the above mentioned points, there are a few other constraints that require to be looked into with care for the best results with the efficiency and returns expected from the product we deliver our clients with.</li>
                                </ul>
                            </li>
                            <li>
                                <button class="accrdian-btn">Development Constraints
                                </button>
                                <ul class="accrdian-menu hide">
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span>What will be the acceptable <b>deployment time?</b></li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span>What are the <b>technologies</b> that are most suitable for the present <b>platform?</b></li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span>Is the product completely targeted towards the required function?</li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span>How efficient is the product with regards to <b>resource requirements</b> and <b>processing time?</b></li>
                                    <li><span class="chk-tick"><i class="fa fa-check"></i></span>Is there any scope to reduce the costs associated without compromising the quality and efficiency and see <b>better andfaster ROI?</b></li>
                                </ul>
                            </li>
                        </ul>
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