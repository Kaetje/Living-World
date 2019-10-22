<?php

require_once "autoload.php";
#require_once "database.php";

#$characters = getcharacters();

$database = new database();
$CharacterRepository = new CharacterRepository($database);
$characters = $CharacterRepository->getcharacters();

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

function outputCharBlock(Character $character)
{
    $parts = [
        '|[[' . $character->getCharname() . ']]',
        '|' . $character->getPlayerName(),
        '|' . $character->getRace(),
        '|' . $character->getClass() . ' ' . $character->getLevel(),
        '|' . $character->getStatus(),
        '|' . $character->getXP()
    ];
    return implode("\n", $parts) . "\n";
}