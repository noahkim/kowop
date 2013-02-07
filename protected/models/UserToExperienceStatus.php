<?php

final class UserToExperienceStatus
{
    private function __construct()
    {
    }

    const Active = 1;
    const Inactive = 2;

    public static $Lookup = array(UserToExperienceStatus::Active => 'Active',
                                  UserToExperienceStatus::Inactive => 'Inactive');
}
