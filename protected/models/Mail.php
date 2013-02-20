<?php

class Mail
{
    protected static $instance = null;
    protected $emailClient;

    protected function __construct()
    {
        Yii::import('application.extensions.vendor.autoload', true);

        $this->emailClient = Aws\Ses\SesClient::factory(array(
            'key' => Yii::app()->params['AmazonSESKey'],
            'secret' => Yii::app()->params['AmazonSESSecret'],
            'region' => Yii::app()->params['AmazonSESRegion'],
        ));
    }

    protected function __clone()
    {
    }

    public static function Instance()
    {
        if (!isset(static::$instance))
        {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function Send($to, $subject, $message)
    {
        $args = array(
            'Source' => 'noreply@kowop.com',
            'Destination' => array('ToAddresses' => array($to)),
            'Message' => array(
                'Subject' => array('Data' => $subject),
                'Body' => array('Html' => array('Data' => $message))
            )
        );

        $this->emailClient->sendEmail($args);
    }
}