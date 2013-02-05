<?php

/**
 * This is the model class for table "Request_to_user".
 *
 * The followings are the available columns in table 'Request_to_user':
 * @property integer $Request_to_user_ID
 * @property integer $Request_ID
 * @property integer $User_ID
 * @property integer $Day
 * @property integer $Time_of_day
 *
 * The followings are the available model relations:
 * @property Request $request
 * @property User $user
 */
class RequestToUser extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $experienceName active record class name.
     * @return RequestToUser the static model class
     */
    public static function model($experienceName = __CLASS__)
    {
        return parent::model($experienceName);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Request_to_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Day, Time_of_day', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Request_to_user_ID, Request_ID, User_ID, Day, Time_of_day', 'safe'),
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
            'request' => array(self::BELONGS_TO, 'Request', 'Request_ID'),
            'user' => array(self::BELONGS_TO, 'User', 'User_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Request_to_user_ID' => 'Request To User',
            'Request_ID' => 'Request',
            'User_ID' => 'User',
            'Day' => 'Day',
            'Time_of_day' => 'Time Of Day',
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

        $criteria->compare('Request_to_user_ID', $this->Request_to_user_ID);
        $criteria->compare('Request_ID', $this->Request_ID);
        $criteria->compare('User_ID', $this->User_ID);
        $criteria->compare('Day', $this->Day);
        $criteria->compare('Time_of_day', $this->Time_of_day);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave()
    {
        $this->User_ID = Yii::app()->user->id;

        return parent::beforeSave();
    }
}
