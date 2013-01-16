<?php

    final class FriendStatus
    {
        private function __construct()
        {
        }

        const Friend = 1;
        const AwaitingApproval = 2;

        public static $Lookup = array(FriendStatus::Friend => 'Friend',
            FriendStatus::AwaitingApproval => 'Awaiting approval'
        );
    }