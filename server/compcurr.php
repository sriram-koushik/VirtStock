<?php
include('dbconnect.php');
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>									<!--CANNOT FIX THE INITIAL NUMBER OF SHARES FOR EACH COMPANY-->
<META HTTP-EQUIV="REFRESH" CONTENT="5"><!--Make the number suitable so as to refresh accordingly-->
<title>WELCOME TO PSG STOCK EXCHANGE</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body bgcolor="#825A64">
	<div id="wrapper">
	<div id="header">
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="mypage.php"><font size="2" color="#165182">MY PAGE</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="viewprop">
			<center><h2>&nbsp&nbsp<a href="viewprop2.php"><font size="2" color="#165182">VIEW/ACCEPT PROPOSALS</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="makeprop.php"><font size="2" color="#165182">MAKE A BUY/SELL PROPOSAL</a>&nbsp&nbsp</font></h2></center>
			</div>
	
	</div>
	</div>

		
		 <div id="cent">
				<br>
				<h2><center><b>CURRENT SHARE PRICES<b></center></h2>
		 		<br>
				<?php
				$user=$_COOKIE["psgcookie"];
				$query1="SELECT * from company  where 1=1 ORDER BY cid ASC";
				$result1=mysql_query($query1);
				print '<table align=center width=100% border=1>';
				print '<th>Company name</th>';
				print '<th>Company ID</th>';
				print '<th>Company code</th>';
				print '<th>current price/share(Rs.)</th>';
				print '<th>volume</th>';
				while($row1=mysql_fetch_assoc($result1))
				{	
					print  '<tr width=80%>';
					print '<td width=35% align=center>';
					echo htmlspecialchars( stripslashes($row1["cname"]));
					print '</td>';
					print '<td width=10% align=center>';
					echo htmlspecialchars( stripslashes($row1["cid"]));
					print '</td>';
					print '<td width=10% align=center>';
					echo htmlspecialchars( stripslashes($row1["ccode"]));
					print '</td>';
					print '<td width=20% align=center>';
					echo htmlspecialchars( stripslashes($row1["rate"]));
					print '</td>';
					print '<td width=20% align=center>';
					echo htmlspecialchars( stripslashes($row1["volume"]));
					print '</td>';
					print '</tr>';
					
				}
				print '</table>';
			?>
		 <br>
		 <br>
		 </div>
		 
			
   
</body>
</html>
