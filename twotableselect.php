<?php require_once('Connections/xerxies.php');
include("loggedin.php");
include("header.php");
include("body.php");
?>

<p></p>
<p> Characters that have a book.</p>

<table width="400" border="0" id="report">
  <tr>
  <th width="120"> First Name</th>
  <th width="113"> Last Name</th>
  <th width="46" > Age</th>
  <th width="103" > Book</th>
  </tr>
</table>
  
  <?php 
  mysql_select_db($database_xerxies, $xerxies);
  //$Result = mysql_query($select1) or die(mysql_error());
 //$select1 = sprintf("Select UserInput FROM `character` WHERE character.UserInput = '$UI';");
// if(!$select1->query("NULL")){
 
 $selectSQL = sprintf("Select FirstName, LastName, Age, Title FROM `character`, `book`, `bridge` WHERE bridge.bookID = book.bookID AND character.characterID = bridge.characterID AND character.UserInput = '$UI' ;");

  $Result1 = mysql_query($selectSQL) or die(mysql_error());
while ($row = mysql_fetch_array($Result1, MYSQL_ASSOC)) {?>

<table width="400" border="0" padding-left="10px">
    <td width="125"><?php echo $row['FirstName'];?></td>
    <td width="125"><?php echo $row['LastName'];?></td>
    <td width="50"><?php echo $row['Age'];?></td>
    <td width="100"><?php echo $row['Title'];?></td>
	<td width="100"> <button onclick="location.href='editcharacter.php'" type="button" value="<?php $row['characterID']?>">Edit Character</button></td>
  </tr>
</table>
<?php
}
//} else{ ?>
<!--<p> You have no characters connected to books.</p>-->
<?php
//}
include("footer.php");
?>

