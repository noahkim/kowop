<?php

final class ExperiencePosterType
{
    private function __construct()
    {
    }

    const Individual = 1;
    const Business = 2;

    public static $Lookup = array(
        ExperiencePosterType::Individual => 'Individual',
        ExperiencePosterType::Business => 'Business',
    );
}