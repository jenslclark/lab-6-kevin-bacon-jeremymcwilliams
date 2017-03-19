<?php

/* page elements */

function pageHeader(){
			?>
			<div id="banner">
				<a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>
			<?php

}

function pageFooter(){
			?>
			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
			<?php


}

function forms(){
				?>
				<!-- form to search for every movie by a given actor -->
				<form action="search-all.php" method="get">
					<fieldset>
						<legend>All movies</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>

				<!-- form to search for movies where a given actor was with Kevin Bacon -->
				<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>
				<?php

}




function dbConnect(){
	/*** connection credentials *******/
	$servername = "www.watzekdi.net";
	$username = "watzekdi_cs393";
	$password = "KevinBac0n";
	$database = "watzekdi_imdb";
	$dbport = 3306;


	/****** connect to database **************/

	try {
		$db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8;port=$dbport", $username, $password);
	}
		catch(PDOException $e) {
		echo $e->getMessage();
	} 
	
	return $db;

}




?>
