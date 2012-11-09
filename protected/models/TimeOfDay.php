<?php

final class TimeOfDay
{
    private function __construct()
    {
    }

    const NotAvailable = 1;
    const Daytime = 2;
    const Evening = 3;
    const AllDay = 4;

    public static $Lookup = array(NotAvailable => 'NotAvailable',
        Daytime => 'Daytime',
        Evening => 'Evening',
        AllDay => 'All day'
    );
}