<? include_once('sideslide.php') ?>
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 logo-box">
                <h1 class="logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="" title="Pho-com-net Private Limited">
                    </a>
                </h1>
            </div>
            <div class="col-xs-10 col-xs-offset-2 navigation-bar">
                <nav>
                    <ul id="myDIV">
                        <li onclick="window.location.href='index.php'">Home</li>
                        <li onclick="window.location.href='about.php'">About</li>
                        <li >
                            <button class="drop-btn">Services
                                <span class="carret" style="color:white;">
                                    <i class="fas fa-caret-down"></i>
                                </span>
                            </button>
                            <ul class="drop-menu hide">
                                <li>Buy Online</li>
                                <li onclick="window.location.href='tech-support.php'">Tech Support</li>
                                <li onclick="window.location.href='it-service.php'">IT Services</li>
                                <li onclick="window.location.href='computer-training.php'">Computer Training</li>
                            </ul>
                        </li>
                        <!-- <li>
                            <button class="drop-btn">Product Category
                                <span class="carret" style="color:white;">
                                    <i class="fas fa-caret-down"></i>
                                </span>
                            </button>
                            <ul class="drop-menu hide">
                                <li>Refurbished Computer</li>

                                <li>Used Laptop</li>

                                <li>Clearence</li>
                            </ul>
                        </li> -->
                        <li onclick="window.location.href='portfolio.php'">Portfolio</li>
                        <li onclick="window.location.href='client.php'">Clients</li>
                        <li onclick="window.location.href='contact.php'">Contact</li>
                        <!-- <li class="drop-btn">
                            <button class="drop-btn">My Account<span class="carret" style="color:white;"><i class="fas fa-caret-down"></i></span></button>
                            <ul class="drop-menu hide">
                                <li>Profile</li>
                                <li>Wishlist</li>
                            </ul>
                        </li> -->
                        
                    </ul>
                    <ul class="cart-box">
                    <li onclick="openlogin()">Login</li>
                        <li class="cart">
                        <sub>0</sub>    
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 437.812 437.812" style="enable-background:new 0 0 437.812 437.812;" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <circle cx="152.033" cy="390.792" r="47.02" />
                                            <circle cx="350.563" cy="390.792" r="47.02" />
                                            <path d="M114.939,82.024l-16.196-49.11C92.296,13.499,74.267,0.292,53.812,0H18.808C13.037,0,8.359,4.678,8.359,10.449     s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l65.829,200.098l-4.702,12.016     c-5.729,14.98-4.185,31.769,4.18,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.755c5.771,0,10.449-4.678,10.449-10.449     c0-5.771-4.678-10.449-10.449-10.449H183.38c-8.797-0.304-16.849-5.017-21.42-12.539c-4.932-7.424-5.908-16.796-2.612-25.078     l6.269-15.674c0.942-2.504,1.124-5.23,0.522-7.837l-3.135-7.837l212.637-21.943c15.482-1.393,28.327-12.554,31.869-27.69     l21.943-92.473L114.939,82.024z" />
                                        </g>
                                    </g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg></li>
                        <!-- <li class="drop-btn">0.00<span class="carret" style="color:white;"><i class="fas fa-caret-down"></i></span> -->
                        
                        </li>
                    </ul>
                    <div class="clear"></div>
                </nav>

            </div>

        </div>
    </div>
</header>
<script>
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $(".header").css({
                'box-shadow': '0 0 15px #00000033',
            });
            $(".logo-box").css({
                'height': '100%',
                'transition': '.3s',
            });
            $(".logo-box h1 a img").css({
                'padding': '15px',
                'transition': '.3s',
            });
            $("#goup").show();

        } else {
            $(".header").css({
                'box-shadow': 'none',
            });
            $(".logo-box").css({
                'height': '20vh',
                'transition': '.3s',
            });
            $(".logo-box h1 a img").css({
                'padding': '0',
                'transition': '.3s',
            });
            $("#goup").hide();
        }
    });
</script>
<script>
    $(".drop-btn").click(function(event) {
        event.stopPropagation();
        var clicked = this;
        var parent_li = $(clicked).parent("li");
        var child_ul = parent_li.find(".drop-menu");
        console.log(child_ul);
        if (child_ul.hasClass("hide")) {
            child_ul.removeClass("hide").addClass("show");
            $(".drop-btn").each(function() {
                var next_li = this;
                if (next_li != clicked) {
                    var parent_li_other = $(next_li).parent("li");
                    var child_ul_other = parent_li_other.find("ul");
                    child_ul_other.removeClass("show").addClass("hide");
                }
            });
        } else if ((child_ul.hasClass("show"))) {
            child_ul.removeClass("show").addClass("hide");

        }
    })

    $(".inner-drop-btn").click(function(event) {
        event.stopPropagation();
        var clicked = this;
        var parent_li = $(clicked).parent("li");
        var child_ul = parent_li.find(".inner-drop-menu");
        console.log(child_ul);
        if (child_ul.hasClass("hide")) {
            child_ul.removeClass("hide").addClass("show");
            $(".inner-drop-btn").each(function() {
                var next_li = this;
                if (next_li != clicked) {
                    var parent_li_other = $(next_li).parent("li");
                    var child_ul_other = parent_li_other.find("ul");
                    child_ul_other.removeClass("show").addClass("hide");
                }
            });
        } else if ((child_ul.hasClass("show"))) {
            child_ul.removeClass("show").addClass("hide");

        }
    })
</script>
<script>
    function openlogin() {
        $("#side-modal").addClass("open-side-modal");
        $("#login").slideDown();
        $("#regi").slideUp();
        $("div[dep=forget-password]").slideUp();
        $("body").css({
            'overflow': 'hidden'
        });
    }

    function openregi() {
        $("#side-modal").addClass("open-side-modal");
        $("#login").slideUp();
        $("#regi").slideDown();
        $("div[dep=forget-password]").slideUp();
        $("body").css({
            'overflow': 'hidden'
        });
    }
    function enqueryslide(type=null) {
        $("#side-modal").addClass("open-side-modal");
        $("#enquery").slideDown();
        $("body").css({
            'overflow': 'hidden'
        });
       
        if (type=='prof') {
            $('#PROFESSIONAL').prop('checked', true);
        }else if (type=='begin') {
            $('#BEGINNER').prop('checked', true);
        } else {
            $('#ADVANCED').prop('checked', true);
        }
    }
    function techbookopen() {
        $("#side-modal").addClass("open-side-modal");
        $("#techbook").slideDown();
        $("body").css({
            'overflow': 'hidden'
        });
    }

    function bookcls() {
        $("#side-modal").removeClass("open-side-modal");
        $("#login").slideUp();
        $("#regi").slideUp();
        $("div[dep=forget-password]").slideUp();
        $("body").css({
            'overflow-y': 'auto'
        });
    }
</script>
<script type="text/javascript">
    function gotoTop(top) {
        $("html, body").animate({
            scrollTop: top + "px"
        }, 'slow');

    }
</script>