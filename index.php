<?php 
/**
 * Barchart Test
 * @author karlsteltenpohl
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);                 
date_default_timezone_set('America/Chicago');
include 'includes/db.class.php';
include 'includes/calendar.class.php';
$calendar = new calendar_notes;
$calendar->db = new db;
if(isset($_POST)){
  $calendar->save_notes();
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
	    echo $calendar->build_calendar();
	  ?>
	</body>
</html>