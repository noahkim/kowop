<?php

final class MessageType
{
    private function __construct()
    {
    }

    const Notification = 1;
    const Message = 2;
    const FriendRequest = 3;
    const Broadcast = 4;

    public static $Lookup = array(MessageType::Notification => 'Notification',
        MessageType::Message => 'Message',
        MessageType::FriendRequest => 'Homie Request',
        MessageType::Broadcast => 'Broadcast',
    );
}