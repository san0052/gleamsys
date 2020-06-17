<?php include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
   <?php include_once('includes/pagesources.php'); ?>
   <body>
      <? include_once('includes/header.php') ?>
      <div class="container-fluid slide_container">
         <?php $banner = ItBanners('15'); ?>
         <div class="item">
            <?php if (!empty($banner['bannerImg'])) { ?>
            <!-- <img src="images/mb-app-banner.jpg"> -->
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>">
            <?php } ?>
            <div class="banner-text">
               <!-- GPS & LOCATION BASED MOBILE APP DEVELOPMENT -->
               <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 service-inner-up" style="border-bottom: 1px solid #0000004f;">
                  <div class="col-xs-12 about-content">
                     We develop Customized GPS and Location Mobile Applications that based on the unique needs of your businesses. The Location based apps gives a competitive advantage to your business by tracking locations and implement various analytics. The Location based mobile app development is increasingly being adopted by small and medium businesses to track their various employees or products and packages. We offer end-to-end Android, Hybrid, IOS Mobile application development service across Android platform. We conform to the highest technical standards and emphasize on the GUI, usability and functionality of the Applications which are stable and customizable.
                     <br><br>
                     Our extensive technical knowledge and experience gets reflected in the apps we have developed.
                     <br><br>
                     If you are looking to develop a robust GPS mobile app for your business, then you can depend on us.
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
                     <img src="images/mb-app.png">
                  </div>
                  <ul class="mobile-app-accrdan">
                     <li>
                        <button class="accrdian-btn">Through our constant research we have understood the most important factors responsible for showing you success with your business's mobile platform are:
                        </button>
                        <ul class="accrdian-menu show">
                           <li><span class="chk-tick"><i class="fa fa-street-view" aria-hidden="true"></i></span>Less resource requirements</li>
                           <li><span class="chk-tick"><i class="fa fa-wrench" aria-hidden="true"></i></span>Stability</li>
                           <li><span class="chk-tick"><i class="fa fa-lock" aria-hidden="true"></i></span>Security</li>
                           <li><span class="chk-tick"><i class="fa fa-users" aria-hidden="true"></i></span>User friendliness</li>
                           <li><span class="chk-tick"><i class="fa fa-fighter-jet" aria-hidden="true"></i></span>Quick and efficient applications</li>
                        </ul>
                     </li>
                     <li>
                        <button class="accrdian-btn">As a mobile web development team, we offer a range of services, including
                        </button>
                        <ul class="accrdian-menu hide">
                           <li><span class="chk-tick"><i class="fab fa-windows" aria-hidden="true"></i></span>Hybrid applications development</li>
                           <li><span class="chk-tick"><i class="fab fa-apple" aria-hidden="true"></i></span>IPhone and IPad applications development</li>
                           <li><span class="chk-tick"><i class="fab fa-android" aria-hidden="true"></i></span>Android applications development</li>
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