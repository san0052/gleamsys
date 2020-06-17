<?php include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
   <?php include_once('includes/pagesources.php'); ?>
   <body>
      <? include_once('includes/header.php') ?>
      <div class="container-fluid slide_container">
         <?php $banner = ItBanners('7'); ?>
         <div class="item">
            <?php if (!empty($banner['bannerImg'])) { ?>
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>">
            <!-- <img src="images/web-development.jpg"> -->
            <?php } ?>
            <div class="banner-text">
               <!-- Web Development -->
               <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 service-inner-up" style="border-bottom: 1px solid #0000004f;">
                  <div class="col-xs-12 about-content">
                     Effective and visually appealing web development calls for thoughtful planning and innovative thinking. Our proficiency lies in our professional approach towards web development process.
                     <br><br>
                     Our technologies and processes will always help you stay ahead of your competitors. We treasure a vast pool of talented and experienced web designers and developers, who by virtue of their skills develop attractive websites that entice and delight the intended audience.
                     <br><br>
                     Conglomerating our sound domain experience, technical expertise and in-depth knowledge base of recent industry trends and business-centric delivery model we offer affordable end-to-end web solutions to our clients.
                     <br><br>
                     We assure you maximum return on investment with our breakthrough website development services.
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
                     <img src="images/web-development-side.png">
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
                        <button class="accrdian-btn">What we Guarantee?
                        </button>
                        <ul class="accrdian-menu hide">
                           <li>Suitable and elegant user interface in congruence with the customer's website design Appropriate security for data accessibility Scalable and robust web development solutions Performance optimization for the system load</li>
                        </ul>
                     </li>
                     <li>
                        <button class="accrdian-btn">Our Domain Expertise
                        </button>
                        <ul class="accrdian-menu hide">
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>PHP Devlopment</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>PHP Devlopment using MVC architecture</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Web Devlopment using Code Igniter</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Web Devlopment using Zend Framework</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Web Devlopment using Smarty</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>JSP Devlopment</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Javascript Devlopment</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>AJAX Devlopment</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>ASP.NET Devlopment</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>C# Devlopment</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Action Script Devlopment</li>
                           <li><span class="chk-tick"><i class="fa fa-check"></i></span>Mod Rewriting</li>
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