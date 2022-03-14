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
 * @package    local_plugin (guestinfo)
 * @outhor      Kumkumia Habiba
 * @license
 */

//global $CFG;

require_once($CFG->dirroot.'/local/guestinfo/classes/form/edit.php');
//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class download extends moodleform {
   
    
    /*Add elements to form*/
    public function definition() {
        global $CFG,$DB;

       
         $options=array(
           0=> 'Microsoft Excel (.xlsx)' ,
           1=> 'HTML table' ,
           2=> 'Javascript Object Notation (.json)',
           3=> 'OpenDocument (.ods)',
           4=> 'Portable Document Format (.pdf)',
         );
         
         
        $mform = $this->_form;
        $mform->addElement('select', 'getoptions', get_string('getoption', 'local_guestinfo'), $options);
        
       // $mform->addElement('button', 'download', get_string('getguestinfo', 'local_guestinfo'));
       $this->add_action_buttons(true,get_string('getguestinfo', 'local_guestinfo'));

    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}