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
 *
 * @package     theme_clone
 * @category    test
 * @copyright   2024 Mazitov Artem
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types=1);

namespace theme_clone;

use advanced_testcase;
use Symfony\Component\Process\Process;

final class Pix_test extends advanced_testcase
{
    public const EXTENSIONS = [
        'php',
        'mustache',
        'scss',
        'css',
        'js'
    ];

    protected function getPath(): string
    {
        global $CFG;
        return $CFG->dirroot . '/theme/clone/';
    }

    protected function creatCmd(string $name): array
    {
        $cmd = ['grep', '-r'];
        foreach (self::EXTENSIONS as $extension) {
            $cmd[] = '--include=*.' . $extension;
        }
        $cmd[] = $name;
        $cmd[] = $this->getPath();
        return $cmd;
    }

    protected function getImages(): array
    {
        $rootPix = $this->getPath() . '/pix';
        $files = $this->searchFile($rootPix);

        return array_map(fn($name) => pathinfo($name, PATHINFO_FILENAME), $files);
    }

    protected function searchFile($folderName, array $files = []): array
    {
        $dir = opendir($folderName);
        while (($file = readdir($dir)) !== false) {
            if (in_array($file, ['.', '..', 'screenshot.png'])) {
                continue;
            }
            if (is_file($folderName . "/" . $file)) {
                $files[] = $file;
            }
            if (is_dir($folderName . "/" . $file)) {
                $files = $this->searchFile($folderName . "/" . $file, $files);
            }
        }
        closedir($dir);
        return $files;
    }

    public function test_pix_not_use(): void
    {
        $errors = [];

        $images = $this->getImages();

        foreach ($images as $image) {
            $cmd = $this->creatCmd($image);
            $process = new Process($cmd);
            $process->run();
            if (!$process->isSuccessful()) {
                $errors[] = $image;
            }
        }

        $this->assertEmpty($errors, 'Pix not use: ' . PHP_EOL . implode(', ' . PHP_EOL, $errors) . PHP_EOL);
    }
}