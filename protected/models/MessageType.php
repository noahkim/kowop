<?php

final class MessageType
{
    private function __construct()
    {
    }

    const Notification = 1;
    const Message = 2;
    const Broadcast = 3;

    public static $Lookup = array(MessageType::Notification => 'Notification',
        MessageType::Message => 'Message',
        MessageType::Broadcast => 'Broadcast'
    );
}