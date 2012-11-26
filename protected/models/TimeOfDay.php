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

    public static $Lookup = array(TimeOfDay::NotAvailable => 'NotAvailable',
        TimeOfDay::Daytime => 'Daytime',
        TimeOfDay::Evening => 'Evening',
        TimeOfDay::AllDay => 'All day'
    );
}