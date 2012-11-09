<?php

final class DayOfWeek
{
    private function __construct()
    {
    }

    const Sunday = 1;
    const Monday = 2;
    const Tuesday = 3;
    const Wednesday = 4;
    const Thursday = 5;
    const Friday = 6;
    const Saturday = 7;

    public static $Lookup = array(Sunday => 'Sunday',
        Monday => 'Monday',
        Tuesday => 'Tuesday',
        Wednesday => 'Wednesday',
        Thursday => 'Thursday',
        Friday => 'Friday',
        Saturday => 'Saturday'
    );
}