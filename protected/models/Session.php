<?php

/**
 * This is the model class for table "Session".
 *
 * The followings are the available columns in table 'Session':
 * @property integer $Session_ID
 * @property integer $Experience_ID
 * @property string $Start
 * @property string $End
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property Experience $experience
 * @property UserToSession[] $userToSessions
 */
class Session extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $experienceName active record class name.
     * @return Session the static model class
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
        return 'Session';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('Experience_ID', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
                     array('Session_ID, Experience_ID, Start, End, Created', 'safe'),
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
        return array('experience' => array(self::BELONGS_TO, 'Experience', 'Experience_ID'),
                     'userToSessions' => array(self::HAS_MANY, 'UserToSession', 'Session_ID'),
                     'enrolled' => array(self::HAS_MANY, 'User', array('User_ID' => 'User_ID'),
                                         'through' => 'userToSessions'));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('Session_ID' => 'Session', 'Experience_ID' => 'Experience', 'Start' => 'Start', 'End' => 'End',
                     'Created' => 'Created',);
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

        $criteria->compare('Session_ID', $this->Session_ID);
        $criteria->compare('Experience_ID', $this->Experience_ID);
        $criteria->compare('Start', $this->Start, true);
        $criteria->compare('End', $this->End, true);
        $criteria->compare('Created', $this->Created, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    public function beforeSave()
    {
        if (isset($this->Start))
        {
            $this->Start = date('Y-m-d H:i:s', strtotime($this->Start));
        }

        if (isset($this->End))
        {
            $this->End = date('Y-m-d H:i:s', strtotime($this->End));
        }

        return parent::beforeSave();
    }
}
