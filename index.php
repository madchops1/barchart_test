<?php 
/**
 * Barchart Test
 * @author karlsteltenpohl
 */
error_reporting(E_ALL);                 
include 'includes/db.class.php';
include 'includes/calendar.class.php';
$db = new db;
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
	    $calendar = new calendar_notes;
	  ?>
	</body>
</html>