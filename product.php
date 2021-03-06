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
                        <button id="serachbtncls" class="hidden-md hidden-lg" onclick="clsbannerform()" style="float: right;
                        background: transparent;
                        border: 0;
                        color: var(--deep-main-color);
                        padding: 9px 0;"><i class="fas fa-grip-lines"></i></button>
                    </div>
                    <div class="filter-items">
                        <ul class="filter-items-box">
                            <li>
                                <button class="filter-btn">Category</button>
                                <ul class="filter-menu">
                                <?php 
                                    $fetch_header_category = isset($_GET['category'])?trim(base64_decode($_GET['category'])):'';
                                    $sql = '';
                                    if (!empty($fetch_header_category)) {
                                        $sql =   "SELECT DISTINCT id, name, cat_parent_id  FROM ".$cfg['DB_CATEGORY']." WHERE  `status` = 'A' AND `id` = '".$fetch_header_category."' ORDER BY `id` DESC";
                                    } else {
                                        $sql =   "SELECT DISTINCT id, name, cat_parent_id  FROM ".$cfg['DB_CATEGORY']." WHERE  `status` ='A' AND `cat_parent_id` = 0 ORDER BY `id` DESC";
                                    }
                                    $res =   $mycms->sql_query($sql);
                                    $count      =   $mycms->sql_numrows($res);
                                    if ($count>0) {
                                    while ($parent_cat    =   $mycms->sql_fetchrow($res)) {
                                ?>
                                    <li>
                                        <button class="inner-cat" data-idd = "<?php echo $parent_cat['id']; ?>"><?php echo $parent_cat['name']; ?><span class="carret"><i class="fas fa-caret-down"></i></span></button>
                                        <?php 
                                            $sql =   "SELECT DISTINCT id, name, cat_parent_id  FROM ".$cfg['DB_CATEGORY']." WHERE  `status` ='A' AND `cat_parent_id` = ".$parent_cat['id']." ORDER BY `id` DESC";
                                            $childres =   $mycms->sql_query($sql);
                                            $childcount      =   $mycms->sql_numrows($childres);
                                            if ($childcount>0) {
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
                                    <?php }} ?>
                                    </li>
                                <?php } } ?>
                                    
                                </ul>
                            </li>
                            <li>
                                <button class="filter-btn">Price Range</button>
                                <ul class="filter-menu">
                                    <div>
                                        <input type="number" min="0" max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field">
                                        <input type="number" min="1" max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field">
                                        <button class="priceBtn" style="    width: 100%;
    border: 0;
    background: var(--deep-main-color);
    color: white;
    padding: 10px;
    text-align: center; margin-top:15px;">Submit</button>
                                    </div>

                                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                                </ul>
                            </li>
                            <!-- <li>
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
                            </li> -->
                        </ul>
                    </div>

                </div>
                <div class="col-xs-12 col-md-9 right-section product-item-section">
                    <div class="col-xs-12 heading inner-banner">
                        <h2><?php echo (!empty($productType)) ? $productType.' Products' : 'Products'; ?></h2>
                        <div>
                            <ul class="sort-by">
                            <button class="hidden-md hidden-lg" onclick="opensortby()">Sort By</button>
                            <button id="searchbtn" class="hidden-md hidden-lg" onclick="openbannerform()"><i class="fas fa-filter"></i> Filter</button>
                                <li onclick="setUrl()" class="<?php echo !isset($_GET['sort'])?'active':''; ?>">All</li>

                                <!-- <li onclick="setUrl('popular')" class="<?php //echo (isset($_GET['sort']) && ($_GET['sort'] == 'popular'))?'active':''; ?>">Popular</li> -->

                                <li onclick="setUrl('low_to_high')" class="<?php echo (isset($_GET['sort']) && ($_GET['sort'] == 'low_to_high'))?'active':''; ?>">Low to High</li>

                                <li onclick="setUrl('high_to_low')" class="<?php echo (isset($_GET['sort']) && ($_GET['sort'] == 'high_to_low'))?'active':''; ?>">High to Low</li>

                                <li onclick="setUrl('newest')" class="<?php echo (isset($_GET['sort']) && ($_GET['sort'] == 'newest'))?'active':''; ?>">Newest</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 product-item-box">
                        <?php
                            if (!empty($productArr)) {
                                foreach ($productArr as $key => $product) { 
                        ?>

                                <div class="item productItem">
                                    <a href="<?=$cfg['base_url']?>product-details.php?category=<?=base64_encode($product['pd_id'])?>">

                                        <div class="main-prd-box" onclick="window.location.href='product-details.php'">
                                            <div class="box_img">
                                                <img has="postloader" src="image_bank/product_image/<?=$product['pd_image'];?>" alt="<?php echo $product['pd_name']; ?>">
                                            </div>
                                            <p class="product-name"><?php echo $product['pd_name']; ?></p>
                                        </div>
                                    </a>
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
                                                    <input class="cart_counter_<?php echo $product['pd_id']; ?>" type="number" min="1" max="10" value="1">
                                                </div>
                                            </div>
                                            <button class="add_to_cart" data-cartProductId="<?php echo $product['pd_id']; ?>">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>   
                        <?php  } } ?>
                        
                    </div>
                    <div class="col-xs-12 product-more-box">
                        <!-- <button id="myBtn" onclick="getMore('3','','','')" class="product-more">View More</button> -->
                        <button data-id="1" onclick="getMoreProducts(1)" class="product-more hide_view_more">View More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>
    <script type="text/javascript">
    function opensortby()
    {
        $(".sort-by li").slideToggle();
    }
        function openbannerform() {
            $("#filter-teacher").css({
                'left': '0',
                'opacity': '1',
                'visibility': 'visible',
                'transition': '.3s'
            });
            $(".sort-by li").slideUp();
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
        var parent_category_id = [];
        var min_amount = 0;
        var max_amount = 0;
        var see_more = 0;
        // let offset = 0;
        $(document.body).on('change', '.select_sub_category', function(event) {
            let sub_category = $(this).attr('data-subcategory');
            sub_category_array.push(sub_category);
            let counter_id = $('.hide_view_more').attr('data-id');
            getMoreProducts();
        });

        $(".inner-cat").on("click", function(){
            var dataId = $(this).attr("data-idd");
            if (dataId === undefined || dataId == '') {} 
            else {
                if(!$(this).hasClass('open')) {
                    parent_category_id.push(btoa(dataId));
                    sub_category_array=[];
                    getMoreProducts();
                    $(this).addClass(' open');
                }else {
                    
                    $(this).parent().find('.inner-filter-menu >li input:checked').each(function(i,v) {
                        
                        $(v).prop('checked',false);
                        let sub_cat_id = $(v).attr('data-subcategory');
                      
                        let index = sub_category_array.indexOf(sub_cat_id);
                        if (index > -1) {
                          sub_category_array.splice(index, 1);
                        }
                    });
                    var index = parent_category_id.indexOf(btoa(dataId));
                    if (index !== -1) parent_category_id.splice(index, 1);
                    $(this).removeClass(' open');
                    getMoreProducts();
                }
            }
        });

        $('.priceBtn').click(function() {
            min_amount = $('#min_price').val();
            max_amount = $('#max_price').val();
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

        function getProducts(count, type, see_more=0) {
            sub_category_array = unique(sub_category_array);
            $.ajax({
                url : "getProductData.php",
                type : "POST",
                data : { 
                    offset     : count, 
                    type       : type, 
                    is_more    : see_more,
                    min_amount : min_amount,
                    max_amount : max_amount,
                    sub_category    :   sub_category_array.toString(),
                    category   : parent_category_id,
                    category_get : "<?php echo isset($_GET['category']) ? $_GET['category'] : '';  ?>"
                },
                dataType : 'JSON',
                success : function(response) {
                    if (response !='') {
                        if (response.status) {
                            if(response.sidebarCounter) {
                                if(response.nextOffset <= 1) {
                                    $(".product-item-box").html(response.details);
                                    viewMore(response.nextOffset);
                                } else {
                                    $(".productItem:last").after(response.details); 
                                    viewMore(response.nextOffset);
                                }
                            } else  {
                                if(response.nextOffset <= 1) {
                                     $(".product-item-box").html(response.details);
                                     viewMore(response.nextOffset);
                                } else {
                                    if($('.productItem').length>0) {
                                        $(".productItem:last").after(response.details); 
                                        viewMore(response.nextOffset);
                                    } else {
                                        $(".product-item-box").html(response.details);
                                        viewMore(response.nextOffset);
                                    }
                                }
                            }
                        } else {
                            if(response.nextOffset==0) {
                                $(".product-item-box").html(response.details);
                            }
                            $('.hide_view_more').hide();
                            
                        }
                    }
                }
            });
        }

        function viewMore(next_id) {
           let htmlmore = '<button data-id="'+next_id+'" onclick="getMoreProducts('+next_id+')" class="product-more hide_view_more">View More</button>';
           $('.product-more-box').html(htmlmore);
        }

        function setUrl(sort=null) {
          if(sort == null || sort == '') {
            window.location.href = 'product.php';
          } else {
            window.location.href = 'product.php?sort='+sort;
          }
        }

    </script>
</body>
</html>