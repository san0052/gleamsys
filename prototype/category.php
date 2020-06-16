<?
include_once("includes/function.php");
?>
<!DOCTYPE html>
<html lang="en">

<? pagesource() ?>

<body>
    <div class="main">
        <? include_once('includes/header.php') ?>
        <? include_once('includes/banner.php') ?>
        <div class="container-fluid">
        <div class="container">
            <div class="row">
            <div class="col-xs-12 heading">
                    <h2>product category</h2>
                    <div class="tag-border">
                    </div>
                </div>
                <div class="col-xs-12 category-inner">
                    <? include_once('includes/category-item.php') ?>
                </div>
            </div>
        </div>
    </div>
    <? svg() ?>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <p class="md-line">Presently, we are exporting these products to Netherlands. </p>
            </div>
        </div>
    </div>
    <? include_once('includes/contact.php') ?>
    <? include_once('includes/footer.php') ?>
</body>



</html>