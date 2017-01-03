<?php
include('dbconnect.php');
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>									<!--CANNOT FIX THE INITIAL NUMBER OF SHARES FOR EACH COMPANY-->
<META HTTP-EQUIV="REFRESH" CONTENT="30"><!--Make the number suitable so as to refresh accordingly-->
<title>WELCOME TO PSG STOCK EXCHANGE</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body bgcolor="#825A64">

		<div id="right">
			<br>
			<h2><font size=3">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp NOTES</font></h2>
			<br>
			<p>
			&nbsp &nbsp &nbsp &nbsp &nbsp1).Here in this page we have initial total number of shares of &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbspdifferent companies and their prices.<br><br>
			&nbsp &nbsp &nbsp &nbsp &nbsp2).You could buy shares of any company by filling up the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp requesition form below.<br><br>
			&nbsp &nbsp &nbsp &nbsp &nbsp3).This portal can be accessed only for the next <b>10 minutes</b>.<br><br>
			&nbsp &nbsp &nbsp &nbsp &nbsp4).After this session you will be required to transact only&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspbetween the other teams but <b>NOT</b> from this page.<br><br>
			&nbsp &nbsp &nbsp &nbsp &nbsp5).You need not use all your cash here.<b>Use it wisely</b><br><br>
			&nbsp &nbsp &nbsp &nbsp &nbsp6).You could close the window once you are done with the&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  purchasing of the stocks.<br><br> 	
			<br>
			<br>
			<div id="requestf">
			<br>
			<br>
			<h2><font size=3">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp STOCK REQUESITION FORM</font></h2>
			<br>
			<br>
		
			<form name="request"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<table border="0">
			<tr>
				<td><b>&nbsp &nbspCOMPANY ID  : <b></td>
				<td><input type="text" size="16" name="id"/></td>
			</tr>
			<tr>
				<td><b>&nbsp &nbspNUMBER OF SHARES REQD. : </b></td>
				<td><input type="text" size="10" name="noofsh"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="Submit" value=" REQUEST "></td>
			</tr>
			</table>			
			</form>	
			
			
			<?php
			if (isset($_POST['Submit']))
			{
				if($_POST['noofsh']!=""&&$_POST['id']!="") 
				{	echo "<br/>";
					$user=$_COOKIE["psgcookie"];
					$shares=$_POST['noofsh'];
					$comid=$_POST['id'];
					$query="SELECT * from initial where cid='".$comid."'";
					$query1="SELECT * from teamdetails where teamname='".$user."'";
					$query4="SELECT * from company where cid='".$comid."'";
					$result=mysql_query($query);
					$result1=mysql_query($query1);
					$result4=mysql_query($query4);
					$num=mysql_numrows($result);
					if($num==1)
					{	$x=mysql_result($result,0,'qtyavl');
						$y=mysql_result($result,0,'rate');
						$z=mysql_result($result1,0,'cash');	
						$a=mysql_result($result4,0,'ccode');
						if($shares>0)
						{
							if($z>=$shares*$y)
							{
								$query2="UPDATE initial set qtyavl=qtyavl-'".$shares."' where cid='".$comid."'";
								$result2=mysql_query($query2);
								$query3="UPDATE teamdetails set cash=cash-'".$shares*$y."' where teamname='".$user."'";
								$result3=mysql_query($query3);
								$query5="UPDATE howmuchshares set noshares=noshares+'".$shares."' where teamname='".$user."' AND ccode='".$a."'";
								$result5=mysql_query($query5);
								echo "<br />&nbsp&nbsp&nbsp&nbsp<font color='green' size='3'><b>The transaction was a success!</b></font>";
								
							}
							else
							{
								echo "<br />&nbsp&nbsp&nbsp&nbsp<font color='red' size='3'><b>*Sorry you don't have enough cash to process the above request</b></font>";
							}
						}
						else
						{
					
							echo "<br />&nbsp&nbsp&nbsp&nbsp<font color='red' size='3'><b>*Enter valid number of shares</b></font>";
						}
					}
					else
						echo "<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color='red' size='3'><b>*Enter valid values for both the fields</b></font>";
				}
				else
					echo "<br />&nbsp&nbsp&nbsp&nbsp&nbsp<font color='red' size='3'><b>*Enter values for both the fields</b></font>";
			}
			?>
			
					
		 </div>
		 </div>
		 	
  
		 <div id="left">
				<br>
		 		<?php
				$user=$_COOKIE["psgcookie"];
				$query1="SELECT * from initial  where 1";
				$result1=mysql_query($query1);
				print '<table align=center width=100% border=1>';
				print '<th>company name</th>';
				print '<th>company ID</th>';
				print '<th>company code</th>';
				print '<th>current price/share(Rs.)</th>';
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
					print '</tr>';
					
				}
				print '</table>';
			?>
		 </div>
		 
			
   
</body>
</html>
