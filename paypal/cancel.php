<?php 
@session_start();
include_once('../includes/configure.php');
include_once('../includes/configure.override.php');

if(isset($_GET['token']) && empty($_SESSION['gleam_cart_session'])) {
	header("location: ".$cfg['base_url']);exit();
}

?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color: red">Fail</h2>
        <h3>Payment Failed</h3>
         <a href="<?php echo $cfg['base_url']; ?>" class="btn btn-success">Continue Shopping</a>
    	<br><br>
        </div>
	</div>
</div>