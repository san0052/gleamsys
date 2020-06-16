<div class="container-fluid testimonial-wrap">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 heading">

                <h2>testimonials</h2>

                

            </div>

            <div class="col-xs-12 testimonial-content">

                <div class="col-xs-12 owl-carousel owl-theme loop">
                    <?php 
                    $sql =   "SELECT * FROM ".$cfg['DB_TESTIMONIAL']."
                    WHERE  
                    `status` ='A' ORDER BY `id` DESC";
                    $res    =   $mycms->sql_query($sql);
                    $num      =   $mycms->sql_numrows($res);
                    if($num >0){
                        while($row    =   $mycms->sql_fetchrow($res)){ ?>
                            <div class="item">
                                <div class="col-xs-12 quote-left"><i class="fas fa-quote-left"></i></div>

                                <div class="col-xs-12 arrow_box">

                                    <h4><?php echo $row['subject']?></h4>

                                </div>

                                <div class="col-xs-12 name">

                                    <p><?php echo $row['subjectBy']?></p>

                                </div>
                            </div>
                        <?php } }?>
                    </div>

                </div>

            </div>

        </div>

    </div>



    <script>

        $('.loop').owlCarousel({

            autoplay: true,

            autoplayTimeout: 3000,

            autoplayHoverPause: true,

            center: true,

            items: 2,

            nav: true,

            loop: true,

            margin: 30,

            responsive: {

                0: {

                    items: 1

                },

                600: {

                    items: 1,



                },

                1000: {

                    items: 3,



                }

            }

        });

    </script>