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
 * No course modules are available to report upon.
 */
class report_tdmmodaccess_no_cms_exception extends moodle_exception {
    /**
     * Initialiser.
     */
    public function __construct() {
        parent::__construct('nocms', 'report_tdmmodaccess');
    }
}
