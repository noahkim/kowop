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

    const AGE_UNDEFINED = 255;

    public static $Lookup = array(
        ExperienceAppropriateAges::Ages_0_3 => '0 to 3 years',
        ExperienceAppropriateAges::Ages_3_5 => '3 to 5 years',
        ExperienceAppropriateAges::Ages_5_10 => '5 to 10 years',
        ExperienceAppropriateAges::Ages_10Plus => '10+ years',
    );

    public static $LookupMinMaxAges = array(
        ExperienceAppropriateAges::Ages_0_3 => array(0, 3),
        ExperienceAppropriateAges::Ages_3_5 => array(3, 5),
        ExperienceAppropriateAges::Ages_5_10 => array(5, 10),
        ExperienceAppropriateAges::Ages_10Plus => array(10, ExperienceAppropriateAges::AGE_UNDEFINED),
    );

    public static function GetMinMaxAges($value)
    {
        $minAge = ExperienceAppropriateAges::AGE_UNDEFINED;
        $maxAge = 0;

        foreach (ExperienceAppropriateAges::$LookupMinMaxAges as $ageGroup => $minMaxAge)
        {
            if ($value & $ageGroup)
            {
                if ($minMaxAge[0] < $minAge)
                {
                    $minAge = $minMaxAge[0];
                }

                if ($minMaxAge[1] > $maxAge)
                {
                    $maxAge = $minMaxAge[1];
                }
            }
        }

        if($maxAge == ExperienceAppropriateAges::AGE_UNDEFINED)
        {
            $maxAge = '10+';
        }

        return array($minAge, $maxAge);
    }
}
