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
global $temp;

global $DB;
require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/local/guestinfo/classes/form/download.php');



$PAGE->set_url(new moodle_url('/local/guestinfo/view.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('guest table');

$sql = "SELECT {customcert_guestinfo}.id,{course}.fullname, {customcert_guestinfo}.guestname,{customcert_guestinfo}.guestage,{customcert_guestinfo}.guestschool,{customcert_guestinfo}.guestemail FROM {course}  JOIN {customcert_guestinfo} ON {course}.id = {customcert_guestinfo}.course";
$guest_data=$DB->get_records_sql($sql);

$temp=(object)[
     'guest_data'=>array_values($guest_data),
 ];

$mform = new download();
$options=array(
    0=> 'Microsoft Excel (.xlsx)' ,
    1=> 'HTML table' ,
    2=> 'Javascript Object Notation (.json)',
    3=> 'OpenDocument (.ods)',
    4=> 'Portable Document Format (.pdf)',
  );
  

 $linkname = get_string('getguestinfo', 'local_guestinfo');
 $link = new moodle_url('/local/guestinfo/view.php', array( 'downloadown' => true));
 $nform= new edit();
 $fromform = $nform->get_data();
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    $record = new stdClass();
    $record->fullname = $fromform->selectcourses;
    
var_dump($record);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname','local_guestinfo'));
 
echo $OUTPUT->render_from_template('local_guestinfo/table', $temp);
//echo "<button type='submit' class='btn btn-primary' style='margin-left: 10px ; margin-top: 10px'><a class='m-b-1' target='_blank'  href= $link style='color:white'>$linkname</a></button>";
$mform->display();
echo $OUTPUT->footer();