<?php
// This file is part of the customcert module for Moodle - http://moodle.org/
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
 * Customcert module core interaction API
 *
 * @package    local_guestinfro
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');


function local_guestinfo_extends_settings_navigation(settings_navigation $navigation, $context) {
    global $CFG;
    // If not in a course context, then leave.
    if ($context == null || $context->contextlevel != CONTEXT_COURSE) {
        return;
    }

    // Front page has a 'frontpagesettings' node, other courses will have 'courseadmin' node.
    if (null == ($courseadminnode = $navigation->get('courseadmin'))) {
        // Keeps us off the front page.
        return;
    }
    if (null == ($useradminnode = $courseadminnode->get('report'))) {
        return;
    }


            $useradminnode->add(get_string('test local'), '$url',
                navigation_node::TYPE_SETTING, null, 'massunenrols', new pix_icon('i/admin', ''));

}

    