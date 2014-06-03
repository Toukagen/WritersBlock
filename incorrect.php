<?php require_once('Connections/xerxies.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=sha1($_POST['password']);
  $MM_fldUserAuthorization = "role";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "incorrect.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_xerxies, $xerxies);
  	
  $LoginRS__query=sprintf("SELECT Username, Password, role FROM users WHERE Username='$loginUsername' AND Password='$password'"); 
   
  $LoginRS = mysql_query($LoginRS__query, $xerxies) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'role');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
//INCLUDES!!!!!
include("header.php");
include("body.php");
//Login Form
$loginFormAction = $_SERVER['PHP_SELF'];
?>
<p> INCORRECT USERNAME OR PASSWORD<p>
<form name="login" action="<?php echo $loginFormAction; ?>" method="POST" >
<table align="center">
    <tr valign="baseline">
      <td nowrap align="right"><label> Username: </label></td>
	  <td><input name="username" type="text" ></td></tr>
	<tr valign="baseline">
      <td nowrap align="right"><label> Password: </label>
	  <td><input name="password" type="password" ></td></tr>
	  <tr valign="baseline">
      <td nowrap align="right"></td><td>
<input name="submit" type="submit" value="Submit">
<button onclick="location.href='newuser.php'" type="button" value="New User">New User</button></td></tr></table>
</form>




<?php include("footer.php")?>