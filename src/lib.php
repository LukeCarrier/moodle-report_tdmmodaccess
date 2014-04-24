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

/**
 * Add report to the course navigation.
 *
 * @param navigation_node $navigation The navigation node to extend.
 * @param stdClass        $course     Course record object from DML API.
 * @param context_course  $context    Course context instance.
 */
function report_tdmmodaccess_extend_navigation_course($navigation, $course, $context) {
    if (has_capability('report/tdmmodaccess:view', $context)) {
        $url = new moodle_url('/report/tdmmodaccess/index.php', array(
            'course' => $course->id,
        ));

        $navigation->add(get_string('modaccess', 'report_tdmmodaccess'), $url, navigation_node::TYPE_SETTING, null,
                         null, new pix_icon('i/report', ''));
    }
}
