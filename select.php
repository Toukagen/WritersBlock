<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1,2";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "incorrect.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href ="css/main.css" rel = "stylesheet" type ="text/css"/>

<title>index</title>

</head>
<body>
<div><?php  include("header.php");
include("menu.php");
?>
</div>
<div id="table">
<form action="addcharacter.php" method="post" name="character">
<input name="characterID" type="hidden" value="">
<input name="bookID" type="hidden" value="">
<table width="200">
  <tr> <td><label> First Name: </label></td>
    <td><input name="First Name" type="text"></td>
  </tr>
  <tr>
    <td>
<label> Last Name: </label>&nbsp;</td>
    <td><input name="Last Name" type="text">&nbsp;</td>
  </tr>
  <tr>
    <td>
<label> Age: </label>&nbsp;</td>
    <td><input name="Age" type="text">&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td>
<label> Book: </label>&nbsp;</td>
    <td><input name="Book" type="text">&nbsp;</td>
  </tr>
  <tr>
  <td nowrap align="right">&nbsp;</td>
  <td>
&nbsp;
<input name="submit" type="submit">
</td>
  </tr>
</table>
</form>

</div>
</body>
</html>