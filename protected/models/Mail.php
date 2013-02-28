<?php

class Mail
{
    protected static $instance = null;
    protected $emailClient;
    protected $defaultFrom;

    protected function __construct()
    {
        Yii::import('application.extensions.vendor.autoload', true);

        $this->emailClient = Aws\Ses\SesClient::factory(array(
            'key' => Yii::app()->params['AmazonSESKey'],
            'secret' => Yii::app()->params['AmazonSESSecret'],
            'region' => Yii::app()->params['AmazonSESRegion'],
        ));

        $this->defaultFrom = 'noreply@kowop.com';
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
            'Source' => $this->defaultFrom,
            'Destination' => array('ToAddresses' => array($to)),
            'Message' => array(
                'Subject' => array('Data' => $subject),
                'Body' => array('Html' => array('Data' => $message))
            )
        );

        $this->emailClient->sendEmail($args);
    }

    public function Alert($subject, $message)
    {
        $alertTo = array("ilija1@gmail.com", "ilija@kowop.com", "noah@kowop.com");

        $errors = '';

        foreach ($alertTo as $to)
        {
            try
            {
                Mail::Instance()->Send($to, $subject, $message);
            }
            catch (Exception $e)
            {
                $errors .= "Error sending mail to {$to}.\n";
            }
        }

        Yii::log($errors, 'info', 'email');
    }
}