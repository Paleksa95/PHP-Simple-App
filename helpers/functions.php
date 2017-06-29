<?php


/**
 * formatDate function is used to reformat date from database.
 *
 * @param $date
 * @return bool|string
 *
 */

function formatDate($date)
{
    return date('F j, Y, g:i a', strtotime($date));
}

/**
 * e function is used to escape all problematic data.
 *
 * @param $data
 * @return string
 *
 */

function e($data)
{
    return htmlspecialchars($data, ENT_QUOTES , 'UTF-8');
}

























