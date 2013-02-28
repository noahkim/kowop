<?php

class ContactForm extends CFormModel
{
    public $category;
    public $subject;
    public $message;

    public function rules()
    {
        return array(
            array('subject', 'length', 'max' => 255),
            array('category, subject, message', 'safe'),
        );
    }

    public function save()
    {
        $category = ContactForm::$Categories[$this->category];

        $subject = '[Contact Form] ' . $this->subject;

        $message = <<<BLOCK
            Category: {$category} <br />
            Subject: {$this->subject} <br />
            Message: {$this->message} <br />
BLOCK;

        Mail::Instance()->Alert($subject, $message);
    }

    public static $Categories = array(
        1 => 'Question regarding taking classes or activities',
        2 => 'Question regarding posting classes or activities',
        3 => 'Suggestion about Kowop',
        4 => 'I took a class or activity, and have a problem',
        5 => 'Nothing in particular, just bored',
    );
}