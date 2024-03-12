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
 * The columns layout for the theme_clone.
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

$bodyAttributes = $OUTPUT->body_attributes();
$blocksPre = $OUTPUT->blocks('side-pre');
$blocksPost = $OUTPUT->blocks('side-post');

$hasSidePre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hasSidePost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$PAGE->set_secondary_navigation(false);
$renderer = $PAGE->get_renderer('core');
$header = $PAGE->activityheader;
$headerContent = $header->export_for_template($renderer);

$templateContext = [
    'sitename' => format_string($SITE->shortname, true, [
        'context' => context_course::instance(SITEID), 'escape' => false
    ]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blocksPre,
    'sidepostblocks' => $blocksPost,
    'haspreblocks' => $hasSidePre,
    'haspostblocks' => $hasSidePost,
    'bodyattributes' => $bodyAttributes,
    'headercontent' => $headerContent,
];

echo $OUTPUT->render_from_template('theme_clone/columns', $templateContext);
