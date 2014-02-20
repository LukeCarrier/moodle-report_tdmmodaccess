Activity access report (participation at section level)
=======================================================

This Moodle plugin provides a participation report tailored to course sections as opposed to individual activities. It
provides a light integration with the existing participation report to enable teachers to drill down further.

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

* Quite likely any version of Moodle 2, but has only been tested with 2.6.x

Installation
------------

1. Clone this repository into report/tdmmodaccess
2. Browse to Site Administration -> Notifications and allow the database upgrades to execute
3. You may need to manually edit the desired teacher/administrator roles to grant them the
   ````report/tdmmodaccess:view```` capability.

