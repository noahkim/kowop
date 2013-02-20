<?php

final class PaymentStatus
{
    private function __construct()
    {
    }

    const Scheduled = 1;
    const Processed = 2;
    const Cancelled = 3;

    public static $Lookup = array(
        PaymentStatus::Scheduled => 'Scheduled',
        PaymentStatus::Processed => 'Processed',
        PaymentStatus::Cancelled => 'Cancelled',
    );
}