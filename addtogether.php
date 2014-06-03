<?php require_once('Connections/xerxies.php');
include("loggedin.php");
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$bridgeId=$_POST['bridgeId'];
	$bookId=$_POST['bookId'];
	$characterId=$_POST['characterId'];
  $insertSQL = sprintf("INSERT INTO bridge (bridgeId, bookId, characterId) VALUES ('$bridgeId', '$bookId', '$characterId')");

  mysql_select_db($database_xerxies, $xerxies);
  $Result1 = mysql_query($insertSQL, $xerxies) or die(mysql_error());

  $insertGoTo = "addtogether.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
include("header.php");
include("body.php");

mysql_select_db($database_xerxies, $xerxies);
$selectuser=sprintf("Select UserName FROM `users` WHERE UserName='$UI';");
$select=sprintf("Select characterId, FirstName, LastName, UserInput FROM `character` WHERE UserInput='$UI';");
$select2=sprintf("Select Title, bookID, UserInput FROM `book` WHERE UserInput='$UI';");
 
$Result3 = mysql_query($select) or die(mysql_error());
$Result2 =mysql_query($select2) or die(mysql_error());
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">BookId:</td>
      <td><select name="bookId">
<?php
while ($row = mysql_fetch_array($Result2, MYSQL_ASSOC)) { 
unset($Title,$id2 );
                  $id2 = $row['bookID'];
                  $Title = $row['Title'];
                  echo '<option value='.$id2.'>'.$Title.'</option>';}
?>
</select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">CharacterId:</td>
      <td><select name="characterId">

<?php

while ($row2 = mysql_fetch_array($Result3, MYSQL_ASSOC)) { 
unset($FirstName, $LastName, $id3 );
                  $id3 = $row2['characterId'];
                  $FirstName = $row2['FirstName'];
				  $LastName = $row2['LastName']; 
                  echo '<option value='.$id3.'>'.$FirstName.' '.$LastName.'</option>';
}?>
</select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Submit"></td>
    </tr>
  </table>
  <input type="hidden" name="bridgeId" value="">
  <input type="hidden" name="MM_insert" value="form1">
</form>

<p>&nbsp;</p>
<?php include("footer.php");?>