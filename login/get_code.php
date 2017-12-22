<?php
session_start();
require("simple_html_dom.php");

function get_code($url,$url1,$code1)
{
$x=0;
$aURLs = array($url,$url1); // array of URLs
    $mh = curl_multi_init(); // init the curl Multi
    
    $aCurlHandles = array(); // create an array for the individual curl handles

    foreach ($aURLs as $id=>$url) { //add the handles for each url
        // $ch = curl_setup($url,$socks5_proxy,$usernamepass);
        $ch = curl_init(); // init curl, and then setup your options
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD,$_SESSION['user'].":".$_SESSION['pass']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // returns the result - very important
        curl_setopt($ch, CURLOPT_HEADER, 0); // no headers in the output
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return page 1:yes
		curl_setopt($ch, CURLOPT_TIMEOUT, 200); // http request timeout 20 seconds
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects, need this if the url changes
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3); //if http server gives redirection responce
		curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");
		curl_setopt($ch, CURLOPT_COOKIEJAR,"cookies/unlock.txt"); // cookies storage / here the changes have been made
		curl_setopt($ch, CURLOPT_COOKIEFILE,"cookies/unlock.txt");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // false for https
		curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 
        $aCurlHandles[$url] = $ch;
        curl_multi_add_handle($mh,$ch);
    }
    
    $active = null;
    //execute the handles
    do 
		{
        $mrc = curl_multi_exec($mh, $active);
		} 
    while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) 
	{
        if (curl_multi_select($mh) != -1)
		{
            do 
			{
                $mrc = curl_multi_exec($mh, $active);
            } 
			while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }

    foreach ($aCurlHandles as $url=>$ch) 
	{
        $html = curl_multi_getcontent($ch); // get the content
		
		
	    if($html)
		{
		// $x++;
		$htmll = str_get_html($html);
		$res=$htmll->find('b',1)->innertext;
		$ress=$htmll->find('b',4)->innertext;
		$code2=trim(substr($res,32));
		$code3=trim(substr($res,32));
		// echo 'code1==>'.$code2.'<br>';
		// echo 'code2==>'.$code3;
		// if($code2 =='')
		// {
		// $code2=$code1;
		// }
		// if($code3 =='')
		// {
		// $code3=$code1;
		// }
		if(($code1 != $code2 )&&($code2 !=''))
		{
		$code=$code2;
		}
		else if(($code1 != $code3)&&($code3 !=''))
		{
		$code=$code3;
		}
		else
		{
		$code=$code1;
		}
		// echo $htmll;
		usleep(5);
			
		}
		  
        curl_multi_remove_handle($mh, $ch); // remove the handle (assuming  you are done with it);
    }

    curl_multi_close($mh); // close the curl multi handler
	return $code;
}

