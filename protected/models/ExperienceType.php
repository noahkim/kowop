<?php

final class ExperienceType
{
    private function __construct()
    {
    }

    const Activity = 1;
    const Class_ = 2;

    public static $Lookup = array(ExperienceType::Activity => 'Activity',
        ExperienceType::Class_ => 'Class',
    );
}