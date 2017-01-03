
<?php
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
include('dbconnect.php');
$q=$_GET["q"];
$sql="SELECT * FROM company WHERE ccode = '".$q."'";

$result = mysql_query($sql);
$row = mysql_result($result,0,'rate');
echo " <br /> <br /> <br /> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<a href='javascript:void(0);' onclick='alert( ".mysql_result($result,0,"cid")." );' ><font color='black' size='5'><b>Rs.$row</b></font></a>"; 
/*PHP page to retrieve info (current stock prices) through ajax in the home page(my page)*/
?>