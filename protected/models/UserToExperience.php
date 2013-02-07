<?php

/**
 * This is the model class for table "User_to_experience".
 *
 * The followings are the available columns in table 'User_to_experience':
 * @property integer $User_to_experience_ID
 * @property integer $User_ID
 * @property integer $Experience_ID
 * @property integer $Session_ID
 * @property integer $Quantity
 * @property integer $Status
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Experience $experience
 * @property Session $session
 */
class UserToExperience extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserToExperience the static model class
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
        return 'User_to_experience';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('User_ID, Experience_ID, Session_ID, Quantity, Status', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
                     array('User_to_experience_ID, User_ID, Experience_ID, Session_ID, Quantity, Status, Created',
                           'safe'),
                     array('Created', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false,
                           'on' => 'insert'));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('user' => array(self::BELONGS_TO, 'User', 'User_ID'),
                     'experience' => array(self::BELONGS_TO, 'Experience', 'Experience_ID'),
                     'session' => array(self::BELONGS_TO, 'Session', 'Session_ID'),);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('User_to_experience_ID' => 'User To Experience', 'User_ID' => 'User',
                     'Experience_ID' => 'Experience', 'Session_ID' => 'Session', 'Quantity' => 'Quantity',
                     'Status' => 'Status', 'Created' => 'Created',);
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

        $criteria->compare('User_to_experience_ID', $this->User_to_experience_ID);
        $criteria->compare('User_ID', $this->User_ID);
        $criteria->compare('Experience_ID', $this->Experience_ID);
        $criteria->compare('Session_ID', $this->Session_ID);
        $criteria->compare('Quantity', $this->Quantity);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Created', $this->Created, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }
}
