<?php

final class LocationType
{
    private function __construct()
    {
    }

    const PublicLocation = 1;
    const PrivateLocation = 2;
    const PrivateVisible = 3;

    public static $Lookup = array(LocationType::PublicLocation => 'Public',
        LocationType::PrivateLocation => 'Private',
        LocationType::PrivateVisible => 'Private but visible'
    );
}