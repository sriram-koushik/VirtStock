<?php								
include('dbconnect.php');
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
error_reporting(0);		//REMOVE IF NEEDED
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>
SUBMIT PROPOSAL
</title>
</head>
<body bgcolor="#BD9C8C">
<div id="wrapper">
<div id="header">
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="mypage.php"><font size="2" color="#165182">MY PAGE</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="viewprop">
			<center><h2>&nbsp&nbsp<a href="viewprop2.php"><font size="2" color="#165182">VIEW/ACCEPT PROPOSALS</a>&nbsp&nbsp</font></h2></center>
			</div>
			
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="delprop.php"><font size="2" color="#165182">DELETE PROPOSALS MADE BY ME</a>&nbsp&nbsp</font></h2></center>
			</div>
</div>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

<center><h2>MAKE A PROPOSAL</h2></center>
<br>
<form name="prop"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table border="0">
			<tr>
				<td><b>&nbsp &nbspCOMPANY   : <b></td>
				<td width="20px"><select name="comp1"/>
				<option value="">SELECT A COMPANY</option>
				<option value="baj">Bajaj Auto Limited</option>
				<option value="bhel">Bharat Heavy Electricals Ltd.</option>
				<option value="airt">Bharti Airtel Ltd.</option>
				<option value="cipl">Cipla Ltd.</option>
				<option value="coal">Coal India Ltd.</option>
				<option value="dlf">Dlf Limited</option>
				<option value="hdfc">Hdfc Bank Ltd</option>
				<option value="hero">Hero Motocorp Ltd</option>
				<option value="hind">Hindalco Industries Ltd</option>
				<option value="huni">Hindustan Unilever Ltd.</option>
				<option value="hodf">Housing Development Fin. Corpn</option>
				<option value="icici">Icici Bank Ltd.</option>
				<option value="infy">Infosys Ltd.</option>
				<option value="itc">Itc Ltd.</option>
				<option value="jai">Jaiprakash Associates Limited</option>
				<option value="jsp">Jindal Steel & Powers Ltd.</option>
				<option value="lt">Larsen & Toubro Ltd.</option>
				<option value="mml">Mahindra & Mahindra Ltd</option>
				<option value="maru">Maruti Suzuki India Limited</option>
				<option value="ntpc">Ntpc Ltd.</option>
				<option value="ongc">Ongc Corpn</option>
				<option value="rel">Reliance Industries Ltd.</option>
				<option value="wip">Wipro Ltd.</option>
				<option value="sbi">State Bank Of India</option>
				<option value="ster">Sterlite Industries.</option>
				<option value="sun">Sun Pharmaceutical Inds Ltd.</option>
				<option value="tcs">Tata Consultancy Services Limited	</option>
				<option value="tata">Tata Motors Ltd.</option>
				<option value="tpc">Tata Power Co. Ltd.	</option>
				<option value="tsteel">Tata Steel Limited.</option>
				</td>
			</tr>
			<tr>
				<td><b>&nbsp &nbsp DESIRED PRICE/SHARE: </b></td>
				<td><input type="text" size="8" name="price"/></td>
			</tr>
			<tr>
				<td><b>&nbsp &nbsp DESIRED NO. OF SHARES: </b></td>
				<td><input type="text" size="8" name="noof"/></td>
			</tr>
			<tr>
				<td><b>&nbsp &nbsp TYPE OF PROPOSAL</b></td>
				<td><input type="radio" name="typeof" value="s"/>SELL<input type="radio" name="typeof" value="b"/>BUY</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="Submit" value="SUBMIT"></td>
			</tr>
</table>			
</form>

<?php

if (isset($_POST['Submit'])) 
{
	$user=$_COOKIE["psgcookie"];
	
	$comp=$_POST['comp1'];
	$noofsh=$_POST['noof'];
	$despr=$_POST['price'];
	$query1="SELECT * from howmuchshares where teamname='".$user."' AND ccode='".$comp."'";
	$result1=mysql_query($query1);
	$query10="SELECT *from company where ccode='".$comp."'";
	$result10=mysql_query($query10);
	$curprice=mysql_result($result10,0,'rate');
	$pointfi=(5/100)*$curprice;
	$upper=$curprice+$pointfi;
	$lower=$curprice-$pointfi;
	if((($comp!=""&&$noofsh!="")&&$despr!="")&&$_POST['typeof']!="")
	{
		$res1=mysql_result($result1,0,'noshares');
		if($_POST['typeof']=='b')
			{
				if($noofsh>0)	
				{
					if($despr<=$curprice+$pointfi&&$despr>=$curprice-$pointfi)
						{
							$query2="INSERT INTO buyprop VALUES('".$user."','".$comp."','".$despr."','".$noofsh."',NULL)";
							mysql_query($query2);
							echo "<br />&nbsp&nbsp&nbsp&nbsp<font color='green' size='3'><b>Your BUY PROPOSAL has been posted</b></font>";
						}
					else
						{	
							echo "<center><font color='red'><b>*Desired price of the share could only be 5% greater or lesser than the current share price<br /><br /><center><font color='blue'>5% of ".$comp." share price is :&nbsp &nbsp Rs.".$pointfi."</br>Select a range from Rs.".$lower." and Rs.".$upper." </font></center>  </b></font></center>";	
															
						}
				}
				else
					echo "&nbsp&nbsp<font color='red'><b>*Enter valid number of shares </b></font>";
			}
	
		else
			{
				if($noofsh>0)		//short selling ....********
				{
					if($despr<=$curprice+$pointfi&&$despr>=$curprice-$pointfi)
					{
							$query3="INSERT INTO sellprop VALUES('".$user."','".$comp."','".$despr."','".$noofsh."',NULL)";
							mysql_query($query3);
							echo "<br />&nbsp&nbsp&nbsp&nbsp<font color='green' size='3'><b>Your SELL PROPOSAL has been posted</b></font>";
					}
					else
					{
							echo "<center><font color='red'><b>*Desired price of the share could only be 5% greater or lesser than the current share price<br /><br /><center><font color='blue'>5% of the selected company's share price is :&nbsp &nbsp Rs.".$pointfi." </br>Select a range from Rs.".$lower." and Rs.".$upper." </font></center>  </b></font></center>";	
												
					}
				}
				else
					echo "&nbsp&nbsp<font color='red'><b>*Enter valid number of shares</b></font>";
			
			
			}
		
	}
	else
		echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color='red'><b>*Enter values for all the fields</b></font>";

}


	
?>
<br />
<br />
<br />
<iframe src="compcurr.php" width="100%" height="350px"></iframe>
</body>
</html>

