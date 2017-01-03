<?php
include('dbconnect.php');
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="REFRESH" CONTENT="15"><!--Make the number suitable so as to refresh accordingly-->
<script type="text/javascript">
function showprice(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getprice.php?q="+str,true);
xmlhttp.send();
}
</script>
<title>WELCOME TO PSG STOCK EXCHANGE</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body bgcolor="#825A64">

   
   <div id="wrapper">
   
         <div id="header">
			<div id="viewprop">
			<center><h2>&nbsp&nbsp<a href="viewprop2.php"><font size="2" color="#165182">VIEW/ACCEPT PROPOSALS</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="makeprop.php" target="_new"><font size="2" color="#165182">MAKE A BUY/SELL PROPOSAL</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="delprop.php" target="_new"><font size="2" color="#165182">DELETE PROPOSALS MADE BY ME</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="initial">
			<center><h2>&nbsp&nbsp<a href="compcurr.php" target="_new"><font size="2" color="#165182">CURRENT SHARE PRICES</font></a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="initial">
			<center><h2>&nbsp&nbsp<a href="init.php" target="_new"><font size="2" color="#165182">BUY INITIAL STOCKS</font></a>&nbsp&nbsp</font></h2></center>
			</div>
			
			
			<div id="logout">
<center><h2><b><a href="logout.php"><font color="red">LOGOUT</font></a></b></h2></center>
</div>   


		 </div>
	
		 <div id="leftcolumn">
		 	<div id="leftcolumn2">
			<?php
				$user=$_COOKIE["psgcookie"];
				$query1="SELECT *from howmuchshares INNER JOIN company ON howmuchshares.ccode=company.ccode where teamname='".$user."'";
				$result1=mysql_query($query1);
				if(!$result1)
				echo mysql_error();
				print '<table align=center width=100% border=1>';
				print '<th>company</th>';
				print '<th>no of shares</th>';
				print '<th>value(Rs.)</th>';
				while($row1=mysql_fetch_assoc($result1))
				{	
					print  '<tr width=430px>';
					print '<td width=30% align=center>';
					echo htmlspecialchars( stripslashes($row1["ccode"]));
					print '</td>';
					print '<td width=30% align=center>';
					echo htmlspecialchars( stripslashes($row1["noshares"]));
					print '</td>';
					print '<td width=40% align=center>';
					echo htmlspecialchars( stripslashes($row1["noshares"])*$row1["rate"]);
					print '</td>';
					print '</tr>';
					
				}
				print '</table>';
			?>
		 </div>
			
			<h2><font size=3">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp MY ACCOUNT</font></h2>
			<br>
			<br>
			<?php
				echo "<br/>";
				$user=$_COOKIE["psgcookie"];
				$query="SELECT * from teamdetails where teamname='".$user."'";
				$result=mysql_query($query);
				echo "&nbsp &nbspTEAM NAME : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
				echo mysql_result($result,0,'teamcompname');
				echo "<br />";
				echo "<br />";
				echo "&nbsp &nbspTEAM USER ID : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
				echo mysql_result($result,0,'teamname');
				echo "<br />";
				echo "<br />";
				echo "&nbsp &nbspTEAM NUMERICAL ID : &nbsp &nbsp";
				echo mysql_result($result,0,'teamid');
				echo "<br />";
				echo "<br />";
				echo "&nbsp &nbspCASH BALANCE : &nbsp &nbsp &nbsp &nbsp &nbsp &nbspRs.";
				echo mysql_result($result,0,'cash');
				echo "<br />";
				echo "<br />";
				echo "&nbsp &nbspNO OF TRANSACTIONS : ";
				echo mysql_result($result,0,'nooftrans');
			?>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<center><b>* This page refreshes itself every 30 seconds</b></center>
					
		 
		 </div>
		 <div id="rightcolumn">
		 
			<center><h2><font size="3">CURRENT STOCK PRICES</font></h2></center>
			<br>
			<br>
			<form action=""> 
			<select name="customers" onchange="showprice(this.value)">
			<option value="">Select a company</option>
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
			</select>
			</form>
			<br />
			<div id="txtHint"><b>The price of the share will be displayed here..</b></div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
					
			<div id="requestf1">
			<iframe src="makeprop.php" width="380px" height="350px"></iframe>
			</div>
		 </div>
			 
   </div>
   
</body>
</html>
