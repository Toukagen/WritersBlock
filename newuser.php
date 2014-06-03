<?php require_once('Connections/xerxies.php'); 
include("header.php");
include("body.php");

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$userName=$_POST['Username'];
$password=sha1($_POST['password']);
$role=$_POST['role'];
  $insertSQL = sprintf("INSERT INTO `users` (Username, password, role) VALUES ('$userName', '$password', '$role')");

  mysql_select_db($database_xerxies, $xerxies);
  $Result1 = mysql_query($insertSQL, $xerxies) or die(mysql_error());
  }
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<p>&nbsp;</p>
<table>
    <tr>
      <td>UserName:</td>
      <td><input type="text" name="Username" value="" size="32"></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input type="password" name="password" value="" size="32"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Submit"></td>
    </tr>
  </table>
  <input type="hidden" name="role" value="1">
  <input type="hidden" name="MM_insert" value="form1">
</form>

<?php include("footer.php");?>