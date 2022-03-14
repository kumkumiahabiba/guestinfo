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


global $CFG;

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
   
    protected $data;
    /**
    * constructor.
     */
    public function __construct($actionurl = null, $data = null)
    {
        $this->data= $data;
        parent::__construct($actionurl);
    }

    /*Add elements to form*/
    public function definition() {
        global $CFG,$DB;

        $sql = "SELECT id, fullname FROM {course} ";
        $db=$DB->get_records_sql($sql);
         $choice=array();
         foreach($db as $d){
             $choice[$d->id]=$d->fullname;
         }
         
        $mform = $this->_form;
        $mform->addElement('select', 'selectcourses', get_string('selectcourse', 'local_guestinfo'), $choice);
        
        //$mform->addElement('button', 'selectAll', 'All');


        //$mform->addElement('button', 'next', get_string('buttonlabel','local_guestinfo'));
        $this->add_action_buttons(true,get_string('buttonlabel', 'local_guestinfo'));
        


       // $mform->addElement('select', 'fullname',  'get_string('selectcourse', 'local_guestinfo'), $DB->get_records_menu('course', array(), 'id,format'));
        
        //$this->add_action_buttons();
    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}