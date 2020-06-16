<?
if(!isset($_SESSION['login_userId']) || $_SESSION['login_userId']=='')
{
header("location:emnployees.php");
}
?>