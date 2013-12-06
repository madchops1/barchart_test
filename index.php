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
    $this->month = date('m');
    $this->year = date('Y');
    echo $this->build_calendar();
  }
  
  // -- Build the calendar
  function build_calendar(){
    // Create array containing abbreviations of days of week.
    $days_of_week = array('S','M','T','W','T','F','S');
    $first_day = mktime(0,0,0,$month,1,$year);
    $days_in_month = date('t',$first_day);
    $date_info = getdate($first_day);
    
    
    
    $output = "First Day: " . $first_day . " | Days in Month: " .$days_in_month . "";
    $output .= "<h1>".$date_info['month']."</h1>";
    $output .= "<table id='calendar'>";
    $output .= "  <tr>";
    
    // -- Header
    foreach($days_of_week as $day) {
      $output .= "  <th>$day</th>";
    }
    
    
    $output .= "  </tr><tr>";
    
    
    $day = 1;
    while($day <= $days_in_month){
      
      // Days
      $output .= "<td><div><span>" . $day . "</span></div></td>";
      
      // Weekly Rows
      if(!(($day-1)%7)){
        $output .= "  </tr><tr>";
      }
      $day++; 
    }
    
    
    
    $output .= "</tr></table>";
    /*
    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    
    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);
    
    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);
    
    // What is the name of the month in question?
    $monthName = $dateComponents['month'];
    
    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];
    
    // Create the table tag opener and day headers
    
    
    //$output .= "<caption>$monthName $year</caption>";
    $output .= "<tr>";
    
    // Create the calendar headers
    
    foreach($daysOfWeek as $day) {
      $output .= "<th class='header'>$day</th>";
    }
    
    // Create the rest of the calendar
    
    // Initiate the day counter, starting with the 1st.
    
    $currentDay = 1;
    
    $output .= "</tr><tr>";
    
    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.
    
    if ($dayOfWeek > 0) {
      $output .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
    }
     
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    
    while ($currentDay <= $numberDays) {
    
    // Seventh column (Saturday) reached. Start a new row.
    
      if ($dayOfWeek == 7) {
    
      $dayOfWeek = 0;
      $output .= "</tr><tr>";
    
      }
    
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
    
        $date = "$year-$month-$currentDayRel";
    
        $output .= "<td class='day' rel='$date'>$currentDay</td>";
    
        // Increment counters
    
        $currentDay++;
        $dayOfWeek++;
    
    }
     
     
    
    // Complete the row of the last week in month, if necessary
    
        if ($dayOfWeek != 7) {
         
        $remainingDays = 7 - $dayOfWeek;
        $output .= "<td colspan='$remainingDays'>&nbsp;</td>";
    
    }
     
    $output .= "</tr>";
    
    $output .= "</table>";
    */  
    return $output;
  }
  
  
}


$db = new db;
$calendar = new calendar_notes;

?>