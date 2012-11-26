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

    public static $Lookup = array(DayOfWeek::Sunday => 'Sunday',
        DayOfWeek::Monday => 'Monday',
        DayOfWeek::Tuesday => 'Tuesday',
        DayOfWeek::Wednesday => 'Wednesday',
        DayOfWeek::Thursday => 'Thursday',
        DayOfWeek::Friday => 'Friday',
        DayOfWeek::Saturday => 'Saturday'
    );
}