//**********************************************************
// verif service disponible
function get_html_check($url,$url1)
{
$aURLs = array($url,$url1); // array of URLs
    $mh = curl_multi_init(); // init the curl Multi
    
    $aCurlHandles = array(); // create an array for the individual curl handles

    foreach ($aURLs as $id=>$url) { //add the handles for each url
        // $ch = curl_setup($url,$socks5_proxy,$usernamepass);
        $ch = curl_init(); // init curl, and then setup your options
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD,$_SESSION['user'].":".$_SESSION['pass']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // returns the result - very important
        curl_setopt($ch, CURLOPT_HEADER, 0); // no headers in the output
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return page 1:yes
		curl_setopt($ch, CURLOPT_TIMEOUT, 200); // http request timeout 20 seconds
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects, need this if the url changes
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3); //if http server gives redirection responce
		curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");
		curl_setopt($ch, CURLOPT_COOKIEJAR,"cookies/verif_service.txt"); // cookies storage / here the changes have been made
		curl_setopt($ch, CURLOPT_COOKIEFILE,"cookies/verif_service.txt");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // false for https
		curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 
        $aCurlHandles[$url] = $ch;
        curl_multi_add_handle($mh,$ch);
    }
    
    $active = null;
    //execute the handles
    do 
		{
        $mrc = curl_multi_exec($mh, $active);
		} 
    while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) 
	{
        if (curl_multi_select($mh) != -1)
		{
            do 
			{
                $mrc = curl_multi_exec($mh, $active);
            } 
			while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }

    foreach ($aCurlHandles as $url=>$ch) 
	{
        $html = curl_multi_getcontent($ch); // get the content
		
		
	    if($html)
		{
		$htmll = str_get_html($html);
	    
		}
		  
        curl_multi_remove_handle($mh, $ch); // remove the handle (assuming  you are done with it);
    }

    curl_multi_close($mh); // close the curl multi handler
	return $htmll;
}
//**********************************************************
// verif service disponible
//**********************************************************
function get_html($url,$url1)
{
$aURLs = array($url,$url1); // array of URLs
    $mh = curl_multi_init(); // init the curl Multi
    
    $aCurlHandles = array(); // create an array for the individual curl handles

    foreach ($aURLs as $id=>$url) { //add the handles for each url
        // $ch = curl_setup($url,$socks5_proxy,$usernamepass);
        $ch = curl_init(); // init curl, and then setup your options
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD,$_SESSION['user'].":".$_SESSION['pass']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // returns the result - very important
        curl_setopt($ch, CURLOPT_HEADER, 0); // no headers in the output
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return page 1:yes
		curl_setopt($ch, CURLOPT_TIMEOUT, 200); // http request timeout 20 seconds
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects, need this if the url changes
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3); //if http server gives redirection responce
		curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");
		curl_setopt($ch, CURLOPT_COOKIEJAR,"cookies/verif_service_unlock.txt"); // cookies storage / here the changes have been made
		curl_setopt($ch, CURLOPT_COOKIEFILE,"cookies/verif_service_unlock.txt");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // false for https
		curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 
        $aCurlHandles[$url] = $ch;
        curl_multi_add_handle($mh,$ch);
    }
    
    $active = null;
    //execute the handles
    do 
		{
        $mrc = curl_multi_exec($mh, $active);
		} 
    while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) 
	{
        if (curl_multi_select($mh) != -1)
		{
            do 
			{
                $mrc = curl_multi_exec($mh, $active);
            } 
			while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }

    foreach ($aCurlHandles as $url=>$ch) 
	{
        $html = curl_multi_getcontent($ch); // get the content
		
		
	    if($html)
		{
		$htmll = str_get_html($html);
	    
		}
		  
        curl_multi_remove_handle($mh, $ch); // remove the handle (assuming  you are done with it);
    }

    curl_multi_close($mh); // close the curl multi handler
	return $htmll;
}
//***************************************************
//get imei contract
//***************************************************
function get_imei()
{

$url="http://espace-client.sfr.fr/desimlockage/accueilDesimlockageClient.do#sfrclicid=EC_mire_Me-Connecter";


    
        $ch = curl_init(); // init curl, and then setup your options
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD,$_SESSION['user'].":".$_SESSION['pass']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // returns the result - very important
        curl_setopt($ch, CURLOPT_HEADER, 0); // no headers in the output
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return page 1:yes
		curl_setopt($ch, CURLOPT_TIMEOUT, 200); // http request timeout 20 seconds
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects, need this if the url changes
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3); //if http server gives redirection responce
		curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");
		curl_setopt($ch, CURLOPT_COOKIEJAR,"cookies/get_imei_unlock.txt"); // cookies storage / here the changes have been made
		curl_setopt($ch, CURLOPT_COOKIEFILE,"cookies/get_imei_unlock.txt");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // false for https
		curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 
		$data = curl_exec($ch); // execute the http request
        
    
	    if($data)
		{
		$htmll = str_get_html($data);
		$res =$htmll->find('input.input-base',0)->value;
		$imei=trim($res);
	
		}
		  
       
	return $imei;
}

function get_nck($imei,$user,$pass)
{

$url= 'http://espace-client.sfr.fr/desimlockage/desimlocker.do?desimlockageContext.numIMEI='.$imei.'&desimlockageContext.emailDeNotif=sfrteeam@gmail.com&desimlockageContext.emailDeNotifConfirm=sfrteeam@gmail.com#desimlock-page';


    
        $ch = curl_init(); // init curl, and then setup your options
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD,$user.":".$pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // returns the result - very important
        curl_setopt($ch, CURLOPT_HEADER, 0); // no headers in the output
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return page 1:yes
		curl_setopt($ch, CURLOPT_TIMEOUT, 200); // http request timeout 20 seconds
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects, need this if the url changes
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3); //if http server gives redirection responce
		curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");
		curl_setopt($ch, CURLOPT_COOKIEJAR,"cookies/get_nck.txt"); // cookies storage / here the changes have been made
		curl_setopt($ch, CURLOPT_COOKIEFILE,"cookies/get_nck.txt");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // false for https
		curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 
		$data = curl_exec($ch); // execute the http request
        
    
	    if($data)
		{
		$htmll = str_get_html($data);
		$res=$htmll->find('b',1)->innertext;
		$ress=$htmll->find('b',4)->innertext;
		$nck=trim(substr($res,32));
	
		}
		  
       
	return $nck;
}









?>
