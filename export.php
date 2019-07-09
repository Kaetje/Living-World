<?php

require_once "functions.php";
require_once "database.php";

$characters = getcharacters();
echo '<pre>';
echo outputFullTable($characters);
echo '</pre>';

function outputFullTable($characters)
{
    $str = '';
    $str .= outputIntro();
    $str .= outputHeader();
    $blocks = outputAllCharBlocks($characters);
    if ($blocks) {
        $str .= "|-\n" . $blocks;
    }
    $str .= '|}';
    return $str;
}

function outputIntro()
{
    return "Dit is het ''officiele'' karakter overzicht. Hier zie je wie er nog in het spel zijn en hoeveel XP die karakters hebben.\n\n";
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
    return implode("\n", $parts) . "\n";
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
    return implode("\n", $parts) . "\n";
}