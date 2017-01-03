<?php
include('dbconnect.php');
if($_COOKIE["psgcookie"]=="")
header("Location: login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="REFRESH" CONTENT="3"><!--Make the number suitable so as to refresh accordingly-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
function delmybp(x)
{
alert('You are about to delete a buy proposal');
if (x=="")
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
xmlhttp.open("GET","delmybp.php?a="+x,true);
xmlhttp.send();
}
</script>

<script type="text/javascript">
function delmysp(x)
{
alert('You are about to delete a sell proposal');
if (x=="")
  {
  document.getElementById("txtHint1").innerHTML="";
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
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","delmysp.php?a="+x,true);
xmlhttp.send();
}
</script>


<title>MY PROPOSALS</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body bgcolor="#B54E68">

   
   <div id="wrapper3">
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
		 
	
		 <div id="leftcolumn3">
				<br><br>
			   <h2><center><b>SELL PROPOSALS MADE BY ME</b></center></h2>
				<br>
				<br>
				<?php
				$user=$_COOKIE["psgcookie"];
				$query1="SELECT * from sellprop where sid='".$user."'";
				$result1=mysql_query($query1);
				$num=mysql_numrows($result1);
				if($num!=0)
			{	
				while($row=mysql_fetch_assoc($result1))
				{
				
				echo "<br />";
				echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>COMPANY NAME:</b>&nbsp&nbsp";
				echo $row['ccode'];
				echo "<br />";
				echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>PROPOSED RATE:</b>&nbsp&nbsp";
				echo $row['rate'];
				echo "<br />";
       			echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>PROPOSED QUANTITY:</b>&nbsp&nbsp";
				echo $row['qty'];
				echo "<br />";
       			echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>PROPOSAL ID:</b>&nbsp&nbsp";
				echo $row['propid'];
				echo "<br />";
       			echo "<a href=javascript:void(0);' onclick='delmysp(".$row['propid'].");'><font color='red'><b>&nbsp&nbsp&nbspDELETE</b></font></a>";
				echo "<div id='txtHint1'><b></b></div>";
				echo "<br /><br />";
				
				}

			}	
			else
				echo "<center><b>SORRY THERE ARE NO PROPOSALS CURRENTLY</b></center>";
					
				?>
		 </div>
	
		 
	
		 <div id="rightcolumn3">
		        <br><br>
	          	<h2><center><b>BUY PROPOSALS MADE BY ME</b></center></h2>	 
				<br>
				<br>
				<?php
				$query11="SELECT * from buyprop where bid='".$user."'";
				$result11=mysql_query($query11);
				$num1=mysql_numrows($result11);
				if($num1!=0)
			{	
				
				while($row=mysql_fetch_assoc($result11))
				{
				
				
				echo "<br />";
				echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>COMPANY NAME:</b>&nbsp&nbsp";
				echo $row['ccode'];
				echo "<br />";
				echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>PROPOSED RATE:</b>&nbsp&nbsp";
				echo $row['rate'];
				echo "<br />";
       			echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>PROPOSED QUANTITY:</b>&nbsp&nbsp";
				echo $row['qty'];
				echo "<br />";
       			echo '&nbsp';
				echo '&nbsp';
				echo "&nbsp<b>PROPOSAL ID:</b>";
				echo $row['propid'];
				echo "<br />";
				echo "<a href=javascript:void(0);' onclick='delmybp(".$row['propid'].");'><font color='red'><b>&nbsp&nbsp&nbspDELETE</b></font></a>";
				echo "<div id='txtHint'><b></b></div>";
				echo "<br /><br />";
				}
			}	
			else 
				echo "<center><b>SORRY THERE ARE NO PROPOSALS CURRENTLY</b></center>";
					
				?>
				
				 
		 </div>
	
		 
   </div>
   
   
</body>
</html>


