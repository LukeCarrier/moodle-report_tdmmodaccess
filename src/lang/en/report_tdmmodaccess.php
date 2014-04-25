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
 * TDM: Course module access report.
 *
 * @package   report_tdmmodaccess
 * @author    Luke Carrier <luke@tdm.co>
 * @copyright (c) 2014 The Development Manager Ltd
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Module metadata
$string['pluginname'] = 'TDM: course module access';

// Capabilities
$string['tdmmodaccess:view'] = 'View activity access report';

// Generic
$string['modaccess']     = 'Activity access';
$string['modaccessfor']  = 'Activity access for {$a->sectionname} in {$a->coursefullname}';
$string['changesection'] = 'Select a section from the list to view its access report';
$string['section']       = 'Section {$a}';

// Errors
$string['nocms'] = 'There are no activities to report upon in the selected course section';
