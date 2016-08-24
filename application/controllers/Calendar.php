<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*@author  REM
*@email   thedilab@gmail.com
*@website http://www.StarTutorial.com
**/

class Calendar extends CI_Controller{  
     
    /**
     * Constructor
     */
    function __construct(){     
    parent::__construct();
    $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    date_default_timezone_set('Asia/Manila');
}
/********************* PROPERTY ********************/

private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
private $currentYear = 0;
private $currentMonth = 0;
private $currentDay = 0;
private $currentDate = null;
private $daysInMonth = 0;
private $naviHref = null;
/********************* PUBLIC **********************/
/**
** print out the calendar
**/
public function index(){
    $this->show();
   
}

public function event($hash){
    if (isset($_GET['id'])):
        $getdatarow = $this->Tour_m->get_data_woption_row('ternuhan','hash',$hash);
        $this->data['hash']         = $hash;
        $this->data['message']      = $this->session->flashdata('message');
        $this->data['edit_event']    = $this->Tour_m->get_one_data('events', 'hash', $hash);
        $this->data['invested_sum'] = $this->Tour_m->get_sum_data('amounts', 'amount', 'hash', $hash);
        $this->data['invested']     = $this->Tour_m->get_data_woption('amounts', 'hash', $hash);
        $this->data['edit_user']    = $this->Tour_m->get_one_data('ternuhan', 'hash', $hash);
        $this->load->view('ajax2',$this->data);
    
    else:
        $this->data['hash']         = $hash;
        $this->data['message']      = $this->session->flashdata('message');
        $this->data['edit_event']    = $this->Tour_m->get_one_data('events', 'hash', $hash);
        $this->data['invested_sum'] = $this->Tour_m->get_sum_data('amounts', 'amount', 'hash', $hash);
        $this->data['invested']     = $this->Tour_m->get_data_woption('amounts', 'hash', $hash);
        $this->data['edit_user']    = $this->Tour_m->get_one_data('ternuhan', 'hash', $hash);
        $this->load->view('ajax2',$this->data);

    endif;
}

public function show() {
$year = null;
$month = null;
if (null == $year && isset($_GET['year'])) {
$year = $_GET['year'];
} elseif (null == $year) {
$year = date("Y", time());
}
if (null == $month && isset($_GET['month'])) {
$month = $_GET['month'];
} elseif (null == $month) {
$month = date("m", time());
}
$this->currentYear = $year;
$this->currentMonth = $month;
$this->daysInMonth = $this->_daysInMonth($month, $year);
$content = '<div id="calendar">' . "\r\n" . '<div class="box">' . "\r\n" . $this->_createNavi() . "\r\n" . '</div>' . "\r\n" . '<div class="box-content">' . "\r\n" . '<ul class="label">' . "\r\n" . $this->_createLabels() . '</ul>' . "\r\n";
$content .= '<div class="clear"></div>' . "\r\n";
$content .= '<ul class="dates">' . "\r\n";
$weeksInMonth = $this->_weeksInMonth($month, $year);
// Create weeks in a month
for ($i = 0; $i < $weeksInMonth; $i++) {
//Create days in a week
for ($j = 1; $j <= 7; $j++) {
$content .= $this->_showDay($i * 7 + $j);
}
}
$content .= '</ul>' . "\r\n";
$content .= '<div class="clear"></div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";

// echo $content; 

$this->data['title']      = 'Ternuhan System';
$this->data['script_url'] = base_url() . 'cxase/materialize/';
$this->data['page']='calendar';
$this->data['content'] = $content;
$this->load->view('index',$this->data);

}
/********************* PRIVATE **********************/ 
/**
** create the li element for ul
**/
private function _showDay($cellNumber) {

if ($this->currentDay == 0) {
$firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));
if (intval($cellNumber) == intval($firstDayOfTheWeek)) {
$this->currentDay = 1;
}
}
if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {
$this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));
$cellContent = $this->currentDay;
$this->currentDay++;
} else {
$this->currentDate = null;
$cellContent = null;
}
$today_day = date("d");
$today_mon = date("m");
$today_yea = date("Y");
$ids=$this->currentMonth.$cellContent.$today_yea;
$id= substr($ids, 1);
$data=$this->Tour_m->get_all_data('events');
$datas=$this->Tour_m->get_data_woption('events','dateid',$id);



// print_r($data);
if ($datas):
/*echo "<pre>";
print_r($datas[0]['dateid']);
echo "</pre>";*/
$class_event = ($datas == $id ? 'no_event' : 'have_event');
$class_day = ($cellContent == $today_day && $this->currentMonth == $today_mon && $this->currentYear == $today_yea ? "this_today" : "nums_days");
return '<li class="' . $class_day ." " .$class_event. '"><a class="fancybox fancybox.ajax"href="'.base_url('calendar/event')."/".$datas[0]['hash'].'?id='.$datas[0]['dateid'].'" id="'.$id.'">' . $cellContent . '</a></li>' . "\r\n".($class_day=="this_today" ? "<script>alert('Hoy Shit!');</script>" : "");
// print_r($datas);
else:
$class_day = ($cellContent == $today_day && $this->currentMonth == $today_mon && $this->currentYear == $today_yea ? "this_today" : "nums_days");
return '<li class="' . $class_day . '"><a class="fancybox fancybox.ajax"href="'.base_url('calendar/event')."/".$this->functions->random().'?id='.$id.'" id="'.$id.'">' . $cellContent . '</a></li>' . "\r\n".($class_day=="this_today" ? "<script>alert('Sample event Now!');</script>" : "");
endif;


// foreach ($data as $row) {
// echo "<pre>";
// $event = $row['dateid'];
// print_r($event);
// echo "</pre>";
// }

}

    /**
    * create navigation
    */
    private function _createNavi(){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
         
        return
            '<div class="header">'.
                '<a class="prev" href="'.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }
/**
** create calendar week labels
**/
private function _createLabels() {
$content = '';
foreach ($this->dayLabels as $index => $label) {
$content .= '<li class="name_days">' . $label.'</li>' . "\r\n";
}
return $content;
}
/**
** calculate number of weeks in a particular month
**/
private function _weeksInMonth($month = null, $year = null) {
if (null == ($year)) {
$year = date("Y", time());
}
if (null == ($month)) {
$month = date("m", time());
}
// find number of days in this month
$daysInMonths = $this->_daysInMonth($month, $year);
$numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);
$monthEndingDay = date('N',strtotime($year . '-' . $month . '-' . $daysInMonths));
$monthStartDay = date('N',strtotime($year . '-' . $month . '-01'));
if ($monthEndingDay < $monthStartDay) {
$numOfweeks++;
}
return $numOfweeks;
}
/**
** calculate number of days in a particular month
**/
private function _daysInMonth($month = null, $year = null) {
if (null == ($year)) $year = date("Y",time());
if (null == ($month)) $month = date("m",time());
return date('t', strtotime($year . '-' . $month . '-01'));
}
}
?>