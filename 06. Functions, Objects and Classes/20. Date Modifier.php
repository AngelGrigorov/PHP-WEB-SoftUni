<?php
class DateModifier
{
    function getDifferenceBetweenDates(string $firstDate, string $secondDate): string
    {
        $start = strtotime(str_replace(" ", "-", $firstDate));
        $end = strtotime(str_replace(" ", "-", $secondDate));
        return ceil(abs($end - $start) / 86400);
    }
}
$firstDate = readline();
$secondDate = readline();
$date = new DateModifier();
echo $date->getDifferenceBetweenDates($firstDate, $secondDate);
