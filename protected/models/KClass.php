<?php

/**
 * This is the model class for table "KClass".
 *
 * The followings are the available columns in table 'KClass':
 * @property integer $Class_ID
 * @property integer $Course_ID
 * @property string $Name
 * @property integer $Type
 * @property string $Start
 * @property string $End
 * @property integer $Min_occupancy
 * @property integer $Max_occupancy
 * @property integer $Location_ID
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property ClassToCategory[] $classToCategories
 * @property ClassToTag[] $classToTags
 * @property Course $course
 * @property Location $location
 * @property Rating[] $ratings
 * @property Request[] $requests
 * @property Session[] $sessions
 */
class KClass extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return KClass the static model class
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
        return 'KClass';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, Type, Start, End, Min_occupancy, Max_occupancy', 'required'),
            array('Type, Min_occupancy, Max_occupancy', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Class_ID, Course_ID, Name, Type, Start, End, Min_occupancy, Max_occupancy, Location_ID, Created, Updated', 'safe', 'on' => 'search'),
            array('Updated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('Created,Updated', 'default',
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
            'classToCategories' => array(self::HAS_MANY, 'ClassToCategory', 'Class_ID'),
            'classToTags' => array(self::HAS_MANY, 'ClassToTag', 'Class_ID'),
            'course' => array(self::BELONGS_TO, 'Course', 'Course_ID'),
            'location' => array(self::BELONGS_TO, 'Location', 'Location_ID'),
            'ratings' => array(self::HAS_MANY, 'Rating', 'Class_ID'),
            'requests' => array(self::HAS_MANY, 'Request', 'Class_ID'),
            'sessions' => array(self::HAS_MANY, 'Session', 'Class_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Class_ID' => 'Class',
            'Course_ID' => 'Course',
            'Name' => 'Name',
            'Type' => 'Type',
            'Start' => 'Start',
            'End' => 'End',
            'Min_occupancy' => 'Min Occupancy',
            'Max_occupancy' => 'Max Occupancy',
            'Location_ID' => 'Location',
            'Created' => 'Created',
            'Updated' => 'Updated',
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

        $criteria->compare('Class_ID', $this->Class_ID);
        $criteria->compare('Course_ID', $this->Course_ID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Type', $this->Type);
        $criteria->compare('Start', $this->Start, true);
        $criteria->compare('End', $this->End, true);
        $criteria->compare('Min_occupancy', $this->Min_occupancy);
        $criteria->compare('Max_occupancy', $this->Max_occupancy);
        $criteria->compare('Location_ID', $this->Location_ID);
        $criteria->compare('Created', $this->Created, true);
        $criteria->compare('Updated', $this->Updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave()
    {
        if (isset($this->Start))
        {
            $this->Start = date('Y-m-d', strtotime($this->Start));
        }

        if (isset($this->End))
        {
            $this->End = date('Y-m-d', strtotime($this->End));
        }

        return parent::beforeSave();
    }
}