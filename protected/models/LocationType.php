<?php

final class LocationType
{
    private function __construct()
    {
    }

    const PublicLocation = 1;
    const PrivateLocation = 2;
    const PrivateVisible = 3;

    public static $Lookup = array(PublicLocation => 'Public',
        PrivateLocation => 'Private',
        PrivateVisible => 'Private but visible'
    );
}