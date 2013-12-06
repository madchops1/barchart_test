<?php 
// -- The Calendar / Notes Class
class calendar_notes {

  // -- Defaults Variables
  var $days_of_week = array('S','M','T','W','T','F','S');
  var $month;
  var $year;
  var $db;

  // -- constructor
  function __construct(){
    $this->month = date('m')+1;
    $this->year = date('Y');
  }

  // -- Build the calendar
  function build_calendar(){
    // Create array containing abbreviations of days of week.
    $days_of_week = array('S','M','T','W','T','F','S');
    $first_day = mktime(0,0,0,$this->month,1,$this->year);
    $first_day_of_week = date('N', $first_day);
    $days_in_month = date('t',$first_day);
    $date_info = getdate($first_day);

    //echo "<pre>";
    //var_dump($date_info);
    //echo "</pre>";
    $output = "";
    $output = "First Day: " . $first_day . " | First Day of Week: " . $first_day_of_week . " | Days in Month: " .$days_in_month . "";
    $output .= "<div id='calendar-wrapper'>";
    $output .= "<h1>".$date_info['month']."</h1>";
    $output .= "<form action='' method='post'>";
    $output .= "<table id='calendar' cellspacing='0' cellpadding='0'>";
    $output .= "  <tr>";

    // -- Header
    foreach($days_of_week as $day) {
      $output .= "  <th>$day</th>";
    }

    $output .= "  </tr><tr>";

    // -- Loop through the days of the month
    $day = 1;
    $i = 0;
    while($day <= $days_in_month){
      $i++;

      // -- Make sure the first day of the month is on the right day of the week
      if($first_day_of_week > 0 && $first_day_of_week < 7){
        $output .= "<td>&nbsp;</td>";
        $first_day_of_week--;
        continue;
      }

      // -- A Day...
      $this_day = mktime(0,0,0,$this->month,$day,$this->year);
      $date = date('m/d/y', $this_day);
      $notes = $this->get_notes($this_day);
      
      $notes_html = "";
      foreach($notes as $note){
        $notes_html .= "<br>".$note;
      }
      
      $output .= "<td><div><span>" . $date . "</span>".$notes_html."<br><input name='day[]' value='please enter a note'/></div></td>";

      // -- Weekly Rows
      if(!($i%7)){
        $output .= "  </tr><tr>";
      }
      $day++;
    }

    $output .= "</tr></table>";
    $output .= "<input type='hidden' name='month' value='" . $this->month . "' />";
    $output .= "<input type='hidden' name='year' value='" . $this->year . "' />";
    $output .= "<input type='submit' value='Save &amp; Display' />";
    $output .= "</form></div>";
    return $output;
  }

  // -- Save Notes
  function save_notes(){
    if(isset($_POST['day'])){
      $day=1;
      foreach($_POST['day'] as $note){
        if($note != '' && $note != 'please enter a note'){
          // -- Insert
          $date = mktime(0,0,0,$this->month,$day,$this->year);
          $date = date('Y-m-d', $date);
          $insert = "INSERT INTO `calendar` SET date='".$date."', note='".mysql_real_escape_string($note)."' ";
          $this->db->db_query($insert);
        }
      }
    }
  }
  
  function get_notes($date){
    $notes = array();
    $date = date('Y-m-d',$date);
    $select = "SELECT `note` FROM `calendar` WHERE date='".$date."'";
    $result = $this->db->db_query($select);
    while($note = mysql_fetch_object($result)){
      $notes[] = $note->note;
    } 
    return $notes;
  }
  
}
?>