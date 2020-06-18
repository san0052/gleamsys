<div class="col-xs-12 col-md-3 prf-left-box profile-side-close slow" id="profile-side">
    <div class="pos">


        <button class="prf-side-btn hidden-md hidden-lg" onclick="prfsideopen()">></button>
        <div class="col-xs-12 prf-detail-box">
            <div class="col-xs-3 teacherlisting-pic">
                <img src="http://localhost/theteachershub/dev/images/demo-prf-pic.png">
            </div>
            <div class="col-xs-12 teacherlisting-about-text-left">
                <h4>Hello</h4>
                <h6>Swarnendu</h6>
            </div>
        </div>
        <div class="col-xs-12 prf-menu-box">
            <ul>
                <li class="active" onclick="window.location.href='profile.php'"><span class="prf-side-icon">1</span><span class="prf-side-menu">Profile</span></li>
                <li onclick="window.location.href='orderlist.php'"><span class="prf-side-icon">2</span><span class="prf-side-menu">My Orders</span></li>
                <li class="" onclick="window.location.href='cancelorder.php'"><span class="prf-side-icon">3</span><span class="prf-side-menu">Cancel Orders</span></li>
                <li class="" onclick="window.location.href='wishlist.php'"><span class="prf-side-icon">4</span><span class="prf-side-menu">Wishlist</span></li>
                <li><span class="prf-side-icon">5</span></span><span class="prf-side-menu">Log Out</span></li>
            </ul>
        </div>
    </div>
</div>
<script>
    function prfsideopen() {
        $("#profile-side").toggleClass("profile-side-close");
    }
</script>