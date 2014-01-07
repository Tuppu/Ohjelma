<?php
class Henkilo 
{
    private $ID;
	private $UserName;
	private $First_name;
	private $Last_name;
	private $Address;
	private $Sex;
	private $Phone;

    public function __construct($ID, $UserName, $First_name, $Last_name, $Address, $Sex, $Phone)
	{
        $this->ID = $ID;
		$this->UserName = $UserName;
		$this->First_name = $First_name;
		$this->Last_name = $Last_name;
		$this->Address = $Address;
		$this->Sex = $Sex;
		$this->Phone = $Phone;
    }
	
	public function PrintUserName()
	{
		echo $this->UserName;
	}
	
	public function PrintInfo()
	{
        echo "</b>First Name: " . $this->First_name.
		"<br>Last Name: " . $this->Last_name.
		"<br>Address: " . $this->Address.
		"<br>Sex: " . $this->Sex.
		"<br>Phone: " . $this->Phone;
    }
	
	public function PrintInfo2($number)
	{     
		if ($number%2)
		{
			echo "<div>".
			"<div id=list1>" . $this->UserName . "</div>".
			"<div id=list1>" . $this->First_name . "</div>".
			"<div id=list1>" . $this->Last_name . "</div>".
			"<div id=list1>" . $this->Address . "</div>".
			"<div style='clear:both;'></div>".
			"</div>";
		}
		
		else
		{
			echo "<div>".
			"<div id=list2>" . $this->UserName . "</div>".
			"<div id=list2>" . $this->First_name . "</div>".
			"<div id=list2>" . $this->Last_name . "</div>".
			"<div id=list2>" . $this->Address . "</div>".
			"<div style='clear:both;'></div>".
			"</div>";
		}
    }
}

// Luo oliot luokasta listaan
$users = array();
for ($i = 1; $i <= $count+1; $i++) 
{
	$rivi = $kysely->fetch();
	
	// ylitää tietokannan, tiedot jätetään tyhjäksi
	if(($curPage-1)*$count+$i > $lastID)
	{
		$users[] = new Henkilo("","","","","","","");
	}
	// normaali olion luonti
	else if ($rivi["ID" != null])
	{
		$users[] = new Henkilo($rivi["ID"],$rivi["UserName"],$rivi["First_name"],$rivi["Last_name"],$rivi["Address"],$rivi["Sex"],$rivi["Phone"]);
	}
	// riviä ei ole olemassa
	else
	{
		$users[] = new Henkilo("null","null","null","null","null","null","null");
	}
}
?>