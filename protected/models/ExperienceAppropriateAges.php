<?php

final class ExperienceAppropriateAges
{
    private function __construct()
    {
    }

    const Ages_0_3 = 1;
    const Ages_3_5 = 2;
    const Ages_5_10 = 4;
    const Ages_10Plus = 8;

    public static $Lookup = array(
        ExperienceAppropriateAges::Ages_0_3 => '0 to 3 years',
        ExperienceAppropriateAges::Ages_3_5 => '3 to 5 years',
        ExperienceAppropriateAges::Ages_5_10 => '5 to 10 years',
        ExperienceAppropriateAges::Ages_10Plus => '10+ years',
    );
}
