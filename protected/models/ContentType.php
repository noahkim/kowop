<?php

final class ContentType
{
    private function __construct()
    {
    }

    const Image = 1;
    const Video = 2;

    public static $Lookup = array(ContentType::Image => 'Image',
        ContentType::Video => 'Video'
    );
}
