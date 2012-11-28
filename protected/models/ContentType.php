<?php

final class ContentType
{
    private function __construct()
    {
    }

    const ImageURL = 1;
    const VideoURL = 2;
    const ImageID = 3;
    const VideoID = 4;

    public static $Lookup = array(ContentType::ImageURL => 'ImageURL',
        ContentType::VideoURL => 'VideoURL',
        ContentType::ImageID => 'ImageID',
        ContentType::VideoID => 'VideoID'
    );
}
