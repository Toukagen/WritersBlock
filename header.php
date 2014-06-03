<?php // ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";

if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .= "&" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout'] == "true")) {
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);

  $logoutGoTo = "index.php";
header("Location: " . $logoutGoTo);
 }?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href ="css/main.css" rel = "stylesheet" type ="text/css"/>
<title>index</title>
</head>
<body>
<div id="headerbackground">
<div id="logo">Writer's Block</div>
<p></p>
</div>
<p></p>
<nav>
<ul>
	<li><a href="home.php" id="link">Home</a></li>
    <li><a href="addbook.php" id="link">Add</a>
    <ul>
	<li><a href="addcharacter.php" id="link">Add Character</a></li>
	<li><a href="addbook.php" id="link">Add Book</a></li>
	<li><a href="addtogether.php" id="link">Add Characters to Book</a></li>
    </ul></li>
    <li><a href="twotableselect.php" id="link">View Characters</a></li>
	<li><a href="<?php echo $logoutAction ?>" id="link">Logout</a></li>
   </ul>
</nav>