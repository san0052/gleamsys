<?php include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
   <?php include_once('includes/pagesources.php'); ?>
   <body>
      <? include_once('includes/header.php') ?>
      <div class="container-fluid slide_container">
         <?php $banner = ItBanners('12'); ?>
         <div class="item">
            <?php if (!empty($banner['bannerImg'])) { ?>
            <!-- <img src="images/web-development.jpg"> -->
            <img src="<?php echo 'images/'.$banner['bannerImg'];?>">
            <?php } ?>
            <div class="banner-text">
               <!-- SSL certificate -->
               <?php echo !empty($banner['BannerTitle'])?strtoupper($banner['BannerTitle']):''; ?>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 cm-tr-up">
                  <div class="cm-tr-pic mb-app">
                     <img src="images/ssl-side.png">
                  </div>
                  <ul class="mobile-app-accrdan web-design-accrdn">
                     <li>
                        <button class="accrdian-btn">Rock-solid security
                        </button>
                        <ul class="accrdian-menu show">
                           <li>Comodo's SSL certificates provide upto 128 or 256-bit encryption for maximum security of your website visitors' data</li>
                        </ul>
                     </li>
                     <li>
                        <button class="accrdian-btn">Boost customer confidence
                        </button>
                        <ul class="accrdian-menu hide">
                           <li>Many customers actively look for the SSL lock icon before handing over sensitive data. Get an SSL certificate to increase your customer's trust in your online business.</li>
                        </ul>
                     </li>
                     <li>
                        <button class="accrdian-btn">Better SEO rankings
                        </button>
                        <ul class="accrdian-menu hide">
                           <li>Google gives higher rankings to websites secured with SSL certificates. Which means SSL certificates are critical if you're serious about your online business.</li>
                        </ul>
                     </li>
                     <li>
                        <button class="accrdian-btn">Comodo Secure Seal
                        </button>
                        <ul class="accrdian-menu hide">
                           <li>Your certificate comes with a Comodo Secure Seal that serves as a constant reminder to customers that your site is protected</li>
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
         
                 <div class="col-xs-12 cm-tr-contents ssl-price">
         
                     <div class="col-xs-12 it-sr-content-box">
         
                         <h4>POSITIVE SSL</h4>
         
                         <h3>INR 5000</h3>
         
                         <p>Per Year</p>
         
                         <ul class="why-us-content">
         
                             <li>Domain-validation</li>
         
                             <li>1 domain</li>
         
                             <li>Issued within 2 days</li>
         
                         </ul>
         
                     </div>
         
                     <div class="col-xs-12 it-sr-content-box">
         
                         <h4>COMODO SSL</h4>
         
                         <h3>INR 10000</h3>
         
                         <p>Per Year</p>
         
                         <ul class="why-us-content">
         
                             <li>Domain-validation</li>
         
                             <li>1 domain</li>
         
                             <li>Issued within 2 days</li>
         
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