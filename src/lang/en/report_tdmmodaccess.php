<?php

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
