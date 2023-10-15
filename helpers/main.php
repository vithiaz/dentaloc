<?php


function getHoursMinutes ($timeStr) {
    return substr($timeStr, 0, -3);
}

function convertDateFormat($dateTimeString, $format) {
    $timestamp = strtotime($dateTimeString);

    if ($timestamp !== false) {
        $newFormat = date($format, $timestamp);
        return $newFormat;
    }

    return null;
}
