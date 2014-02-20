<?php

/**
 * TDM: Insert module at cursor.
 *
 * @author Luke Carrier <luke@tdm.co>
 * @copyright (c) 2014 The Development Manager Ltd
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
