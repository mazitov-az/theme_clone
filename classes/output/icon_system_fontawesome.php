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
 * Overridden fontawesome icons.
 *
 * @package    theme_clone
 * @copyright  2024 Mazitov Artem
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types=1);

namespace theme_clone\output;

class icon_system_fontawesome extends \core\output\icon_system_fontawesome
{
    /**
     * Change the core icon map.
     *
     * @return array replaced icons.
     */
    public function get_core_icon_map(): array
    {
        $iconmap = parent::get_core_icon_map();

        $iconmap['core:i/navigationitem'] = 'fa-square';

        return $iconmap;
    }
}
