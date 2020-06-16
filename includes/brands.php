<div class="container-fluid">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 member-content">

                <div class="col-xs-12 owl-carousel owl-theme serve">

                    <?php 
                        $sql =   "SELECT * FROM ".$cfg['DB_BRAND_LOGO']."
                                                 WHERE  
                                                `status` ='A' ";
                        $res      =   $mycms->sql_query($sql);
                        $num      =   $mycms->sql_numrows($res);
                        if($num){
                            while($row    =   $mycms->sql_fetchrow($res)){ ?>
                    
                        <div class="item">

                            <div class="col-xs-12 team-image">

                                <img src="uploads/brand_logo/<?php echo $row['BrandLogoImage'] ;?>" alt="<?php echo $row['altTag']?>">

                            </div>

                        </div>
                <?php } } ?>

                        

                </div>

            </div>

        </div>

    </div>

</div>

 





<script>

    $('.serve').owlCarousel({

        autoplay: true,

        autoplayTimeout: 3000,

        autoplayHoverPause: true,

        loop: true,

        margin: 20,

        

        responsive: {

            0: {

                items: 2

            },

            600: {

                items: 3

            },

            1000: {

                items:7

            }

        }

    })

</script>