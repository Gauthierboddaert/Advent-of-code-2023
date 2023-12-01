<?php

function main(): void
{
    openFile();
}

function openFile(): void
{
    $file = fopen(__DIR__.'/public/puzzle-day-1.txt', 'r');

    if ($file === false) {
        echo 'Error opening file';
        exit;
    }

    processDataFromFile($file);

    fclose($file);
}

function processDataFromFile($file): void {
    $answer = 0;
    while (($line = fgets($file)) !== false) {
        preg_match_all('!\d+!', $line, $matches);
        $answer += checkFileData($matches[0]);
    }

    echo $answer;
}

function checkFileData(array $numbers): int
{
    $result = 0;

    if(count($numbers) === 1) {
        if(str_split($numbers[0]) > 1) {
            return str_split($numbers[0])[0].str_split($numbers[0])[strlen($numbers[0]) - 1];
        }

        return $numbers[0].$numbers[0];
    }

    $firstNumber = $numbers[0];
    $lastNumber = $numbers[count($numbers) - 1];

    if(str_split($firstNumber) > 1) {
        $firstNumber = str_split($firstNumber)[0];
    }

    if(str_split($lastNumber) > 1) {
        $lastNumber = str_split($lastNumber)[strlen($lastNumber) - 1];
    }

    return (int)$firstNumber.$lastNumber;
}

main();
