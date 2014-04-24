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
 * User->section completion iterator.
 *
 * Iterates over users, retrieving their completion/access data on request.
 */
class report_tdmmodaccess_user_section_completion_iterator implements Iterator {
    /**
     * Course context.
     *
     * @var context_course
     */
    protected $context;

    /**
     * Course.
     *
     * @var course_modinfo
     */
    protected $course;

    /**
     * Record set.
     *
     * @var stdClass[]
     */
    protected $records;

    /**
     * Course section.
     *
     * @var section_info
     */
    protected $section;

    /**
     * Initialiser.
     *
     * @param context_course $context The course context.
     * @param course_modinfo $course  Course information.
     * @param section_info   $section Section infomation.
     */
    public function __construct($context, $course, $section) {
        $this->context = $context;
        $this->course  = $course;
        $this->section = $section;

        $this->records = get_enrolled_users($context);
    }

    /**
     * Return the enrolled user and associated completion information.
     *
     * @return report_tdmmodaccess_user_section_completion The completion information.
     */
    public function current() {
        $user = current($this->records);

        return new report_tdmmodaccess_user_section_completion($user, $this->course, $this->section);
    }

    /**
     * Get the current user key.
     *
     * @return integer The key of the current user record within the recordset.
     */
    public function key() {
        return key($this->records);
    }

    /**
     * Skip to the next record.
     *
     * @return void
     */
    public function next() {
        next($this->records);
    }

    /**
     * Rewind to the beginning of the record set.
     *
     * @return void
     */
    public function rewind() {
        reset($this->records);
    }

    /**
     * Does the iterator still have records remaining?
     *
     * @return boolean True if records remain, else false.
     */
    public function valid() {
        return current($this->records) !== false;
    }
}
