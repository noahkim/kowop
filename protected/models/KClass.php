<?php

/**
 * This is the model class for table "KClass".
 *
 * The followings are the available columns in table 'KClass':
 * @property integer $Class_ID
 * @property integer $Course_ID
 * @property integer $Create_User_ID
 * @property string $Name
 * @property string $Description
 * @property integer $Type
 * @property string $Start
 * @property string $End
 * @property integer $Min_occupancy
 * @property integer $Max_occupancy
 * @property integer $Location_ID
 * @property integer $Category_ID
 * @property string $Tuition
 * @property string $Prerequisites
 * @property string $Materials
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property ClassToContent[] $classToContents
 * @property ClassToTag[] $classToTags
 * @property ClassUpdates[] $classUpdates
 * @property Course $course
 * @property Location $location
 * @property Category $category
 * @property User $createUser
 * @property Rating[] $ratings
 * @property Request[] $requests
 * @property Session[] $sessions
 * @property UserToClass[] $userToClasses
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
            array('Name, Description, Type, Start, End, Min_occupancy, Max_occupancy, Category_ID', 'required'),
            array('Type, Min_occupancy, Max_occupancy, Category_ID', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 255),
            array('Prerequisites, Materials', 'length', 'max' => 1000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Class_ID, Course_ID, Create_User_ID, Name, Description, Type, Start, End, Min_occupancy, Max_occupancy, Location_ID, Category_ID, Tuition, Prerequisites, Materials, Created, Updated', 'safe'),
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
            'classToContents' => array(self::HAS_MANY, 'ClassToContent', 'Class_ID'),
            'contents' => array(self::HAS_MANY, 'Content', array('Content_ID' => 'Content_ID'), 'through' => 'classToContents'),
            'classToTags' => array(self::HAS_MANY, 'ClassToTag', 'Class_ID'),
            'tags' => array(self::HAS_MANY, 'Tag', array('Tag_ID' => 'Tag_ID'), 'through' => 'classToTags'),
            'classUpdates' => array(self::HAS_MANY, 'ClassUpdates', 'Class_ID'),
            'course' => array(self::BELONGS_TO, 'Course', 'Course_ID'),
            'location' => array(self::BELONGS_TO, 'Location', 'Location_ID'),
            'category' => array(self::BELONGS_TO, 'Category', 'Category_ID'),
            'createUser' => array(self::BELONGS_TO, 'User', 'Create_User_ID'),
            'ratings' => array(self::HAS_MANY, 'Rating', 'Class_ID'),
            'requests' => array(self::HAS_MANY, 'Request', 'Class_ID'),
            'sessions' => array(self::HAS_MANY, 'Session', 'Class_ID'),
            'userToClasses' => array(self::HAS_MANY, 'UserToClass', 'Class_ID'),
            'students' => array(self::HAS_MANY, 'User', array('User_ID' => 'User_ID'), 'through' => 'userToClasses')
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
            'Create_User_ID' => 'Teacher',
            'Name' => 'Name',
            'Description' => 'Description',
            'Type' => 'Class Type',
            'Start' => 'Start',
            'End' => 'End',
            'Min_occupancy' => 'Min Occupancy',
            'Max_occupancy' => 'Max Occupancy',
            'Location_ID' => 'Location',
            'Category_ID' => 'Category',
            'Tuition' => 'Tuition',
            'Prerequisites' => 'Prerequisites',
            'Materials' => 'Materials',
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
        $criteria->compare('Create_User_ID', $this->Create_user_ID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('Type', $this->Type);
        $criteria->compare('Start', $this->Start, true);
        $criteria->compare('End', $this->End, true);
        $criteria->compare('Min_occupancy', $this->Min_occupancy);
        $criteria->compare('Max_occupancy', $this->Max_occupancy);
        $criteria->compare('Location_ID', $this->Location_ID);
        $criteria->compare('Category_ID', $this->Category_ID);
        $criteria->compare('Prerequisites', $this->Prerequisites, true);
        $criteria->compare('Materials', $this->Materials, true);
        $criteria->compare('Tuition', $this->Tuition);
        $criteria->compare('Created', $this->Created, true);
        $criteria->compare('Updated', $this->Updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTagList()
    {
        $tags = array();

        foreach($this->tags as $tag)
        {
            array_push($tags, $tag->Name);
        }

        return $tags;
    }

    public function getTagString()
    {
        return Tag::model()->array2string($this->taglist);
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

        $this->Create_User_ID = Yii::app()->user->id;

        return parent::beforeSave();
    }
}