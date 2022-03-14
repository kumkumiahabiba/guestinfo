<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * MOODLE VERSION INFORMATION
 *
 * This file defines the current version of the core Moodle code being used.
 * This is compared against the values stored in the database to determine
 * whether upgrades should be performed (see lib/db/*.php)
 *
 * @package    local_guestinfo
 * @outhor     Kumkumia Habiba
 * @license
 */

require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/local/guestinfo/classes/form/edit.php');
require_once($CFG->dirroot.'/local/guestinfo/classes/form/download.php');


global $DB;

$id=optional_param('id',0,PARAM_INT);
$PAGE->set_url(new moodle_url('/local/guestinfo/guestinfo.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('edit page');

//to be passed in the constructor of edit form
$actionurl=new moodle_url('/local/guestinfo/guestinfo.php');
if($id){
    $selectcourses=$DB->get_record('course',array('id'=>$id));
    $mform= new edit($actionurl,$selectcourses);
}
else {
    $mform= new edit($actionurl);
}

$sql = "SELECT id, fullname FROM {course} ";
        $db=$DB->get_records_sql($sql);
         $choice=array();
         foreach($db as $d){
             $choice[$d->id]=$d->fullname;
         }
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    redirect($CFG->wwwroot . '/local/guestinfo/guestinfo.php', 'No course is selected');
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    $record = new stdClass();
    $record->fullname =$choice[$fromform->selectcourses];
    $record->filename=  $record->fullname ."csv"; 
    
 

    //redirect($CFG->wwwroot . '/local/guestinfo/view.php');
}


echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('pluginname','local_guestinfo'));
$mform->display();
echo "<div class='content'><br><br> </div>";
$sql = "SELECT {customcert_guestinfo}.id,{course}.fullname, {customcert_guestinfo}.guestname,{customcert_guestinfo}.guestage,{customcert_guestinfo}.guestschool,{customcert_guestinfo}.guestemail FROM {course}  JOIN {customcert_guestinfo} WHERE {course}.id = {customcert_guestinfo}.course AND {course}.fullname='{$record->fullname}' ";
$guest_data=$DB->get_records_sql($sql);

$temp=(object)[
     'guest_data'=>array_values($guest_data),
 ];
 
 // download form 
 $mform = new download();
$options=array(
    0=> 'Microsoft Excel (.xlsx)' ,
    1=> 'HTML table' ,
    2=> 'Javascript Object Notation (.json)',
    3=> 'OpenDocument (.ods)',
    4=> 'Portable Document Format (.pdf)',
  );

 if($guest_data){
    echo $OUTPUT->render_from_template('local_guestinfo/table', $temp);
     $mform->display();
    echo "<button onclick='exportTableToCSV($record->filename)'> Export HTML table to CSV File </button>";  
 }
 else{
     echo $OUTPUT->heading("Nothing to show") ;
 }


echo $OUTPUT->footer();