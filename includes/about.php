<div class="container-fluid page-content-sec">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-7 index-left">

        <div class="col-xs-12 welcome">


          <div class="col-xs-12 heading">

            <h2><?php echo pageContentTitle('1');?></h2>

          </div>

          <div class="col-xs-12 about-content">
            <?php echo content('1');?>
          </div>

        </div>


        <div class="col-xs-12 why-us">

          <div class="col-xs-12 heading">

            <h2><?php echo pageContentTitle('2');?></h2>

          </div>
          <?php echo content('2','tick_sign');?>
        </div>

      </div>
      <aside class="col-xs-12 col-md-5 index-right">
        <div class="col-xs-12 requer-form-box">
          <div class="col-xs-12 heading">
            <h2>Quick Quote</h2>
          </div>
          <form method="post" action="<?php echo $cfg['base_url']?>mail-process.php" onsubmit="return validate();">
            <input type="hidden" name="act" value="QuickContact"/>
            <div class="col-xs-12 form-group">
              <!-- <label>Full Name</label> -->
              <input type="text" placeholder="Full Name" name="name" id="name">
            </div>
            <div class="col-xs-12 form-group">
              <!-- <label>Full Name</label> -->
              <input type="text" placeholder="Email" name="email" id="email">
            </div>
            <div class="col-xs-12 form-group">
              <!-- <label>Full Name</label> -->
              <input type="text" placeholder="Mobile Number" name="mobileno" id="mobileno">
            </div>

            <div class="col-xs-12 form-group">

              <!-- <label>Full Name</label> -->

              <textarea placeholder="Requerments" name="message" id="message"></textarea>

            </div>

            <div class="col-xs-12 form-group">

             <button type="button" class="regi-btn" onclick="return validate()">Submit</button>

            </div>

          </form>

        </div>
      </aside>

      </div>

    </div>

  </div>

   <script>
    function validate()
    {
      var name               =   $('#name').val();
      var email              =   $('#email').val();
      var mobileno           =   $('#mobileno').val();
      var message            =   $('#message').val();
      var flag = 0;
      if($('#name').val()=='')
        {
            alert('Please enter your name');
            $('#name').focus();
            flag++;
        }
        if($('#email').val()=='')
        {
            alert('Please enter your email address');
            $('#email').focus();
            flag++;
        }
        if($('#mobileno').val()=='')
        {
            alert('Please enter your mobile number');
            $('#mobileno').focus();
            flag++;
        }
        if($('#message').val()=='')
        {
            alert('Please enter your query');
            $('#message').focus();
            flag++;
        }

      
      if(flag>0)
      {
        return false;
      }else{
            $.ajax({
                url :"<?php echo $cfg['base_url'].'mail-process.php?act=QuickContact'?>",
                type: "POST",
                data : { name : name, email: email,mobileno: mobileno,message: message },
                success : function(response){
                    if (response !='') {
                        response = response.trim();
                       if(response == 'true') {
                            alert('Email Send successfully');
                            window.location.href="<?php echo $cfg['base_url'];?>";
                       } else {
                            alert('Something went wrong');
                       } 
                    }
                   
                    event.preventDefault();
                }
            });
      }
      
    }

</script>
