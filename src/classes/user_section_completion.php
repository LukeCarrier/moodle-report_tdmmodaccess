<?php

/**
 * TDM: Insert module at cursor.
 *
 * @author Luke Carrier <luke@tdm.co>
 * @copyright (c) 2014 The Development Manager Ltd
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Individual completion record.
 */
class report_tdmmodaccess_user_section_completion {
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
SELECT cmid, COUNT(action) AS `count`
FROM {log}
WHERE cmid {$cmsql}
    AND course = :course
    AND userid = :user
GROUP BY cmid
SQL;

        $completion = $DB->get_records_sql($sql, $params);
        if ($completion === false) {
            $competion = array();
        }

        $this->completion = array();
        foreach ($cms as $cm) {
            if (array_key_exists($cm, $completion)) {
                $this->completion[$cm] = $completion[$cm];
            } else {
                $this->completion[$cm] = (object) array(
                    'cmid'  => $cm,
                    'count' => 0,
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
     * @return stdClass[] An array of record objects, each containing cmid and count fields.
     */
    public function get_completion() {
        return $this->completion;
    }
}
