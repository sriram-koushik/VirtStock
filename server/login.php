<?php
include('dbconnect.php');

?>
?>
<html>
<head>
<title>
PSG STOCK EXCHANGE - LOGIN
</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#3162B0">
<font face="Verdana">

<div id="loginbox" style="padding:10px;width:310px;margin-top:15%;margin-left:38%;">
<br>
<form name="login"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table border="0">
			<tr>
				<td><b>&nbsp &nbspUsername : <b></td>
				<td><input type="text" size="16" name="user"/></td>
			</tr>
			<tr>
				<td><b>&nbsp &nbspPassword : </b></td>
				<td><input type="password" size="8" name="pass"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="Submit" value=" LOGIN "></td>
			</tr>
</table>			
</form>	
<font color="red" face="Verdana">
<?php
$check=0;
if (isset($_POST['Submit'])) 
{

	$usern=$_POST['user'];
	$passw=$_POST['pass'];
	if($usern!=""&&$passw!="")
	{
		$query="SELECT password from login WHERE username='$usern'";
			$result=mysql_query($query);
			$num=mysql_numrows($result);
			if($num==1)
			{
				if($passw==mysql_result($result,0,'password'))
				{	
					setcookie("psgcookie", $usern);/*We could also set the expiry time i.e  time()+3600 after a comma*/
					header("Location: mypage.php");
				}
				else
				echo "<br/>&nbsp &nbsp &nbsp &nbsp &nbsp &nbspCombination mismatch <br/>";
			}
			else
				echo "<br/>&nbsp &nbsp &nbsp &nbsp &nbsp &nbspNo such user found <br/>";
	}
	else
	{
		echo "<br/>&nbsp &nbsp &nbspusername or password field is empty!<br/>";
	}
}
?>
</font>
</div>
</font>
</body>
</html>