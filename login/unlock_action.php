<?php
session_start();

 if (isset($_SESSION['user']) AND isset($_SESSION['pass']))

 {

 ?>
 <link rel="stylesheet" href="css/example.css">
<link rel="stylesheet" href="css/stroll.css">

<div id="main">

<?php

// $_SESSION['imei_ctr']=get_imei();
// sleep(2);
	if(!empty($_REQUEST['imei'])&& isset($_REQUEST['imei'])&& !empty($_SESSION['imei_ctr'])&& isset($_SESSION['imei_ctr']))//&& is_numeric ($_POST['imei']))

				{
					require("header.php");
					include("get_code.php");
					// require("simple_html_dom.php");
					// $_SESSION['imei_ctr']=$_REQUEST['imei_ctr'];
					$imei1=$_SESSION['imei_ctr'];
					$code=$_SESSION['nck'];
					$urlv= 'http://espace-client.sfr.fr/desimlockage/afficherFormulaireModifEmail.do?desimlockageContext.numIMEI='.$imei1.'&desimlockageContext.emailDeNotif=sfrteeam@gmail.com&desimlockageContext.emailDeNotifConfirm=sfrteeam@gmail.com#sfrclicid=EC_desimlocage_desimlocker-HorsListe';
					$i=0;
					$msg='';					
					global $proxy;
					$tab_err=array();
					$tab_rework=array();
					$$tab_unlock=array();
					$texte = $_POST['imei'];
					$tab_lignes = explode("\n",$texte);
					$tab_lignes = array_map('trim',$tab_lignes);// Enlève les espaces vides
					$tab_lignes = array_filter($tab_lignes);// Supprime les éléments vides (= lignes vides)
					$ligne = array_slice($tab_lignes,0,1000);// Sélectionne les 15 premiers éléments du tableau (soit les 15 premières lignes non vides)
					
					$data=get_html($urlv,$urlv);	
					
					if(strpos($data, "Code erreur 02"))
						{
						echo '<br><br>Le service de desimlockage est fermer pour maintenance entre 4h et 6h, veuillez vous reconnecter en dehors de cette plage horaire.';
						exit();

						}
						else
						{
					foreach( $ligne as $row => $imei ) 

							{	$i++;
				
								$code1 =''; 
								
	


$url= 'https://espace-client.sfr.fr/desimlockage/desimlocker.do?desimlockageContext.numIMEI='.$imei.'&&'.$imei1.'&desimlockageContext.emailDeNotif=sfrteeam@gmail.com&desimlockageContext.emailDeNotifConfirm=sfrteeam@gmail.com#desimlock-page';
$url1= 'https://espace-client.sfr.fr/desimlockage/desimlocker.do?desimlockageContext.numIMEI='.$imei1.'&&'.$imei.'&desimlockageContext.emailDeNotif=sfrteeam@gmail.com&desimlockageContext.emailDeNotifConfirm=sfrteeam@gmail.com#desimlock-page';
//*********************** MAIN ******************************************
	sleep(1);
	$code1=get_code($url,$url1,$code);

echo'<center>';
if($code1 == $code)
{
$tab_rework[$i]='<tr><td colspan="3"><font color="yellow"><center>'.$imei.'</center></font></td><tr>';
}
else
{
if($code1!='')
{
$tab_unlock[$i]='<tr><td><font color="green">'.$imei.'</font></td><td><b> >></b></td> <td><font color="green">'.$code1.'</font></td></tr>';
}
else
{
$tab_err[$i]='<tr><td colspan="3"><font color="red"><center>'.$imei.'</center></font></td></tr>';
}
}
}
// -----------------AFFICHAGE------------
echo'<table border="0"><tr>';
if($tab_unlock)
	{

		foreach( $tab_unlock as $row => $imei ) 
		{
		echo $imei;
		}
	}

if($tab_err)
	{
echo '</tr><tr><font size="2">NOT FOUND</font></tr><tr>';
		foreach( $tab_err as $row => $imei ) 
		{
		echo $imei;
		}
	}
// echo '<hr>';
if($tab_rework)
	{

		foreach( $tab_rework as $row => $imei ) 
		{
		echo $imei;
		}
	}
echo'</tr></table>';
echo'</center>';


}


							
















				
							
}							

else
{
echo '<script>alert("svp remplir le champ imei")</script>';

print("<script type=\"text/javascript\">setTimeout('location=(\"accueil.php\")' ,0);</script>");
}
}
else
{
print("<script type=\"text/javascript\">setTimeout('location=(\"login.php\")' ,0);</script>");

}
?>