<?php 
/**
 * Barchart Test
 * @author karlsteltenpohl
 */

// -- Report All Errors, We Are Very Strict
error_reporting(E_ALL);                 

// --  Data Layer
class db {
  
  var $db_host                     = 'localhost';
  var $db_name                     = 'barchart';
  var $db_user                     = 'barchart';
  var $db_pass                     = 'Barchart1';
  
  function __construct() {
    $this->dbConnect();
  }
  
  function dbConnect() {
    // Connect to the Database
    mysql_connect($this->db_host, $this->db_user, $this->db_pass);
    mysql_select_db($this->db_name);
    unset($this->db_pass);
    return true;
  }
  
  function dbQuery($query) {
    $queried = mysql_query($query);
    if(mysql_error()){
      echo mysql_error();
    }
    return $queried;
  }
  
}

// -- The Calendar / Notes Class
class calendar_notes {
  
  // -- Defaults Variables
  var $days_of_week = array('S','M','T','W','T','F','S');
  var $month;
  var $year;
  
  // -- constructor
  function __construct(){
    $this->month = date('m')-1;
    $this->year = date('Y');
    echo $this->build_calendar();
  }
  
  // -- Build the calendar
  function build_calendar(){
    // Create array containing abbreviations of days of week.
    $days_of_week = array('S','M','T','W','T','F','S');
    $first_day = mktime(0,0,0,$this->month,1,$this->year);
    $first_day_of_week = date('N', $first_day);
    $days_in_month = date('t',$first_day);
    $date_info = getdate($first_day);
    
    echo "<pre>";
    var_dump($date_info);
    echo "</pre>";
    
    $output = "First Day: " . $first_day . " | First Day of Week: " . $first_day_of_week . " | Days in Month: " .$days_in_month . "";
    $output .= "<h1>".$date_info['month']."</h1>";
    $output .= "<div id='calendar-wrapper'><table id='calendar'>";
    $output .= "  <tr>";
    
    // -- Header
    foreach($days_of_week as $day) {
      $output .= "  <th>$day</th>";
    }
    
    
    $output .= "  </tr><tr>";
    
    
    $day = 1;
    $i = 0;
    while($day <= $days_in_month){
      $i++;
      
      // -- Make sure the first day of the month is on the right day of the week
      if($first_day_of_week > 0){
        $output .= "<td>&nbsp;</td>";
        $first_day_of_week--;
        continue;
      }
      
      // -- A Day...
      $this_day = mktime(0,0,$day,$this->month,$this->year);
      $date = date('m/d/y', $this_day);
      
      $output .= "<td><div><span>" . $date . "</span><br><input val=''/></div></td>";
      
      // Weekly Rows
      if(!($i%7)){
        $output .= "  </tr><tr>";
      }
      $day++; 
    }
    
    
    
    $output .= "</tr></table></div>";
    
    return $output;
  }
  
  
}


$db = new db;

?>
<!doctype html>
<html>
  <head>
	
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	  <title>Barchart Calendar Test</title>
		
		<style>
		  #calendar-wrapper{
		    margin:100px auto;
		    width:600px;
		  }
		  
		  input{
		    width:50px;
		  }
		  
		  td{
		    border:1px solid #ddd;
		  }
		</style>
		
		<script>
		
		</script>
  </head>
	<body>
	  <?php 
	    $calendar = new calendar_notes;
	  ?>
	</body>
</html>