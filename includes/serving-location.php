<div class="container-fluid stay-touch">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 heading">

                <h2>stay in touch</h2>

            </div>

            <div class="col-xs-12 col-md-6 col-md-offset-3 team-box" style="text-align: center;">

                <form >

                    <input class="form-control" placeholder="EMAIL ID" id="emailNews" name="emailNews">

                    <button style="border: 0;

                        background: #4e4e4e;

                        font-size: 16px;

                        color: white;

                        padding: 16px 17px;

                        width: 40%;

                        border-radius: 0;

                        text-transform: uppercase;margin-top: 30px;" onclick="return validateNewsletter();">Send</button>

                </form>

            </div>

        </div>

    </div>

</div>
<script>
    function validateNewsletter()
    {
      
      var email              =   $('#emailNews').val();
      var flag = 0;
     
        if($('#emailNews').val()=='')
        {
            alert('Please enter your email address');
            $('#emailNews').focus();
            flag++;
        }
        if(email != '' && (isEmail(email) == false)) {
            alert('Please enter valid email');
            $('#emailNews').focus();
            flag++;   
        }
        
      if(flag>0)
      {
        return false;
      }else{
            event.preventDefault();
            $.ajax({
                url :"<?php echo $cfg['base_url'].'mail-process.php?act=newsletterAdd'?>",
                type: "POST",
                data : { email: email},
                success : function(response){
                    if (response !='') {
                        response = response.trim();
                       if(response == 'true') {
                            alert('Email Send successfully');
                            location.reload();
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