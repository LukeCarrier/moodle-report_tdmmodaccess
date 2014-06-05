Activity access report (participation at section level)
=======================================================

This Moodle plugin provides a participation report tailored to course sections as opposed to individual activities. It
provides a light integration with the existing participation report to enable teachers to drill down further.


[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LukeCarrier/moodle-report_tdmmodaccess/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LukeCarrier/moodle-report_tdmmodaccess/?branch=master)

License
-------

    Copyright (c) The Development Manager Ltd
    
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

Requirements
------------

* Moodle versions 2.4 through 2.6 (Moodle 2.7 coming very soon)

Building
--------

1. Clone this repository, and ````cd```` into it
2. Execute ````make```` to generate a zip file containing the plugin
3. Upload to the ````moodle.org```` plugins site

Installation
-------------

1. Copy the zip file to your server
2. Extract the zip file and move the ````tdmmodaccess```` directory to your Moodle's ````report```` directory
3. Browse to Site Administration -> Notifications and allow the database upgrades to execute
4. You may need to manually edit the desired teacher/administrator roles to grant them the
   ````report/tdmmodaccess:view```` capability
