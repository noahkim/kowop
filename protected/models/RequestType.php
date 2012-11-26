<?php

final class RequestType
{
    private function __construct()
    {
    }

    const Online = 1;
    const Physical = 2;
    const NoPreference = 3;

    public static $Lookup = array(RequestType::Online => 'Online',
        RequestType::Physical => 'Physical',
        RequestType::NoPreference => 'NoPreference'
    );
}
