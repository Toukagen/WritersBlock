<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_xerxies = "69.162.154.57:3308";
$database_xerxies = "xerxies_wb";
$username_xerxies = "xerxies_wb";
$password_xerxies = "theotaku";
$xerxies = mysql_pconnect($hostname_xerxies, $username_xerxies, $password_xerxies) or trigger_error(mysql_error(),E_USER_ERROR); 
?>