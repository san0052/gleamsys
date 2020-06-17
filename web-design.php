<?php include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <?php include_once('includes/pagesources.php'); ?>
   <body>
      <? include_once('includes/header.php') ?>
      <div class="container-fluid slide_container">
        <?php $banner = ItBanners('6'); ?>
         <div class="item">
            <?php if (!empty($banner['bannerImg'])) { ?>
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>">
            <!-- <img src="images/web-design-banner.jpg"> -->
            <?php } ?>
            <div class="banner-text">
               <!-- WEB DESIGN -->
               <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 service-inner-up" style="border-bottom: 1px solid #0000004f;">
                  <div class="col-xs-12 about-content">
                     On the Internet, a business is competing against thousands of websites, all doing the same type of business. Your website has to stand out from this crowd.
                     <br><br>
                     You need a website that is intuitive, informative and efficient. That will generate positive results for your business.
                     <br><br>
                     Every websites we design, we give high priority to client conversion and traffic.
                     <br><br>
                     Anyone can design a website but very few can design websites that are able to rank high in the search engines and turn web visitors into customers.
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 cm-tr-up">
                  <div class="cm-tr-pic mb-app">
                     <img src="images/web-design-side.png">
                  </div>
                  <ul class="mobile-app-accrdan web-design-accrdn">
                     <li>
                        <button class="accrdian-btn">HOW WE DO IT?
                        </button>
                        <ul class="accrdian-menu show">
                           <li>We put ourselves in our customers - shoes from first blush to final finish. This allows us to design and build websites that integrate with your performance objectives and delivers results from day one.</li>
                        </ul>
                     </li>
                     <li>
                        <button class="accrdian-btn">Our Domain Expertise
                        </button>
                        <ul class="accrdian-menu hide">
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Web 2.0 based Designs</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Fast loading websites</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>All websites cross browser compatible</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>SEO Semantic and clean coding</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Professional, appealing and relevant websites</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>User friendly, Simple navigation</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Reasonable and Affordable pricing</li>
                        </ul>
                     </li>
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