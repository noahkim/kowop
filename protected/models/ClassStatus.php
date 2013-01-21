<?php

final class ClassStatus
{
    private function __construct()
    {
    }

    const Active = 1;
    const Inactive = 2;

    public static $Lookup = array(ClassStatus::Active => 'Active',
        ClassStatus::Inactive => 'Inactive'
    );
}