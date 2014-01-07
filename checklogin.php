<?php
session_start();

$host = "localhost"; // Isäntä
$username = "root"; // Mysql-käyttäjänimi
$password = "qwfg87oiGT4"; // Mysql-salasana
$db_name = "harjoitus"; // Tietokannan nimi
$tbl_name = "user"; // Taulun nimi

// Yhistää palvelimelle ja hakee tietokannan
mysql_connect("$host", "$username", "$password") or die("Ei voi yhdistää.");
mysql_select_db("$db_name") or die("Ei voi valita tietokantaa");

// Käyttäjänimi ja salasana kirjautumissivulta
$myusername = $_POST['myusername'];
$mypassword = sha1($_POST['mypassword']);

// Suojaa MySQL injectiolta
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql = "SELECT * FROM $tbl_name WHERE username = '$myusername' and password = '$mypassword'";
$result = mysql_query($sql);

// Mysql_num_row on rivien lukumäärä
$count = mysql_num_rows($result);

// Jos tulo vastaa $myusername ja $mypassword kanssa, niin rivinumeron tullee olla 1
if ($count == 1)
{
	// Kirjaa $myusername, $mypassword ja ohjaa eteenpäin
	$_SESSION['myusername'] = $myusername;
	$_SESSION['mypassword'] = $mypassword;
	header("location:testi.php?count=6&curPage=1&userNum=1");
}
else 
{
	echo "Väärä käyttäjäni tai salasana";
}
?>