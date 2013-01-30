<?php

final class ContentType
{
    private function __construct()
    {
    }

    const ImageURL = 1;
    const ImageID = 2;

    public static $Lookup = array(ContentType::ImageURL => 'ImageURL',
        ContentType::ImageID => 'ImageID',
    );
}
