<?php 
    $sql =   "SELECT * FROM ".$cfg['DB_PRODUCT']."
                                        WHERE  
                                        `status` ='A' 
                                        AND `pd_featured` = 'A'  ORDER BY `pd_id` DESC LIMIT 4";
    $res        =   $mycms->sql_query($sql);
    $count      =   $mycms->sql_numrows($res);
    if ($count>0) {
    ?>
<div class="container-fluid fprd">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h2>feature products</h2>
            </div>

            <div class="col-xs-12 prd-listing-scrol">
                <div class="col-xs-12 owl-carousel owl-theme featureproduct">
                    <?php 
                        
                       while($row    =   $mycms->sql_fetchrow($res)){ 
                    ?>
                    <div class="item">
                        <div class="main-prd-box">
                            <div class="box_img">
                                <img has="postloader" src="image_bank/product_image/<?=$row['pd_image'];?>" alt="#">
                            </div>
                            <p class="product-name"><?php echo $row['pd_name']?></p>
                        </div>
                        <div class="price-box">
                            <div class="price-content">
                                <p class="price">
                                    <span class="main-price">
                                        $<?php echo $row['pd_price']?>
                                    </span>
                                    <span class="offer-price">
                                        $<?php echo $row['strike_price']?>
                                    </span>
                                </p>
                            </div>
                            <div class="prd-box-fot">
                                <div class="quentity-frm">
                                    <div class="check-delivery">
                                        <input type="number" min="1" max="10" value="1">
                                    </div>
                                </div>
                                <button>Add to Cart</button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    
                </div>
            </div>

            <div class="col-xs-12 btn-box">
                <button style="cursor: pointer;" onclick="showProducts('feature')">view all products</button>
            </div>
        </div>
    </div>
</div>
<script>


    $('.featureproduct').owlCarousel({

        items: 2,
        nav: true,
        loop: false,
        margin: 10,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1,
                margin: 0,
            },
            1000: {
                items: 4,

            },
            1600: {
                items: 5,

            }
        }
    });
</script>
<?php } ?>