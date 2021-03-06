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

function formatTable($rows){
	$c=1;
	$table="<table>";
	$table.="<thead><td>#</td><td>Name</td><td>Year</td></thead>\n";
	foreach ($rows as $row){
		
		$name=$row["name"];
		$year=$row["year"];
		$table.="<tr><td>$c</td><td>$name</td><td>$year</td></tr>\n";
		$c++;
		
		
	}
	
	$table.="</table>";
	return $table;
	
	
}


/*  database functions  */


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


function getActorId($firstname, $lastname, $db){

	try { 
		$stmt = $db->prepare("SELECT * FROM actors WHERE first_name like :firstName and last_name=:lastName order by film_count desc limit 1" );
		$data=array(":firstName"=>"$firstname%", ":lastName"=>$lastname);
		$stmt->execute($data);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	//	var_dump($rows);
		$id=$rows[0]["id"];
		return $id;

	} catch (Exception $e) {
		return false;
	}	

}


function getMoviesByActorID($db, $actor_id){
	
	try { 
		$stmt = $db->prepare("select movies.name, movies.year from movies, roles where roles.actor_id=:actor_id and roles.movie_id=movies.id order by movies.year desc" );
		$data=array(":actor_id"=>$actor_id);
		$stmt->execute($data);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		//var_dump($rows);
		return $rows;


	} catch (Exception $e) {
		return false;
	}	
	
	
	
}


function getBacon($db, $actor_id){


	try { 
		$stmt = $db->prepare("select movies.name, movies.year from movies, roles where roles.actor_id=:actor_id and roles.movie_id=movies.id and movies.id in (select movies.id from movies, roles, actors where actors.last_name='Bacon' and actors.first_name='Kevin' and actors.id=roles.actor_id and roles.movie_id=movies.id) order by movies.year desc;
" );
		$data=array(":actor_id"=>$actor_id);
		$stmt->execute($data);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		var_dump($rows);
		
		return $rows;


	} catch (Exception $e) {
		return false;
	}


/*

reform into join

select movies.name, movies.year from movies, roles where roles.actor_id=$actor_id and roles.movie_id=movies.id and movies.id in (select movies.id from movies, roles, actors where actors.last_name='Bacon' and actors.first_name='Kevin' and actors.id=roles.actor_id and roles.movie_id=movies.id);

*/





}


function getActorByName($db, $firstName, $lastName){ 

try { 
$stmt = $db->prepare("SELECT * FROM actors WHERE first_name=:firstName and last_name=:lastName");
$data=array(":firstName"=>$firstName, ":lastName"=>$lastName);
$stmt->execute($data);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
//var_dump($rows);

return $rows;

} catch (Exception $e) {
return false;
}	

}




?>
