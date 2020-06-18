<?
include_once("includes/function.php");
?>
<!DOCTYPE html>
<html lang="en">

<? pagesource() ?>

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

                            <li>
                                <button class="filter-btn">Age</button>
                                <ul class="filter-menu">
                                    <li>
                                        <label>Up to 12 months
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>1 - 2 years
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>3 - 4 years
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>5 - 6 years
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>7 - 8 years
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <button class="filter-btn">Colour</button>
                                <ul class="filter-menu">
                                    <li>
                                        <label>Red
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>Yellow
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <button class="filter-btn">Vendor</button>
                                <ul class="filter-menu">
                                    <li>
                                        <label>Vendor 1
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>Vendor 2
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
                        <h2>feature products</h2>
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
                        <div class="item">
                            <div class="main-prd-box" onclick="window.location.href='product-details.php'">
                                <div class="box_img">
                                    <img has="postloader" src="images/prd-3.png" alt="#">
                                </div>
                                <p class="product-name">Logitech B175 Wireless Optical Mouse</p>
                            </div>
                            <div class="price-box">
                                <div class="price-content">
                                    <p class="price">
                                        <span class="main-price">
                                            $15
                                        </span>
                                        <span class="offer-price">
                                            $17
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
                        <div class="item">
                            <div class="main-prd-box">
                                <div class="box_img">
                                    <img has="postloader" src="images/prd-3.png" alt="#">
                                </div>
                                <p class="product-name">Logitech B175 Wireless Optical Mouse</p>
                            </div>
                            <div class="price-box">
                                <div class="price-content">
                                    <p class="price">
                                        <span class="main-price">
                                            $15
                                        </span>
                                        <span class="offer-price">
                                            $17
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
                    </div>
                    <div class="col-xs-12 product-more-box">
                        <button id="myBtn" onclick="getMore('3','','','')" class="product-more">View More</button>
                    </div>
                </div>
                <div class="banner-btn-box hidden-md hidden-lg">
                    <button id="searchbtn" class="hidden-md hidden-lg" onclick="openbannerform()"><i class="fas fa-filter"></i></button>
                </div>
            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>
    <script>
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

        })
        $(".inner-cat").click(function(event) {
            event.stopPropagation();
            var clicked = this;
            var parent_li = $(clicked).parent("li");
            var child_ul = parent_li.find(".inner-filter-menu");
            var child_carret = parent_li.find(".carret");
            child_ul.toggle();
            child_carret.toggleClass("rota");
        })
    </script>
</body>



</html>