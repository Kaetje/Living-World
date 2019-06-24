<?php

require_once "functions.php";
require_once "database.php";

$characters = getcharacters();
echo outputFullTable($characters);

function outputFullTable($characters)
{
    $str = outputHeader();
    $blocks = outputAllCharBlocks($characters);
    if ($blocks) {
        $str .= "|-\n" . $blocks;
    }
    $str .= '|}';
    return $str;
}

function outputHeader()
{
    $parts = [
        '{| class="wikitable sortable"',
        '!character',
        '!player',
        '!race',
        '!level',
        '!status',
        '!xp',
    ];
    return implode("\n", $parts);
}

function outputAllCharBlocks($characters)
{
    $parts = [];
    foreach ($characters as $character) {
        $parts[] = outputCharBlock($character);
    }
    return implode("|-\n", $parts);
}

function outputCharBlock($character)
{
    $parts = [
        '|[[' . $character['charname'] . ']]',
        '|' . $character['player'],
        '|' . $character['race'],
        '|' . $character['class'] . ' ' . calculateLevel($character['XP']),
        '|' . $character['status'],
        '|' . $character['XP']
    ];
    return implode("\n", $parts);
}