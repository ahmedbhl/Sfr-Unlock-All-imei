<?php
session_start();

 if ((isset($_SESSION['user']) AND isset($_SESSION['pass'])) OR (isset($_SESSION['user_check']) AND isset($_SESSION['pass_check'])))

 {
 ?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>SFR</title>

<link rel="stylesheet" href="css/accueil.css">
	    <link rel="stylesheet" href="css/example.css">



		
   <script src="css/jquery.js"></script>
	<script src="css/script.js"></script>
	   <script src="css/check_imei.js"></script>
	   
		

  
  </head>

  <body>

<?php
if($_SESSION['user'])
{
 if(($_SESSION['nck']=='') OR ($_SESSION['imei_ctr']==''))
 {
	require 'get_code.php';
	$_SESSION['imei_ctr']=get_imei();
	$_SESSION['nck']=get_nck($_SESSION['imei_ctr'],$_SESSION['user'],$_SESSION['pass']);
 }
?>
<div class="menu2">
    <a href="accueil.php" class="current" id="home">HOME</a>
    <a href="#" id="check_acc">Check Account</a>
    <!--<a href="#" id="check_imei">Check IMEI</a>-->
    <a href="#" id="unlock">Unlock</a>
    <a class="dummy"></a>
	<a href="deconnexion.php" class="logout">Logout</a>
	<a href="#" class="logout"><?php echo $_SESSION['user'];?></a>
	<a href="#" class="logout"><?php echo $_SESSION['imei_ctr'];?></a>
	<a href="#" class="logout"><?php echo $_SESSION['nck']; ?></a>
</div>
<?php
}
else
{
?>
<div class="menu2">
    <a href="accueil.php" class="current" id="home">HOME</a>
    <a href="#" id="check_acc">Check Account</a>
    <a href="#" id="check_imei">Check IMEI</a>
    <a class="dummy"></a>
	<a href="deconnexion.php" class="logout">Logout</a>
	<a href="#" class="logout"><?php echo $_SESSION['user_check'];?></a>
	<a href="#" class="logout"><?php echo $_SESSION['nck_check']; ?></a>
</div>
<?php
}
?>


<div id="content">
<center><div style="text-align:center;width:332px;min-height:445px !important"><iframe id="frnCheck" src="http://www.cheek-check.com/frncheck.php?cheekchecker=5619a73890fa5" frameborder="0" scrolling="no" width="332" height="440" style="height:445px !important"></iframe><br><br>Check World Wide Blacklisted.<br></div></center>
</div>

<script src="css/stroll.min.js"></script>
		<script>
			stroll.bind( '#main ul' );
		</script>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

  </body>
</html>
<?php
}
else
{

print("<script type=\"text/javascript\">setTimeout('location=(\"login.php\")' ,0);</script>");

}
?>
