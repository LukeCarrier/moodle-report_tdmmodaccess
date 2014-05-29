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

require_once dirname(dirname(__DIR__)) . '/config.php';
require_once __DIR__ . '/lib.php';

$course  = required_param('course',     PARAM_INT);
$section = optional_param('section', 0, PARAM_INT);

$url = new moodle_url('/report/tdmmodaccess/index.php', array(
    'course'  => $course,
));

$course = $DB->get_record('course', array(
    'id' => $course,
), '*', MUST_EXIST);

$context = context_course::instance($course->id);
require_login($course);
require_capability('report/tdmmodaccess:view', $context);

$coursemodinfo = get_fast_modinfo($course);
$section       = $coursemodinfo->get_section_info($section);

$sectionlist = array();
foreach ($coursemodinfo->get_section_info_all() as $sectioninfo) {
    $sectionlist[$sectioninfo->section] = $sectioninfo->name ?: get_string('section', 'report_tdmmodaccess',
                                                                           $sectioninfo->section);
}

$title = get_string('modaccessfor', 'report_tdmmodaccess', (object) array(
    'coursefullname' => $course->fullname,
    'sectionname'    => $sectionlist[$section->section],
));

$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_pagelayout('admin');
$PAGE->requires->css('/report/tdmmodaccess/style.css');

$profilebaseurl = new moodle_url('/user/profile.php', array(
    'course' => $course->id,
));
$participationbaseurl = new moodle_url('/report/participation/index.php', array(
    'id'       => $course->id,
    'timefrom' => '',
    'roleid'   => 5,
    'action'   => '',
));

$table = new html_table();
$table->head = array(
    get_string('user'),
);

if (array_key_exists($section->section, $coursemodinfo->sections)) {
    foreach ($coursemodinfo->sections[$section->section] as $coursemoduleid) {
        $coursemodule     = $coursemodinfo->cms[$coursemoduleid];
        $participationurl = $participationbaseurl->out(false, array(
            'instanceid' => $coursemodule->id,
        ));

        $table->head[] = html_writer::link($participationurl, $coursemodule->name);
    }
}

$changesection = new single_select($PAGE->url, 'section', $sectionlist, $section->section);
$changesection->attributes = array(
    'class' => 'change-section',
);

$table->data    = array();
$usercompletion = new report_tdmmodaccess_user_section_completion_iterator($context, $coursemodinfo, $section);

try {
    foreach ($usercompletion as $record) {
        $user       = $record->get_user();
        $profileurl = $profilebaseurl->out(false, array(
            'id' => $user->id,
        ));

        $row = array(
            html_writer::link($profileurl, fullname($user)),
        );

        foreach ($record->get_completion() as $cmcompletion) {
            $row[] = $cmcompletion->actioncount;
        }

        $table->data[] = $row;
    }
} catch (report_tdmmodaccess_no_cms_exception $e) {
    $cell = new html_table_cell($e->getMessage());
    $cell->colspan = count($table->head);
    $table->data[] = array($cell);
}

echo $OUTPUT->header(),
     $OUTPUT->heading($title),
     html_writer::tag('p', get_string('changesection', 'report_tdmmodaccess'), array(
         'class' => 'change-section-desc',
     )),
     $OUTPUT->render($changesection),
     html_writer::tag('div', '', array(
        'class' => 'clearfix',
    )),
     html_writer::table($table),
     $OUTPUT->footer();
