<?php require_once('Connections/xerxies.php'); 
include("loggedin.php");

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$characterId=$_POST['characterId'];
$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$Age=$_POST['Age'];
$UserInput=$_POST['UserInput'];
  $insertSQL = sprintf("INSERT INTO `character` (characterId, FirstName, LastName, Age, UserInput)
						VALUES ('$characterId', '$FirstName', '$LastName', '$Age', '$UI')");

  mysql_select_db($database_xerxies, $xerxies);
  $Result1 = mysql_query($insertSQL, $xerxies) or die(mysql_error());
}
include("header.php");
include("body.php");
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<p>&nbsp;</p>
<table>
    <tr>
      <td>First Name:</td>
      <td><input type="text" name="FirstName" value="" size="32"></td>
    </tr>
    <tr>
      <td>Last Name:</td>
      <td><input type="text" name="LastName" value="" size="32"></td>
    </tr>
    <tr>
      <td>Age:</td>
      <td><input type="text" name="Age" value="" size="32"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Submit"></td>
    </tr>
  </table>
  <input type="hidden" name="characterId" value="">
  <input type="hidden" name="UserInput" value="<?php $UserName?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<?php include("footer.php");?>