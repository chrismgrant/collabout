<?php

include("include/session.php");
//integration

$app_id = "213893455349740";
$app_secret = "f8ec339debcd981a521840b583b657d8";
$my_url = "http://www.collabout.com/fbprocess.php";

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
  	echo("Hello " . $user->name);

	echo("<br	/>Name: " . $user->name);
	echo("<br	/>ID: " . $user->id);
	echo("<br	/>Email: " . $user->email);

	$fbname=$user->name;
	$fbid=$user->id;
	$fbemail=$user->email;

	echo "<script>alert('$fbname - $fbemail');</script>";


	//try to login

	global $session, $form;
	/* Login attempt */
	$retval = $session->fblogin($fbid);

	/* Login successful */
	if($retval){
		echo "<script>alert('Login Success');</script>";
	//	header("Location: ".$session->referrer);
	}
	/* Login failed */
	else{
		echo "<script>alert('Login Failed');</script>";
	 	//$_SESSION['value_array'] = $_POST;
		//$_SESSION['error_array'] = $form->getErrorArray();
		//header("Location: ".$session->referrer);
	}


	//Register 
	//global $session, $form;

	/* Registration attempt */
	$retval = $session->fbregister($fbid, $fbemail, $fbname);

	/* Registration Successful */
	if($retval == 0){
	   	echo "<script>alert('Registration Success');</script>";
	   $_SESSION['reguname'] = $_POST['user'];
	   $_SESSION['regsuccess'] = true;
	   header("Location: event.php");
	}
	/* Error found with form */
	else if($retval == 1){
	   $_SESSION['value_array'] = $_POST;
	   $_SESSION['error_array'] = $form->getErrorArray();
	   //header("Location: ".$session->referrer);
	}
	/* Registration attempt failed */
	else if($retval == 2){
	   $_SESSION['reguname'] = $_POST['user'];
	   $_SESSION['regsuccess'] = false;
	  // header("Location: ".$session->referrer);
	}

}
else{
	echo("The state does not match. You may be a victim of CSRF.");
}
 

?>