<?php

function formatDate($data, $format = 'd-m-Y')
{
    return date($format, strtotime($data));
}
