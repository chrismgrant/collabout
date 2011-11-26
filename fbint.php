<?php
$app_id = "213893455349740";
$app_secret = "f8ec339debcd981a521840b583b657d8";
$my_url = "http://www.collabout.com/fbint.php";

session_start();

 $code = $_REQUEST["code"];

 if(empty($code)) {
   $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
   $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
     . $app_id . "&redirect_uri=" . urlencode($my_url) ."&scope=email". "&state="
     . $_SESSION['state'];

   echo("<script> top.location.href='" . $dialog_url . "'</script>");
 }

 if($_REQUEST['state'] == $_SESSION['state']) {
   $token_url = "https://graph.facebook.com/oauth/access_token?"
     . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
     . "&client_secret=" . $app_secret . "&code=" . $code;

   $response = file_get_contents($token_url);
   $params = null;
   parse_str($response, $params);

   $graph_url = "https://graph.facebook.com/me?access_token=" 
     . $params['access_token'];

   $user = json_decode(file_get_contents($graph_url));
   echo("Hello " . $user->email);
 }
 else {
   echo("The state does not match. You may be a victim of CSRF.");
 }

?>