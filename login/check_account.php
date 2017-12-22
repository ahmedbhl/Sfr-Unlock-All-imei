<?php
session_start();

 if ((isset($_SESSION['user']) AND isset($_SESSION['pass'])) OR (isset($_SESSION['user_check']) AND isset($_SESSION['pass_check'])))

 {


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>SFR CHECK ACCOUNT</title>

<link rel="icon" type="sfr.jpg"
     href="images/favicon.ico" />
	    <link rel="stylesheet" href="css/example.css">


<style type="text/css">
bodsy {
    background-color: white;
}
table, th, td {
    border: 1px solid black;
}
h1 {
    color: black;
} 
</style>
<style type="text/css">
.enjoy-css {
  display: inline-block;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  cursor: pointer;
  padding: 0 20px;
  border: none;
  -webkit-border-radius: 20px;
  border-radius: 20px;
  font: normal normal bold 20px/40px "Baumans", Helvetica, sans-serif;
  color: black;
  -o-text-overflow: clip;
  text-overflow: clip;
  background: rgb(221, 221, 221);
  -webkit-box-shadow: 0 1px 0 0 rgb(119,119,119) , 0 2px 0 0 rgb(119,119,119) , 0 3px 0 0 rgb(119,119,119) , 0 4px 0 0 rgb(119,119,119) , 0 5px 0 0 rgb(119,119,119) , 0 6px 0 0 rgb(119,119,119) , 0 0 5px 0 rgba(0,0,0,0.0980392) , 0 1px 3px 0 rgba(0,0,0,0.298039) , 0 3px 5px 0 rgba(0,0,0,0.2) , 0 5px 10px 0 rgba(0,0,0,0.247059) , 0 10px 10px 0 rgba(0,0,0,0.2) , 0 20px 20px 0 rgba(0,0,0,0.14902) ;
  box-shadow: 0 1px 0 0 rgb(119,119,119) , 0 2px 0 0 rgb(119,119,119) , 0 3px 0 0 rgb(119,119,119) , 0 4px 0 0 rgb(119,119,119) , 0 5px 0 0 rgb(119,119,119) , 0 6px 0 0 rgb(119,119,119) , 0 0 5px 0 rgba(0,0,0,0.0980392) , 0 1px 3px 0 rgba(0,0,0,0.298039) , 0 3px 5px 0 rgba(0,0,0,0.2) , 0 5px 10px 0 rgba(0,0,0,0.247059) , 0 10px 10px 0 rgba(0,0,0,0.2) , 0 20px 20px 0 rgba(0,0,0,0.14902) ;
  text-shadow: 0 1px 0 #FFFFFF ;
}

.enjoy-css:hover {
  background: #FFFFFF;
}

.enjoy-css:active {
  margin: 6px 0 0;
  background: rgb(221, 221, 221);
  -webkit-box-shadow: 0 -1px 10px 0 rgba(0,0,0,0.247059) , 0 4px 10px 0 rgba(0,0,0,0.2) , 0 14px 20px 0 rgba(0,0,0,0.14902) ;
  box-shadow: 0 -1px 10px 0 rgba(0,0,0,0.247059) , 0 4px 10px 0 rgba(0,0,0,0.2) , 0 14px 20px 0 rgba(0,0,0,0.14902) ;
}

.enjoy-css:focus {
  background: rgb(221, 221, 221);
}

</style>








</head>

<body>
<center>
<br><br>
<img src="sfr.jpg" width="5%" height="30%" id="sfr">





<br>

</head>

<body>

<center>


<form id="submit-form" name="submit-form" action="check_account_action.php" method="post">
<br><br>
User sfr <br><textarea name='id' id="imei" rows="15" cols="20"></textarea><br><br>
Password<br><input type="text" name='password'><br><br>
<div class="enjoy-css" onClick="document.forms['submit-form'].submit();">Envoyer</div><br>
<input type="hidden" link async href="http://fonts.googleapis.com/css?family=Baumans" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/  >
</form>
</body>
</html>




<?php
}
else
{

print("<script type=\"text/javascript\">setTimeout('location=(\"login.php\")' ,0);</script>");

}
?>