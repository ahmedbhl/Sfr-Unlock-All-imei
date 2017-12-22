<?php
session_start();

 if (isset($_SESSION['user_check']) AND isset($_SESSION['pass_check']))

 {
 ?>
 <link rel="stylesheet" href="css/example.css">
<link rel="stylesheet" href="css/stroll.css">

<div id="main">
<center>
<?php
	if(!empty($_REQUEST['imei'])&& isset($_REQUEST['imei']))//&& is_numeric ($_POST['imei']))

				{
					require("header.php");
					require("get_code.php");
					$i=0;
					$urlv= 'http://espace-client.sfr.fr/desimlockage/afficherFormulaireModifEmail.do?desimlockageContext.numIMEI=862686020393230&desimlockageContext.emailDeNotif=sfrteeam@gmail.com&desimlockageContext.emailDeNotifConfirm=sfrteeam@gmail.com#sfrclicid=EC_desimlocage_desimlocker-HorsListe';
					$tab_clean=array();
					$tab_06=array();
					$tab_03=array();
					$tab_07=array();
					$tab_err=array();
					$texte = $_POST['imei'];
					$tab_lignes = explode("\n",$texte);
					$tab_lignes = array_map('trim',$tab_lignes);// Enlève les espaces vides
					$tab_lignes = array_filter($tab_lignes);// Supprime les éléments vides (= lignes vides)
					$ligne = array_slice($tab_lignes,0,1000);// Sélectionne les 15 premiers éléments du tableau (soit les 15 premières lignes non vides)
					$data=get_html_check($urlv,$urlv);	
					
					if(strpos($data, "Code erreur 02"))
						{
						echo '<br><br>Le service de desimlockage est fermer pour maintenance entre 4h et 6h, veuillez vous reconnecter en dehors de cette plage horaire.';
						exit();

						}
						else
						{
					
					
					foreach( $ligne as $row => $imei ) 

							{	$i++;				
$cok='cookies/check_imei.txt';	
$msg='';						
global $proxy;
$url= 'http://espace-client.sfr.fr/desimlockage/afficherFormulaireModifEmail.do?desimlockageContext.numIMEI='.$imei.'#sfrclicid=EC_desimlocage_desimlocker-HorsListe';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_HEADER, 0); // return headers 0 no 1 yes
curl_setopt($ch, CURLOPT_USERPWD,$_SESSION['user_check'].":".$_SESSION['pass_check']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return page 1:yes
curl_setopt($ch, CURLOPT_TIMEOUT, 200); // http request timeout 20 seconds
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects, need this if the url changes
curl_setopt($ch, CURLOPT_MAXREDIRS, 2); //if http server gives redirection responce
curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");
curl_setopt($ch, CURLOPT_COOKIEJAR, $cok); // cookies storage / here the changes have been made
curl_setopt($ch, CURLOPT_COOKIEFILE, $cok);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // false for https
curl_setopt($ch, CURLOPT_ENCODING, "gzip"); // the page encoding
$data = curl_exec($ch); // execute the http request

if ( $error = curl_error($ch) )
	{
		 echo  'ERROR Systeme';
		unlink($cok);
		curl_close($ch); 
	}
if(strpos($data, "Account locked"))
{
			$msg='Compte Bloquer';
}
else if (strpos($data, "Confirmation") !== false)
	{
		if (unlink($cok))
		{
			// $msg='<font color="green">CLEAN</font>';
			$tab_clean[$i]='<font color="green">'.$imei.'</font>';
		}
		else
		{
			$msg= 'error delete cookies';
		}
		
	}
else if (strpos($data, "Code erreur : 06") !== false)
{

	if (unlink($cok))
	{
	// $msg='<font color="blue">Code erreur : 06 ==> BLACKLISTE</font>';
		$tab_06[$i]='<font color="red">'.$imei.'</font>';

	}
	else
	{
	$msg= 'error delete cookies';
	}
}
else if (strpos($data, "Code erreur : 03") !== false)
{
	if (unlink($cok))
	{
	// $msg='<font color="red">Code erreur : 03 ==> NOT FOUND</font>';
	$tab_03[$i]='<font color="blue">'.$imei.'</font>';

	}
	else
	{
	$msg= 'error delete cookies';
	}


}
else if (strpos($data, "Code erreur : 07") !== false)
{
	if (unlink($cok))
	{
	// $msg='<font color="red">Code erreur : 07</font>';
	$tab_07[$i]='<font color="green">'.$imei.'</font>';
	}
	else
	{
	$msg= 'error delete cookies';
	}


}
else
{
	if (unlink($cok))
	{
		// $msg='<font color="red">Erreur Technique</font>';
			$tab_err[$i]='<font color="green">'.$imei.'</font>';

	}
	else
	{
		$msg= 'error delete cookies';
	}
}
// echo $row.'==>'.$imei.' ==> '.$msg.'<br>';
// echo $data;


}
//afficharge
?>
<h2><?php echo 'NUMBER TOTAl OF IMEI : '.$i;?></h2>
<?php
if($tab_clean)
{

?><article><h2>(<font color="green"><?php echo count($tab_clean);?></font>)CLEAN</h2><ul class="wave"><?php

foreach( $tab_clean as $row => $imei ) 
{

?>
<li>
<?php
echo $imei;
?>
</li>
<?php
}
?>
</ul>
</article>
<?php
}

if($tab_07)
{

?><article><h2>(<font color="green"><?php echo count($tab_07);?></font>) EXPIRED ACCOUNT (Code erreur : 07)</h2><ul class="wave"><?php
foreach( $tab_07 as $row => $imei ) 
{
?>
<li>
<?php
echo $imei;
?>
</li>
<?php
}
?>
</ul>
</article>
<?php
}

if($tab_03)
{

?>
<article><h2>(<font color="blue"><?php echo count($tab_03);?></font>) NOT FOUND</h2><ul class="wave"><?php

foreach( $tab_03 as $row => $imei ) 
{
?>
<li>
<?php
echo $imei;
?>
</li>
<?php
}
?>
</ul>
</article>
<?php
}

if($tab_06)
{

?>
<article><h2>(<font color="red"><?php echo count($tab_06);?></font>) STOLEN</h2>
<ul class="wave">
<?php


foreach( $tab_06 as $row => $imei ) 
{

?>
<li>
<?php
echo $imei;
?>
</li>
<?php
}
?>
</ul>
</article>
<?php
}

if($tab_err)
{

?>
<article><h2>(<font color="green"><?php echo count($tab_err);?></font>) CLEAN / UNKNOW ERROR</h2>
<ul class="wave">
<?php
foreach( $tab_err as $row => $imei ) 
{

?>
<li>
<?php
echo $imei;
?>
</li>
<?php
}
?>
</ul>
</article>
<?php
}
if($tab_err)
{
echo $msg;
}

}
}
else
{
echo '<script>alert("svp remplir le champs imei")</script>';

print("<script type=\"text/javascript\">setTimeout('location=(\"accueil.php\")' ,0);</script>");
}

?>
</center>
</div>
<script src="css/stroll.min.js"></script>
		<script>
			stroll.bind( '#main ul' );
		</script>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<?php
}
else
{

print("<script type=\"text/javascript\">setTimeout('location=(\"login.php\")' ,0);</script>");

}
?>