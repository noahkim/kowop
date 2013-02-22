<?php

final class UserPosterType
{
    private function __construct()
    {
    }

    const Individual = 1;
    const Business = 2;

    public static $Lookup = array(
        UserPosterType::Individual => 'Individual',
        UserPosterType::Business => 'Business',
    );
}