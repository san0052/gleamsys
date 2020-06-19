<?php
include_once("includes/links_frontend.php"); ?>

<!DOCTYPE html>
<html lang="en">

<?php include_once('includes/pagesources.php');?>

<body>
    <?php include_once('includes/header.php') ?>
    <div class="container-fluid product-main-box">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-5 left-section product-item-details">

                    <div class="col-xs-12 col-md-10 box_img">
                        <div id="London" class="tabcontent" style="display: none;">
                            <img src="images/prd-1.png">
                        </div>

                        <div id="Paris" class="tabcontent" style="display: block;">
                            <img src="images/prd-2.png">
                        </div>

                        <div id="Tokyo" class="tabcontent" style="display: none;">
                            <img src="images/prd-3.png">
                        </div>
                    </div>
                    <ul class="col-xs-12 col-md-2 detailtab">
                        <li class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen" style="height: 50.0781px;">
                            <img src="images/prd-1.png">
                        </li>
                        <li class="tablinks active" onclick="openCity(event, 'Paris')" style="height: 50.0781px;">
                            <img src="images/prd-2.png">
                        </li>
                        <li class="tablinks" onclick="openCity(event, 'Tokyo')" style="height: 50.0781px;">
                            <img src="images/prd-3.png">
                        </li>

                    </ul>
                </div>
                <div class="col-xs-12 col-md-7 right-section item-details ">
                    <p class="prd-name">Creative Teaching Press</p>
                    <p class="prd-id">product id</p>
                    <p class="include-tax">Quentity</p>
                   
                        <div class="check-delivery">
                        <input type="number" min="1" max="10" value="1">
                        </div>
                    
                    <hr>
                    <p class="prd-price">
                        Price:
                        <span>
                            <i class="fas fa-rupee-sign"></i>
                        </span>699
                    <span class="offer-price">
                        MRP:
                        <span>
                            <i class="fas fa-rupee-sign"></i>
                        </span>
                        899
                    </span>
                    <span class="saved-price">
                        ( Save: <span><i class="fas fa-rupee-sign"></i>
                        </span>
                        200 )
                    </span>
                    </p>
                    
                    <p class="include-tax">Inclusive of all taxes</p>
                    <p></p>
                    <hr>
                    <p class="prd-details intock">In Stock</p>
                    <p class="include-tax"><b>Delivery Date:</b> Tue, Jun 2</p>
                    <p class="sold delivery-available">Delivery Charge <span>
                            <i class="fas fa-rupee-sign"></i>
                        </span>50</p>
                        <hr>
                   
                        <div class="check-delivery">
                            <input placeholder="Enter Pincode">
                            <button>Check</button>
                        </div>
                        <p class="sold delivery-available">** Delivery Available to 743222</p>
                    
                    <hr>
                    <p class="sold">Sold by <u>Appario Retail Private Ltd</u></p>
                    <hr>
                    <p class="prd-details">
                        <b>Description</b><br><br>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                    <hr>
                    
                        <button class="addtocart">Add to Cart</button>
                    
                </div>

            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>
    <script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<script>
    var cw = $('.tablinks').width();
    $('.tablinks').css({
        'height': cw + 'px'
    });
</script>
    </body>
</html>

    