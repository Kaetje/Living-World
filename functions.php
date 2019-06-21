<?php

function calculateLevel($XP){
    if($XP<300){return 1;}
    if($XP<900){return 2;}
    if($XP<2700){return 3;}
    if($XP<6500){return 4;}
    if($XP<14000){return 5;}
}

