<?php

final class ExperienceStatus
{
    private function __construct()
    {
    }

    const Active = 1;
    const Inactive = 2;

    public static $Lookup = array(ExperienceStatus::Active => 'Active',
        ExperienceStatus::Inactive => 'Inactive'
    );
}