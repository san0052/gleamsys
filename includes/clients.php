<div class="container-fluid clients">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h2>our clients</h2>

            </div>
            <div class="col-xs-12 owl-carousel owl-theme client">
                <div class="item">
                    <div class="col-xs-12 team-image">
                        <img src="images/client-1.png">
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-12 team-image">
                    <img src="images/client-2.png">
                    </div>
                </div>
                <!-- <div class="item">
                    <div class="col-xs-12 team-image">
                    <img src="images/client-3.png">
                    </div>
                </div> -->
                <div class="item">
                    <div class="col-xs-12 team-image">
                    <img src="images/client-4.png">
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-12 team-image">
                    <img src="images/client-5.png">
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-12 team-image">
                    <img src="images/client-6.png">
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-12 team-image">
                    <img src="images/client-7.png">
                    </div>
                </div>
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