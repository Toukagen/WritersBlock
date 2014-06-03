<?php require_once('Connections/xerxies.php'); 
include("loggedin.php");
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
$bookId=$_POST['bookId'];
$Title=$_POST['Title'];
$UserInput=$_POST['UserInput'];
  $insertSQL = sprintf("INSERT INTO book (bookId, Title, UserInput) VALUES ('$bookId', '$Title', '$UI')");

  mysql_select_db($database_xerxies, $xerxies);
  $Result1 = mysql_query($insertSQL, $xerxies) or die(mysql_error());

  $insertGoTo = "addbook.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
include("header.php");
include("body.php");
?>

<form method="post" name "form" action<?php echo $editFormAction; ?>">
	<table>
		<tr>
			<td>Title:</td>
			<td><input type="text" name="Title" value="" size="32"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Insert record"></td>
		</tr>
	</table>
	<input type="hidden" name="bookId" value="">
	<input type="hidden" name="UserInput" value="<?php $UserName?>">
	<input type="hidden" name="MM_insert" value="form">
</form> 
<?php
include("footer.php");
?>