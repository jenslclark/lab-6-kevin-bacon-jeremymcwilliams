<?php
require_once("common.php");

$firstname=$_REQUEST["firstname"];
$lastname=$_REQUEST["lastname"];

$db=dbConnect();
if ($id=getActorId($firstname, $lastname, $db)){

	$result=$id;

}
else{

	$result="no matches";

}



?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />

		<!-- Link to your CSS file that you should edit -->
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<?php pageHeader();?>

			<div id="main">
				<h1><?= $result?></h1>
				
				
				<?php forms();?>
			</div> <!-- end of #main div -->
			<?php pageFooter(); ?>
		</div> <!-- end of #frame div -->
	</body>
</html>
