<?php

final class ExperienceAudience
{
    private function __construct()
    {
    }

    const Everyone = 1;
    const Kids = 2;

    public static $Lookup = array(ExperienceAudience::Everyone => 'Everyone',
        ExperienceAudience::Kids => 'Kids',
    );
}