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

$capabilities = array(

    /*
     * View the activity access report for a course.
     */
    'report/tdmmodaccess:view' => array(
        'captype'     => 'read',
        'riskbitmask' => RISK_PERSONAL,

        'contextlevel' => CONTEXT_COURSE,

        'archetypes' => array(
            'teacher'        => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager'        => CAP_ALLOW,
        ),

        'clonepermissionsfrom' => 'coursereport/completion:view',
    ),

);
