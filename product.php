<?php
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php'); ?>
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
                        <button id="serachbtncls" onclick="clsbannerform()" class="hidden-md hidden-lg" onclick="navcls()" style="float: right;
                        background: transparent;
                        border: 0;
                        color: #207da4;
                        
                        padding: 9px 0;"><i class="fas fa-grip-lines"></i></button>
                    </div>
                    <div class="filter-items">
                        <ul class="filter-items-box">
                            <li>
                                <button class="filter-btn">Category</button>
                                <ul class="filter-menu">
                                    <?php
                                    $sql =   "SELECT DISTINCT id, name, cat_parent_id  FROM " . $cfg['DB_CATEGORY'] . " WHERE  `status` ='A' AND `cat_parent_id` = 0 ORDER BY `id` DESC";
                                    $res =   $mycms->sql_query($sql);
                                    $count      =   $mycms->sql_numrows($res);
                                    if ($count > 0) {
                                        while ($parent_cat    =   $mycms->sql_fetchrow($res)) {
                                    ?>
                                            <li>
                                                <button class="inner-cat"><?php echo $parent_cat['name']; ?><span class="carret"><i class="fas fa-caret-down"></i></span></button>
                                                <?php
                                                $sql =   "SELECT DISTINCT id, name, cat_parent_id  FROM " . $cfg['DB_CATEGORY'] . " WHERE  `status` ='A' AND `cat_parent_id` = " . $parent_cat['id'] . " ORDER BY `id` DESC";
                                                $childres =   $mycms->sql_query($sql);
                                                $childcount      =   $mycms->sql_numrows($childres);
                                                if ($childcount > 0) {
                                                    while ($sub_category    =   $mycms->sql_fetchrow($childres)) {
                                                ?>
                                                        <ul class="inner-filter-menu">
                                                            <li>
                                                                <label><?php echo $sub_category['name']; ?>
                                                                    <input class="select_sub_category" type="checkbox" data-category="<?php echo $parent_cat['id'] ?>" data-subcategory="<?php echo $sub_category['id']; ?>">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                <?php }
                                                } ?>
                                            </li>
                                    <?php }
                                    } ?>

                                </ul>
                            </li>
                            <li>
                                <button class="filter-btn">Price Range</button>
                                <ul class="filter-menu">
                                    <div style="margin-bottom:30px;">
                                        <input type="number" min="0" max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field">
                                        <input type="number" min="1" max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field">
                                        <button class="priceBtn" style="color:white; background-color:#2b7ca3">Submit</button>
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
                        <h2><?php echo (!empty($productType)) ? $productType . ' Products' : 'Products'; ?></h2>
                        <div>

                            <ul class="sort-by">
                                <button class="hidden-md hidden-lg" onclick="sortby()">Sort By</button>
                                <button class="hidden-md hidden-lg" onclick="openbannerform()"><i class="fas fa-filter"></i> Filter</button>
                                <li class="active">All</li>
                                <li>Populer</li>
                                <li>Low to Hign</li>
                                <li>Hight to Low</li>
                                <li>Newest</li>
                            </ul>
                            <script>
                                function sortby() {
                                    $(".sort-by li").slideToggle();
                                }
                            </script>
                        </div>
                    </div>
                    <div class="col-xs-12 product-item-box">
                        <?php
                        $previousId = 0;
                        $firstCounter = count($productArr);
                        if (!empty($productArr)) {
                            foreach ($productArr as $key => $product) {
                                if (($firstCounter - 1) == $key) {
                                    $previousId = $product['pd_id'];
                                }
                        ?>
                                <div class="item productItem">
                                    <div class="main-prd-box" onclick="window.location.href='product-details.php'">
                                        <div class="box_img">
                                            <img has="postloader" src="image_bank/product_image/<?= $product['pd_image']; ?>" alt="<?php echo $product['pd_name']; ?>">
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
                        <?php  }
                        } ?>

                    </div>
                    <div class="col-xs-12 product-more-box">
                        <!-- <button id="myBtn" onclick="getMore('3','','','')" class="product-more">View More</button> -->
                        <!-- <button data-id="<?php echo $previousId ?>" onclick="getMoreProducts(<?php echo $previousId ?>)" class="product-more hide_view_more">View More</button> -->
                        <button data-id="1" onclick="getMoreProducts(1)" class="product-more hide_view_more">View More</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>
    <script type="text/javascript">
        function openbannerform() {
            $("#filter-teacher").css({
                'left': '0',
                'opacity': '1',
                'visibility': 'visible',
                'transition': '.3s'
            });
            $("#myDIV").removeClass("open-nav-modal");
        }

        function clsbannerform() {
            $("#filter-teacher").css({
                'left': '-200%',
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

        var sub_category_array = [];
        var min_amount = 0;
        var max_amount = 0;
        var see_more = 0;
        // let offset = 0;
        $(document.body).on('change', '.select_sub_category', function(event) {
            let sub_category = $(this).attr('data-subcategory');
            sub_category_array.push(sub_category);
            let counter_id = $('.hide_view_more').attr('data-id');
            if (counter_id == 1) {
                counter_id = 0;
                let type = "<?php echo $type ?>";
                getProducts(counter_id, type, 1);
            } else {
                getMoreProducts(counter_id);
            }
        });


        $('.priceBtn').click(function() {
            min_amount = $('#min_price').val();
            max_amount = $('#max_price').val();
            // let counter_id = $('.hide_view_more').attr('data-id');
            // getMoreProducts(counter_id);
            getMoreProducts();
        });

        function unique(list) {
            var result = [];
            $.each(list, function(i, e) {
                if ($.inArray(e, result) == -1) result.push(e);
            });
            if ($('input[type=checkbox]').is(":checked")) {
                //any one is checked
                return result;
            } else {
                //none is checked
                return [];
            }
        }

        function getMoreProducts(count = 0) {
            let type = "<?php echo $type ?>";
            getProducts(count, type, 1);
        }

        function getProducts(count, type, see_more = 0) {
            console.log(see_more);
            sub_category_array = unique(sub_category_array);

            $.ajax({
                url: "getProductData.php",
                type: "POST",
                data: {
                    offset: count,
                    type: type,
                    is_more: see_more,
                    min_amount: min_amount,
                    max_amount: max_amount,
                    sub_category: sub_category_array.toString()
                },
                dataType: 'JSON',
                success: function(response) {

                    if (response != '') {
                        if (response.status) {
                            if (response.sidebarCounter) {
                                $(".product-item-box").html(response.details);
                            } else {
                                if ($('.productItem').length > 0) {
                                    $(".productItem:last").after(response.details);
                                } else {
                                    $(".product-item-box").html(response.details);
                                }
                                viewMore(response.nextOffset);
                            }

                        } else {
                            if (response.sidebarCounter) {
                                $(".product-item-box").html(response.details);
                            }
                            $('.hide_view_more').hide();
                        }
                    }
                }
            });
        }

        function viewMore(next_id) {
            let htmlmore = '<button data-id="' + next_id + '" onclick="getMoreProducts(' + next_id + ')" class="product-more hide_view_more">View More</button>';
            $('.product-more-box').html(htmlmore);
        }
    </script>
</body>

</html>