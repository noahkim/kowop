<?php

class Mail
{
    public static function Send($to, $subject, $message)
    {
        Yii::import('application.extensions.vendor.autoload', true);

        $email = Aws\Ses\SesClient::factory(array(
            'key'    => Yii::app()->params['AmazonSESKey'],
            'secret' => Yii::app()->params['AmazonSESSecret'],
            'region' => Yii::app()->params['AmazonSESRegion'],
        ));

        $args = array(
            'Source' => 'noreply@kowop.com',
            'Destination' => array('ToAddresses' => array($to)),
            'Message' => array(
                'Subject' => array('Data' => $subject),
                'Body' => array('Html' => array('Data' => $message))
            )
        );

        $email->sendEmail($args);
    }
}