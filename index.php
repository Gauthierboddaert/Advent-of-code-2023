<?php

const MAX_CUB_RED = 12;
const MAX_CUB_GREEN = 13;
const MAX_CUB_BLUE = 14;

function main(): void
{
    openFile();
}

function openFile(): void
{
    $file = fopen(__DIR__ . '/public/puzzle-day-2.txt', 'r');

    if ($file === false) {
        echo 'Error opening file';
        exit;
    }

    processDataFromFile($file);

    fclose($file);
}

function processDataFromFile($file): void
{
    $answer = [];
    while (($line = fgets($file)) !== false) {
      $answer[] = processingLine($line);
    }

    echo array_sum($answer);
}

function processingLine(string $line): int
{

    preg_match_all('/Game (\d+):/', $line, $game);
    $rounds = explode(';', $line);

    if(isGameRespectTheRules($rounds)) {
        return $game[1][0];
    }

    return 0;
}

function isGameRespectTheRules(array $rounds): bool
{

    foreach ($rounds as $round) {
        preg_match_all('/(\d+)\s*(blue|red|green)/', $round, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            if (!isRulesOfMaxCubesByColorRespected($match[1], $match[2])) {
                return false;
            }
        }
    }

    return true;

}

//var_dump([$sumRedCube => 'red', $sumGreenCube => 'green', $sumBlueCube => 'blue']);

function isRulesOfMaxCubesByColorRespected(int $countOfCube, string $color): bool
{
    switch ($color) {
        case 'red':
            return $countOfCube <= MAX_CUB_RED;
        case 'green':
            return $countOfCube <= MAX_CUB_GREEN;
        case 'blue':
            return $countOfCube <= MAX_CUB_BLUE;
        default:
            return false;
    }
}


main();
