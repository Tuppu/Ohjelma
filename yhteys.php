<?php
try
{
    $yhteys = new PDO("mysql:host=localhost;dbname=harjoitus", "root", "qwfg87oiGT4");
}
catch (PDOException $e)
{
	die("VIRHE: " . $e->getMessage());
}

// virheenkäsittely: virheet aiheuttavat poikkeuksen
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// merkistö: käytetään latin1-merkistöä; toinen yleinen vaihtoehto on utf8.
$yhteys->exec("SET NAMES latin1");

// salasanaa ei ole istunnossa
if ($_SESSION["mypassword"]=="")
{
	// kirjautumissivulle
    header("location:index.php");
}

// selvittää suurimaan / viimeisen ID:n
$kyselyLastID = $yhteys->prepare("SELECT * FROM user WHERE ID = (SELECT MAX(ID) FROM user)");
$kyselyLastID->execute();
$riviLastID = $kyselyLastID->fetch();
$lastID = $riviLastID["ID"];

// siirtää muuttujiin vastaanotetut tiedot
$count = $_GET['count'];
$curPage = $_GET['curPage'];
$userNum = $_GET['userNum'];

// tarkastaa, että vastaanotetut arvot ovat oikeankokoisia
if($count < 1) $count = 1;
else if($count > 30) $count = 30;
else if(!($count > 0 and $count <= 30)) $count = 6;

if($curPage < 1) $curPage = 1;
else if($curPage > $lastID / $count) $curPage = round($lastID / $count + 0.5);
else if(!($curPage > 0 and $curPage < $lastID / $count + 1)) $curPage = 1;

// tarkastetaan salasana tietokannasta
$query = $yhteys->prepare('SELECT * FROM user WHERE Password = "'.$_SESSION["mypassword"].'"');
$query->execute();
$salarivi = $query->fetch();

// jos tunnus ja salasana ovat oikein
if ($salarivi["UserName"] == $_SESSION['myusername'] and $salarivi["Password"] == $_SESSION["mypassword"])
{
	// listattavat käyttäjät
	$minID = $curPage*$count-$count;
	$maxID = $curPage*$count+1;
	$kysely = $yhteys->prepare("SELECT * FROM user WHERE ID > ".$minID." and ID < ".$maxID);
	$kysely->execute();

	// luo käyttäjiä silmukassa, tällä hetkellä 100002 käyttäjää
	//for ($i = 90000; $i < 100003; $i++){
	//	if ($i%2) $kyselyAdd = $yhteys->prepare("INSERT INTO user (UserName, First_name, Last_name, Address, Sex, Phone, Password) VALUES ('User". $i ."', 'First". $i ."', 'Last". $i ."', 'Address". $i ."', 'Male', '012-123456789', SHA('User". $i ."Pass'));");
	//	else $kyselyAdd = $yhteys->prepare("INSERT INTO user (UserName, First_name, Last_name, Address, Sex, Phone, Password) VALUES ('User". $i ."', 'First". $i ."', 'Last". $i ."', 'Address". $i ."', 'Female', '012-123456789', SHA('User". $i ."Pass'));");
	//	$kyselyAdd->execute();
	//}
}
else
{
	// kirjautumissivulle
	header("location:index.php");
}
?>