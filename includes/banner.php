<div class="container-fluid slide_container">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">





      <!-- Wrapper for slides -->

      <div class="carousel-inner">

        <?php 
            $sql =   "SELECT * FROM ".$cfg['DB_HOME_BANNER']."
                                     WHERE  
                                    `status` ='A' 
                                    ORDER BY `id` DESC";
            $res    =   $mycms->sql_query($sql);
            $counter =0;
            while($row    =   $mycms->sql_fetchrow($res)) { ?>   
            <?php if ($counter == 0) { ?>
              <div class="item active">
             <?php } else { ?>
              <div class="item">
             <?php } ?>
            
              <img src="uploads/banner_img/<?php echo $row['bannerImg']; ?>">
              <div class="banner-text">
                <?php echo $row['bannerTitle'];?>
                <!-- Buy Online<br>Buy Quality Computer -->

                <div>
                <!-- <button class="banner-btn"><?php //echo $row['bannerButton'];?></button> -->
                </div>
    					</div>
            </div>
      <?php $counter++ ;} ?>

    </div>
      <!-- Left and right controls -->

      <a class="left carousel-control" href="#myCarousel" data-slide="prev">

      <i class="fas fa-angle-left"></i>

      </a>

      <a class="right carousel-control" href="#myCarousel" data-slide="next">

      <i class="fas fa-angle-right"></i>

      </a>

    </div>

  </div>