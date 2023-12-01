<?php

declare(strict_types=1);

namespace AOC2022\Day07;

use function PHPUnit\Framework\matches;

class Part1
{
    public function __invoke(string $input): int
    {
        $instructions = explode(PHP_EOL, trim($input));

        $currentDirectory = '/';
        $filesystem = [];

        foreach ($instructions as $instruction) {
            if (str_starts_with($instruction, '$ ')) {
                if (str_starts_with($instruction, '$ cd ')) {
                    $directory = substr($instruction, strlen('$ cd '));
                    $currentDirectory = match($directory) {
                        '/' => '/',
                        '..' => substr($currentDirectory, 0, -strrpos($currentDirectory, '/') - 1),
                        default =>  $currentDirectory . $directory . '/'
                    };

                    $currentDirectory = '/' . ltrim($currentDirectory, '/');
                }
                // ls -> do nothing
            } elseif (str_starts_with($instruction, 'dir ')) {
//                $filesystem[$currentDirectory][] = ['type' => 'directory', 'name' => substr($instruction, strlen('dir '))];
                // the current directory contains a file
            } else {
                // a file
                sscanf($instruction, "%d %s", $size, $filename);

                $filesystem[$currentDirectory][$filename] = $size;
            }
        }
var_dump($filesystem);
        return 0;
    }
}
