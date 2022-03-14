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
 * @package     local_guestinfo
 * @author        kumkumia Habiba
 * @license    
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_guestinfo';

$plugin->version = 2021051709;       // The current module version (Date: YYYYMMDDXX).
$plugin->requires = 2021051100;    // Requires this Moodle version.
$maturity = MATURITY_STABLE;             // This version's maturity level.
