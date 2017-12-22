<?php
session_start();
// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();
// Suppression des cookies de connexion automatique

setcookie('pass','');

//echo'<script> alert ("merci pour votre visite")</script>';
?> <script type="text/javascript" src="../js/erreur/notif.js"></script>
<?php
print("<script type=\"text/javascript\">setTimeout('location=(\"login.php\")' ,0);</script>");
?>