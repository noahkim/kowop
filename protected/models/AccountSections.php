<?php

final class AccountSections
{
    private function __construct()
    {
    }

    const Notifications = 1;
    const Friends = 2;
    const MyExperiences = 3;
    const MyListings = 4;
    const MyCalendar = 5;
    const AccountInformation = 6;
    const MyCustomers = 7;
    const CreditCards = 8;
    const BankAccount = 9;

    public static $Lookup = array(
        AccountSections::Notifications => 'Notifications',
        AccountSections::Friends => 'Homies',
        AccountSections::MyExperiences => 'My Experiences',
        AccountSections::MyListings => 'My Listings',
        AccountSections::MyCustomers => 'My Customers',
        AccountSections::MyCalendar => 'My Calendar',
        AccountSections::AccountInformation => 'Account Information',
        AccountSections::CreditCards => 'Credit Card Information',
        AccountSections::BankAccount => 'Receive Payments',
    );
}