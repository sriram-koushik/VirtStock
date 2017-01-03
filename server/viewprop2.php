<?php
include('dbconnect.php');
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="REFRESH" CONTENT="150"><!--Make the number suitable so as to refresh accordingly-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<title>VIEW PROPOSALS</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body bgcolor="#B54E68">

   
   <div id="wrapper3">
		 <div id="header">
		 <div id="viewprop">
			<center><h2>&nbsp&nbsp<a href="mypage.php"><font size="2" color="#165182">MY PAGE</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="makeprop.php"><font size="2" color="#165182">MAKE A BUY/SELL PROPOSAL</a>&nbsp&nbsp</font></h2></center>
			</div>
			<div id="buyprop">
			<center><h2>&nbsp&nbsp<a href="delprop.php"><font size="2" color="#165182">DELETE PROPOSALS MADE BY ME</a>&nbsp&nbsp</font></h2></center>
			</div>
			
		 </div>
		 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
			<select name="comp">
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
			<input type="submit" name="Submit8" value="SUBMIT"></input>
			</form>
			
	
		 <div id="leftcolumn3">
				<div id="form1">
				<center><b><h4>ACCEPT TO BUY</h4></b></center>
				<br>
				<form name="acceptsell" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table width="100%">
				<tr><td width="50%">PROPOSAL ID :</td>
				<td width="30%"><input type="text" name="id"></td>
				</tr>
				<tr><td width="50%">QUANTITY ACCEPTED :</td>
				<td width="30%"><input type="text" name="qtya"></td>
				</tr>
				<tr>
				<td></td>
				<td><input type="submit" name="Submit" value="ACCEPT"></td>
				<tr>
				</table>
				</form>
				<?php
				$user=$_COOKIE["psgcookie"];
				if(isset($_POST['Submit']))
				{
					$id=$_POST['id'];
					$qtya=$_POST['qtya'];//quantity accepted
					if($id!=""&&$qtya!="")
					{    $query1="SELECT * from sellprop where propid='".$id."'";
						$result1=mysql_query($query1);if(!mysql_query($query1))echo mysql_error();
						$num1=mysql_numrows($result1);
						if($num1==1)
						{	
							$sid=mysql_result($result1,0,'sid');
							$actqty=mysql_result($result1,0,'qty');
							$transrate=mysql_result($result1,0,'rate');
							$cid=mysql_result($result1,0,'ccode');
							if($qtya==$actqty)
								{		
										$query2="UPDATE company SET rate='".$transrate."' where ccode='".$cid."'";
										mysql_query($query2);
										$query3="UPDATE company SET volume=volume+'".$qtya."' where ccode='".$cid."'";
										mysql_query($query3);
										$tax=50+((0.5/100)*$qtya*$transrate);
										echo "'".$tax."' -> SERVICE CHARGE";
										$query4="UPDATE howmuchshares set noshares=noshares+'".$qtya."' where teamname='".$user."' AND ccode='".$cid."'";
										$result4=mysql_query($query4);
										$query5="UPDATE teamdetails set cash=(cash-('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$user."'";
										mysql_query($query5);
										$query6="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$user."'";
										mysql_query($query6);
										$query7="UPDATE teamdetails set cash=(cash+('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$sid."'";
										mysql_query($query7);
										$query8="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$sid."'";
										mysql_query($query8);
										$query9="UPDATE howmuchshares set noshares=noshares-'".$qtya."' where teamname='".$sid."' AND ccode='".$cid."'";
										mysql_query($query9);
										$query10="DELETE from sellprop where propid='".$id."'";
										mysql_query($query10);
										$t= date("d/m/y : H:i:s", time());
										$query11="INSERT INTO transaction VALUES(NULL,'".$user."','".$sid."','".$transrate."','".$qtya."','".$t."') ";
										mysql_query($query11);
										echo "<br><center><font color='green'>Your transaction was successful!</font></center></br>";
								}
							    else if($qtya<$actqty)
								{
										
										$query2="UPDATE company SET rate='".$transrate."' where ccode='".$cid."'";
										mysql_query($query2);
										$query3="UPDATE company SET volume=volume+'".$qtya."' where ccode='".$cid."'";
										mysql_query($query3);
										$tax=50+((0.5/100)*$qtya*$transrate);
										echo "'".$tax."' -> SERVICE CHARGE";
										$query4="UPDATE howmuchshares set noshares=noshares+'".$qtya."' where teamname='".$user."' AND ccode='".$cid."'";
										$result4=mysql_query($query4);
										$query5="UPDATE teamdetails set cash=(cash-('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$user."'";
										mysql_query($query5);
										$query6="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$user."'";
										mysql_query($query6);
										$query7="UPDATE teamdetails set cash=(cash+('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$sid."'";
										mysql_query($query7);
										$query8="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$sid."'";
										mysql_query($query8);
										$query9="UPDATE howmuchshares set noshares=noshares-'".$qtya."' where teamname='".$sid."' AND ccode='".$cid."'";
										mysql_query($query9);
										$query10="UPDATE sellprop SET qty=qty-'".$qtya."' where propid='".$id."'";
										mysql_query($query10);										
										$t= date("d/m/y : H:i:s", time());
										$query11="INSERT INTO transaction VALUES(NULL,'".$user."','".$sid."','".$transrate."','".$qtya."','".$t."') ";
										mysql_query($query11);
										echo "<br><center><font color='green'>Your transaction was successful!</font></center></br>";
								
								}
							else
								echo "<br><center><font color='red'>Maximum number of shares that you can accept is the quantity proposed</font></center></br>";
						
						}
						else
							echo "<br><center><font color='red'>Enter valid proposal ID</font></center></br>";
					
					}
					else
						echo"<br><center><font color='red'>Enter values for both the fields</font></center></br>";
								
				
				
				
				}
				
				?>
				</div>
				<br><br>
			   <h2><center><b>AVAILABLE SELLERS</b></center></h2>
				<br>
				
				<br>
				<?php
				
				$descomp=$_POST["comp"];
				$user=$_COOKIE["psgcookie"];
				$query1="SELECT * from sellprop where ccode='".$descomp."' ORDER BY rate ASC ";
				$result1=mysql_query($query1);
				$num=mysql_numrows($result1);
				if($num!=0)
			{	print '<table align=center width=100% border=1>';
				print '<th>proposer</th>';
				print '<th>company ID</th>';
				print '<th>proposed price/share(Rs.)</th>';
				print '<th>proposed quantity</th>';
				print '<th>proposal ID</th>';
				while($row=mysql_fetch_assoc($result1))
				{
				if($user!=$row['sid'])
				{
				print  '<tr width=80%>';
					print '<td width=35% align=center>';
					echo htmlspecialchars( stripslashes($row["sid"]));
					print '</td>';
					print '<td width=10% align=center>';
					echo htmlspecialchars( stripslashes($row["ccode"]));
					print '</td>';
					print '<td width=10% align=center>';
					echo htmlspecialchars( stripslashes($row["rate"]));
					print '</td>';
					print '<td width=20% align=center>';
					echo htmlspecialchars( stripslashes($row["qty"]));
					print '</td>';
					print '<td width=20% align=center>';
					echo htmlspecialchars( stripslashes($row["propid"]));
					print '</td>';
					print '</tr>';
				
				
				}
				}
		print '</table>';
			}	
			else
				echo "<center><b>SORRY THERE ARE NO PROPOSALS CURRENTLY</b></center>";
					
				?>
		 </div>
	
		 
	
		 <div id="rightcolumn3">
		       <div id="form1">
			   <center><b><h4> ACCEPT TO SELL</h4></b></center>
				<br>
				<form name="acceptbuy" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table width="100%">
				<tr><td width="50%">PROPOSAL ID :</td>
				<td width="30%"><input type="text" name="idb"></td>
				</tr>
				<tr><td width="50%">QUANTITY ACCEPTED :</td>
				<td width="30%"><input type="text" name="qtyab"></td>
				</tr>
				<tr>
				<td></td>
				<td><input type="submit" name="Submit1" value="ACCEPT"></td>
				<tr>
				</table>
				</form>
				<?php
				$user=$_COOKIE["psgcookie"];
				if(isset($_POST['Submit1']))
				{
					$id=$_POST['idb'];
					$qtya=$_POST['qtyab'];//quantity accepted
					if($id!=""&&$qtya!="")
					{    $query1="SELECT * from buyprop where propid='".$id."'";
						$result1=mysql_query($query1);if(!mysql_query($query1))echo mysql_error();
						$num1=mysql_numrows($result1);
						if($num1==1)
						{	
							$bid=mysql_result($result1,0,'bid');
							$actqty=mysql_result($result1,0,'qty');
							$transrate=mysql_result($result1,0,'rate');
							$cid=mysql_result($result1,0,'ccode');
							if($qtya==$actqty)
								{		
										$query2="UPDATE company SET rate='".$transrate."' where ccode='".$cid."'";
										mysql_query($query2);
										$query3="UPDATE company SET volume=volume+'".$qtya."' where ccode='".$cid."'";
										mysql_query($query3);
										$tax=50+((0.5/100)*$qtya*$transrate);
										echo "'".$tax."' -> SERVICE CHARGE";
										$query4="UPDATE howmuchshares set noshares=noshares-'".$qtya."' where teamname='".$user."' AND ccode='".$cid."'";
										$result4=mysql_query($query4);
										$query5="UPDATE teamdetails set cash=(cash+('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$user."'";
										mysql_query($query5);
										$query6="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$user."'";
										mysql_query($query6);
										$query7="UPDATE teamdetails set cash=(cash-('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$bid."'";
										mysql_query($query7);
										$query8="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$bid."'";
										mysql_query($query8);
										$query9="UPDATE howmuchshares set noshares=noshares+'".$qtya."' where teamname='".$bid."' AND ccode='".$cid."'";
										mysql_query($query9);
										$query10="DELETE from buyprop where propid='".$id."'";
										mysql_query($query10);
										$t= date("d/m/y : H:i:s", time());
										$query11="INSERT INTO transaction VALUES(NULL,'".$bid."','".$user."','".$transrate."','".$qtya."','".$t."') ";
										mysql_query($query11);
										echo "<br><center><font color='green'>Your transaction was successful!</font></center></br>";
								}
							    else if($qtya<$actqty)
								{
										
										$query2="UPDATE company SET rate='".$transrate."' where ccode='".$cid."'";
										mysql_query($query2);
										$query3="UPDATE company SET volume=volume+'".$qtya."' where ccode='".$cid."'";
										mysql_query($query3);
										$tax=50+((0.5/100)*$qtya*$transrate);
										echo "'".$tax."' -> SERVICE CHARGE";
										$query4="UPDATE howmuchshares set noshares=noshares-'".$qtya."' where teamname='".$user."' AND ccode='".$cid."'";
										$result4=mysql_query($query4);
										$query5="UPDATE teamdetails set cash=(cash+('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$user."'";
										mysql_query($query5);
										$query6="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$user."'";
										mysql_query($query6);
										$query7="UPDATE teamdetails set cash=(cash-('".$qtya."'*'".$transrate."'))-'".$tax."' where teamname='".$bid."'";
										mysql_query($query7);
										$query8="UPDATE teamdetails set nooftrans=nooftrans+1 where teamname='".$bid."'";
										mysql_query($query8);
										$query9="UPDATE howmuchshares set noshares=noshares+'".$qtya."' where teamname='".$bid."' AND ccode='".$cid."'";
										mysql_query($query9);
										$query10="UPDATE buyprop SET qty=qty-'".$qtya."' where propid='".$id."'";
										mysql_query($query10);										
										$t= date("d/m/y : H:i:s", time());
										$query11="INSERT INTO transaction VALUES(NULL,'".$bid."','".$user."','".$transrate."','".$qtya."','".$t."') ";
										mysql_query($query11);
										echo "<br><center><font color='green'>Your transaction was successful!</font></center></br>";
								
								}
							else
								echo "<br><center><font color='red'>Maximum number of shares that you can accept is the quantity proposed</font></center></br>";
						
						}
						else
							echo "<br><center><font color='red'>Enter valid proposal ID</font></center></br>";
					
					}
					else
						echo"<br><center><font color='red'>Enter values for both the fields</font></center></br>";
								
				
				
				
				}
				
				?>
				
				</div>
			    <br><br>
	          	<h2><center><b>AVAILABLE BUYERS</b></center></h2>	 
				<br>
				<br>
				
				<?php
				$descomp=$_POST["comp"];
				$query11="SELECT * from buyprop where ccode='".$descomp."' ORDER BY rate DESC";
				$result11=mysql_query($query11);
				$num1=mysql_numrows($result11);
				if($num1!=0)
			{	
				print '<table align=center width=100% border=1>';
				print '<th>proposer</th>';
				print '<th>company ID</th>';
				print '<th>proposed price/share(Rs.)</th>';
				print '<th>proposed quantity</th>';
				print '<th>proposal ID</th>';
				
				while($row=mysql_fetch_assoc($result11))
				{
				if($user!=$row['bid'])
				{
				
					print  '<tr width=80%>';
					print '<td width=35% align=center>';
					echo htmlspecialchars( stripslashes($row["bid"]));
					print '</td>';
					print '<td width=10% align=center>';
					echo htmlspecialchars( stripslashes($row["ccode"]));
					print '</td>';
					print '<td width=10% align=center>';
					echo htmlspecialchars( stripslashes($row["rate"]));
					print '</td>';
					print '<td width=20% align=center>';
					echo htmlspecialchars( stripslashes($row["qty"]));
					print '</td>';
					print '<td width=20% align=center>';
					echo htmlspecialchars( stripslashes($row["propid"]));
					print '</td>';
					print '</tr>';
				}	
				}
				print '</table>';
			}	
			else
				echo "<center><b>SORRY THERE ARE NO PROPOSALS CURRENTLY</b></center>";
					
				?>
				
				 
		 </div>
	
		 
   </div>
   
   
</body>
</html>


