<?php 
/**
 * Barchart Test
 * @author karlsteltenpohl
 */
error_reporting(E_ALL);                 
include 'includes/db.class.php';
include 'includes/calendar.class.php';
$db = new db;
$calendar = new calendar_notes;

if(isset($_POST)){
  $calendar->save_notes;
}

?>
<!doctype html>
<html>
  <head>
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  	<script src="/scripts/scripts.js"></script>
  	<title>Barchart Calendar Test</title>
  	<link rel="stylesheet" href="/styles/styles.css" />
  </head>
	<body>
	  <?php 
	    echo $calendar->buildCalendar;
	  ?>
	</body>
</html>