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

/**
 * Individual completion record.
 */
class report_tdmmodaccess_user_section_completion {
    /**
     * Action counts for each course module.
     *
     * @var stdClass[] An array of records, indexed by the course module's ID, each containing cmid and actioncount
     *                 properties.
     */
    protected $completion;

    /**
     * Couse.
     *
     * @var course_modinfo
     */
    protected $course;

    /**
     * Course section.
     *
     * @var section_info
     */
    protected $section;

    /**
     * User.
     *
     * @var stdClass
     */
    protected $user;

    /**
     * Initialiser.
     *
     * @param stdClass       $user    User record object from the DML API.
     * @param course_modinfo $course  Course information object, likely from get_fast_modinfo().
     * @param section_info   $section Section information object, likely from get_fast_modinfo().
     */
    public function __construct($user, $course, $section) {
        global $DB;

        $this->user    = $user;
        $this->course  = $course;
        $this->section = $section;

        $cms = array_key_exists($this->section->section, $this->course->sections)
                ? $this->course->sections[$this->section->section] : array();
        if (count($cms) === 0) {
            throw new report_tdmmodaccess_no_cms_exception();
        }
        list($cmsql, $params) = $DB->get_in_or_equal($cms, SQL_PARAMS_NAMED, 'cm');

        $params['course'] = $this->course->courseid;
        $params['user']   = $this->user->id;

        $sql = <<<SQL
SELECT cmid, COUNT(action) AS actioncount
FROM {log}
WHERE cmid {$cmsql}
    AND course = :course
    AND userid = :user
GROUP BY cmid
SQL;

        $completion = $DB->get_records_sql($sql, $params);
        if ($completion === false) {
            $completion = array();
        }

        $this->completion = array();
        foreach ($cms as $cm) {
            if (array_key_exists($cm, $completion)) {
                $this->completion[$cm] = $completion[$cm];
            } else {
                $this->completion[$cm] = (object) array(
                    'cmid'        => $cm,
                    'actioncount' => 0,
                );
            }
        }
    }

    /**
     * Get the user record object.
     *
     * @return stdClass The user record object from the DML API.
     */
    public function get_user() {
        return $this->user;
    }

    /**
     * Get the completion object.
     *
     * @return stdClass[] An array of record objects, each containing cmid and actioncount fields.
     */
    public function get_completion() {
        return $this->completion;
    }
}
