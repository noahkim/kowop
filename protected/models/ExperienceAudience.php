<?php

final class ExperienceAudience
{
    private function __construct()
    {
    }

    const Everyone = 1;
    const Adults = 2;
    const Kids = 3;

    public static $Lookup = array(ExperienceAudience::Everyone => 'Everyone',
        ExperienceAudience::Adults => 'Adults',
        ExperienceAudience::Kids => 'Kids',
    );
}