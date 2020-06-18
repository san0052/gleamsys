<div class="container-fluid clients">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h2>our clients</h2>

            </div>
            <div class="col-xs-12 owl-carousel owl-theme client">
                <?php 
                    $sql    =   "SELECT * FROM ".$cfg['DB_CLIENT_INFO']."
                                WHERE  
                                `status` ='A' ";
                    $res      =   $mycms->sql_query($sql);
                    $num      =   $mycms->sql_numrows($res);
                    if($num >0){
                        while($row    =   $mycms->sql_fetchrow($res)){ ?>
                    <div class="item">
                        <div class="col-xs-12 team-image">
                            <img src="uploads/client_logo/<?php echo $row['projectLogo']?>" alt="<?php echo $row['altTag']?>">
                        </div>
                    </div>
                <?php } }?>
                
            </div>
            <div class="col-xs-12 btn-box">
                <button onclick="window.location.href='client.php'">view all clients</button>
            </div>
        </div>
    </div>
</div>



<script>
    $('.client').owlCarousel({
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
                items: 5
            }
        }
    })
</script>