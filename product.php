<?php
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<?php 
    global $productArr;
    global $type;
    include('getProductData.php');
    $productType = null;
    switch ($type) {
        case 'feature':
            $productType = 'Feature';
            break;
        case 'new-arrival':
            $productType = 'New Arrival';
            break;        
        case 'best-selling':
            $productType = 'Best Selling';
            break;        
        case 'todays-special':
            $productType = 'Today Special';
            break;
    };
?>
<body>

    <? include_once('includes/header.php') ?>
    <div class="container-fluid product-main-box">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-3 left-section filter-box " id="filter-teacher">
                    <div class="col-xs-12 cls-box hidden-md hidden-lg">
                        <button id="serachbtncls" class="" onclick="clsbannerform()"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="filter-items">
                        <ul class="filter-items-box">
                            <li>
                                <button class="filter-btn">Category</button>
                                <ul class="filter-menu">
                                    <li>

                                        <button class="inner-cat">Toys &amp; Games<span class="carret"><i class="fas fa-caret-down"></i></span></button>
                                        <ul class="inner-filter-menu">
                                            <li>
                                                <label>Diaries
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Wirebound Notebooks
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Pencil Cases
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Pencil Holders
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Desk Supplies Organisers
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Pencil Sharpeners
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button class="inner-cat">Toys &amp; Games<span class="carret"><i class="fas fa-caret-down"></i></span></button>
                                        <ul class="inner-filter-menu">
                                            <li>
                                                <label>Pencil Cases
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>School Supply Sets
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Party Favours
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Glue, Paste &amp; Tape
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Party Table Covers &amp; Centrepieces
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button class="inner-cat">Home &amp; Kitchen<span class="carret"><i class="fas fa-caret-down"></i></span></button>
                                        <ul class="inner-filter-menu">
                                            <li class="">
                                                <label>Quilting Supplies
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Cube Erasers
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Arts &amp; Crafts Tape
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Bathroom Cosmetic Organizers
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Utensil Holders &amp; Organizers
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button class="inner-cat">Books<span class="carret"><i class="fas fa-caret-down"></i></span></button>
                                        <ul class="inner-filter-menu">
                                            <li class="">
                                                <label>Softball
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Sciences
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Technology
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Medicine
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Textbooks
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>Study Guides
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <button class="filter-btn">Price Range</button>
                                <ul class="filter-menu">
                                    <div style="margin-bottom:30px;">
                                        <input type="number" min="0" max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field">
                                        <input type="number" min="0" max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field">
                                    </div>

                                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                                </ul>
                            </li>
                            <li>
                                <button class="filter-btn">Brand</button>
                                <ul class="filter-menu">
                                    <li>
                                        <label>RJKART
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>COI
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>Shopkooky
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>SILLYME
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>GOLD LEAF
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>PACKNBUY
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-xs-12 col-md-9 right-section product-item-section ">
                    <div class="col-xs-12 heading inner-banner">
                        <h2><?php echo (!empty($productType)) ? $productType.' Products' : 'Products'; ?></h2>
                        <div>
                            <ul class="sort-by">
                                <li class="active">All</li>
                                <li>Populer</li>
                                <li>Low to Hign</li>
                                <li>Hight to Low</li>
                                <li>Newest</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 product-item-box">
                        <?php
                            $previousId = 0;
                            $firstCounter = count($productArr);
                            if (!empty($productArr)) {
                                foreach ($productArr as $key => $product) { 
                                    if (($firstCounter-1) == $key) {
                                        $previousId = $product['pd_id'];
                                    }
                        ?>
                                <div class="item productItem">
                                    <div class="main-prd-box" onclick="window.location.href='product-details.php'">
                                        <div class="box_img">
                                            <img has="postloader" src="image_bank/product_image/<?=$product['pd_image'];?>" alt="<?php echo $product['pd_name']; ?>">
                                        </div>
                                        <p class="product-name"><?php echo $product['pd_name']; ?></p>
                                    </div>
                                    <div class="price-box">
                                        <div class="price-content">
                                            <p class="price">
                                                <span class="main-price">
                                                     $<?php echo $product['pd_price']; ?>
                                                </span>
                                                <span class="offer-price">
                                                    $<?php echo $product['strike_price']; ?>
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
                        <?php  } } ?>
                        
                    </div>
                    <div class="col-xs-12 product-more-box">
                        <!-- <button id="myBtn" onclick="getMore('3','','','')" class="product-more">View More</button> -->
                        <button id="myBtn" onclick="getMoreProducts(<?php echo $previousId ?>)" class="product-more hide_view_more">View More</button>
                    </div>
                </div>
                <div class="banner-btn-box hidden-md hidden-lg">
                    <button id="searchbtn" class="hidden-md hidden-lg" onclick="openbannerform()"><i class="fas fa-filter"></i></button>
                </div>


            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>
    <script type="text/javascript">
        function openbannerform() {
            $("#filter-teacher").css({
                'top': '0',
                'opacity': '1',
                'visibility': 'visible',
                'transition': '.3s'
            });
        }

        function clsbannerform() {
            $("#filter-teacher").css({
                'top': '100%',
                'opacity': '0',
                'visibility': 'hidden',
                'transition': '.3s'
            });
        }
        $(".filter-btn").click(function(event) {
            event.stopPropagation();
            var clicked = this;
            var parent_li = $(clicked).parent("li");
            var child_ul = parent_li.find(".filter-menu");
            var child_inner_ul = parent_li.find(".inner-filter-menu");
            child_ul.toggle();
            child_inner_ul.hide();
            $(".carret").removeClass("rota");

        });
        $(".inner-cat").click(function(event) {
            event.stopPropagation();
            var clicked = this;
            var parent_li = $(clicked).parent("li");
            var child_ul = parent_li.find(".inner-filter-menu");
            var child_carret = parent_li.find(".carret");
            child_ul.toggle();
            child_carret.toggleClass("rota");
        });

        function getMoreProducts(count = 0) {
            let type = "<?php echo $type ?>";
            getProducts(count, type);
        }

        function getProducts(count, type) {
            $.ajax({
                url : "getProductData.php",
                type : "POST",
                data : { offset : count, type : type, 'is_more' : true },
                dataType : 'JSON',
                success : function(response) {

                    if (response !='') {
                        if (response.status) {
                            console.log('dddd', response);
                            console.log('dddd', response.details);
                            $('.productItem').after(response.details);
                        } else {
                            console.log('else');
                            $('.hide_view_more').hide();
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>