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
 * A one column layout for the theme_clone.
 *
 * @package   theme_clone
 * @copyright 2024 Mazitov Artem
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types=1);

defined('MOODLE_INTERNAL') || die();

/**
 * @global core_renderer $OUTPUT
 * @global moodle_page $PAGE
 * @global stdClass $SITE
 */

$bodyAttributes = $OUTPUT->body_attributes([]);

$templateContext = [
    'sitename' => format_string($SITE->shortname, true, [
        'context' => context_course::instance(SITEID), 'escape' => false
    ]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyAttributes
];
if (empty($PAGE->layout_options['noactivityheader'])) {
    $header = $PAGE->activityheader;
    $renderer = $PAGE->get_renderer('core');
    $templateContext['headercontent'] = $header->export_for_template($renderer);
}

echo $OUTPUT->render_from_template('theme_clone/contentonly', $templateContext);

