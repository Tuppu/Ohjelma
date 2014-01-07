<?php
session_start(); 
?>

<html lang="en">
	<head>
	  <meta charset="utf-8" />
	  <title>Otsikko</title>
	  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	  <link rel="stylesheet" href="style.css" />
	  <style>
	  #draggable { width: 670px; padding: 0.5em;}
	  </style>
	  <script>
	  $(function() 
	  {
		$( "#draggable" ).draggable();
	  });
	  </script>
	</head>
	<body>

		<?php
		// tietokantayhteydet
		include("yhteys.php");

		// Henkilo-luokka ja -olioiden luominen
		include("classHenkilo.php");

		// Nappien tapahtumakäsittelyt
		include("eventButton.php");
		?> 
		 
		<div id = "header">
			<center><h1>Header Area: Insert the name of your application here</h1></center>
		</div>
		<div id = "container">
			<div id = "draggable" class = "ui-widget-content">
				<div>
					<p>Application Name</p>
				</div>
				<div>
					<div id = "userlist">
						<div>
							<div>
								<div id = "list0">UserName</div>
								<div id = "list0">First name</div>
								<div id = "list0">Last name</div>
								<div id = "list0">Address</div>
								<div style = "clear:both;"></div>
							</div>			
							
							<?php // listaa käyttäjät
							for ($i = 0; $i < $count; $i++) $users[$i]->PrintInfo2($i); ?>
							
						</div>
						<p>
							<form method = "POST" action = 'refresh.php'>
								<b>Page: <?php echo $curPage ?></b>
								 Jump to Page: <input type = "text" value = <?php echo $curPage ?> name = "2pageNumber" size = "4">
								 Results per page: <input type = "text" value = <?php echo $count ?> name = "resultsPerPage" size = "2">
								<input type = "submit" name = "btnRefresh"  value = "Refresh">
							</form>
						</p>
					</div>
					<div id = "userinfo">
						<div id = "username">
							<b>
							
							<?php // näyttää valitun käyttäjän käyttäjätunnuksen
							$users[$userNum]->PrintUserName();?>
						
							</b>
						</div>
						<div id = "navigatebuttons" style = "float: right;">
							<form method = "POST" action = ''>
								<input type = "submit" name = "btnLower"  value = "<">
								<input align = "right" type = "submit" name = "btnGreater"  value = ">">
							</form>
						</div>
						<div style = 'clear:both;'></div>
						
						<?php // näyttää valitun käyttäjän tiedot
						$users[$userNum]->PrintInfo();?>
						
					</div>
					<div style = "clear:both;"></div>
				</div>
			</div>
		</div>
		<div id = "footer">
			<center>Footer are: Insert copyright statements here</center>
		</div>
	</body>
</html>