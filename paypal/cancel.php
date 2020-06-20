<?php 
@session_start();
//header("Cache-Control: no-cache, must-revalidate");
include_once("../includes/configure.php");
include_once("../includes/configure.override.php");

include_once("../includes/configure.language.php");

include_once("../includes/function.php");
include_once("../includes/frontend.template.php");
include_once("../includes/libs/class.common.php"); 
?>
<div class="container">
    <div class="status">
        <h1 class="error">Your PayPal Transaction has been Canceled</h1>
    </div>
    <a href="<?php echo $cfg['base_url']; ?>" class="btn-link">Back to Products</a>
</div>