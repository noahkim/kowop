<?php

final class BankAccountType
{
    private function __construct()
    {
    }

    const Customer = 1;
    const Internal = 2;

    public static $Lookup = array(
        BankAccountType::Customer => 'Customer',
        BankAccountType::Internal => 'Internal',
    );
}
