<?php

/**
 * This is the model class for table "Message".
 *
 * The followings are the available columns in table 'Message':
 * @property integer $Message_ID
 * @property integer $To
 * @property integer $From
 * @property string $Subject
 * @property string $Content
 * @property integer $Parent_ID
 * @property integer $Type
 * @property integer $Read
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property Message $parent
 * @property Message[] $messages
 * @property User $to
 * @property User $from
 */
class Message extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Message the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Subject', 'length', 'max' => 255),
            array('Content', 'length', 'max' => 8000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Message_ID, Parent_ID, To, From, Subject, Content, Type, Read, Created', 'safe'),
            array('Created', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'to' => array(self::BELONGS_TO, 'User', 'To'),
            'from' => array(self::BELONGS_TO, 'User', 'From'),
            'parent' => array(self::BELONGS_TO, 'Message', 'Parent_ID'),
            'messages' => array(self::HAS_MANY, 'Message', 'Parent_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Message_ID' => 'Message',
            'To' => 'To',
            'From' => 'From',
            'Subject' => 'Subject',
            'Content' => 'Content',
            'Parent_ID' => 'Parent',
            'Type' => 'Type',
            'Read' => 'Read',
            'Created' => 'Created',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('Message_ID', $this->Message_ID);
        $criteria->compare('To', $this->To);
        $criteria->compare('From', $this->From);
        $criteria->compare('Subject', $this->Subject, true);
        $criteria->compare('Content', $this->Content, true);
        $criteria->compare('Parent_ID',$this->Parent_ID);
        $criteria->compare('Type', $this->Type);
        $criteria->compare('Read', $this->Read);
        $criteria->compare('Created', $this->Created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function SendNotification($to, $subject, $text = null, $from = null, $type = MessageType::Notification)
    {
        $notification = new Message();
        $notification->Type = $type;
        $notification->To = $to;
        if ($from != null)
        {
            $notification->From = $from;
        }
        $notification->Subject = $subject;
        if ($text != null)
        {
            $notification->Content = $text;
        }

        $notification->save();
    }

    public static function SendMessage($to, $from, $text)
    {
        $message = new Message();
        $message->Type = MessageType::Message;
        $message->To = $to;
        $message->From = $from;
        $message->Content = $text;

        $message->save();
    }
}