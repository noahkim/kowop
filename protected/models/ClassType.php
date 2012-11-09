<?php

final class ClassType
{
    private function __construct()
    {
    }

    const Online = 1;
    const Physical = 2;

    public static $Lookup = array(Online => 'Online',
        Physical => 'Physical'
    );
}
