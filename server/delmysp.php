<?php
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
include('dbconnect.php');
$id=$_GET["a"];
$query10="DELETE from sellprop where propid='".$id."'";
mysql_query($query10);

?>