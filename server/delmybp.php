<?php
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
include('dbconnect.php');
$id=$_GET["a"];
$query10="DELETE from buyprop where propid='".$id."'";
mysql_query($query10);
echo $id;
?>
