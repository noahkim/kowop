<?php

/**
 * This is the model class for table "Experience".
 *
 * The followings are the available columns in table 'Experience':
 * @property integer $Experience_ID
 * @property integer $Create_User_ID
 * @property string $Name
 * @property string $Description
 * @property string $Start
 * @property string $End
 * @property integer $Min_occupancy
 * @property integer $Max_occupancy
 * @property integer $Location_ID
 * @property integer $Category_ID
 * @property string $Price
 * @property integer $Audience
 * @property integer $Type
 * @property integer $PosterType
 * @property integer $AppropriateAges
 * @property string $Offering
 * @property string $FinePrint
 * @property integer $Status
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property Location $location
 * @property Category $category
 * @property User $createUser
 * @property ExperienceToContent[] $experienceToContents
 * @property ExperienceToTag[] $experienceToTags
 * @property Rating[] $ratings
 * @property Request[] $requests
 * @property Session[] $sessions
 */
class Experience extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Experience the static model class
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
        return 'Experience';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Create_User_ID, Name, Description, Start, End, Min_occupancy, Max_occupancy, Category_ID, Audience, Type, PosterType, Offering', 'required'),
            array('Create_User_ID, Min_occupancy, Max_occupancy, Location_ID, Category_ID, Audience, Type, PosterType, AppropriateAges, Status', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 255),
            array('Description', 'length', 'max' => 2000),
            array('Offering, FinePrint', 'length', 'max' => 1000),
            array('Price', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Experience_ID, Create_User_ID, Name, Description, Start, End, Min_occupancy, Max_occupancy, Location_ID, Category_ID, Price, Audience, Type, PosterType, AppropriateAges, Offering, FinePrint, Status, Created, Updated', 'safe'),
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
            'location' => array(self::BELONGS_TO, 'Location', 'Location_ID'),
            'category' => array(self::BELONGS_TO, 'Category', 'Category_ID'),
            'createUser' => array(self::BELONGS_TO, 'User', 'Create_User_ID'),
            'experienceToContents' => array(self::HAS_MANY, 'ExperienceToContent', 'Experience_ID'),
            'experienceToTags' => array(self::HAS_MANY, 'ExperienceToTag', 'Experience_ID'),
            'ratings' => array(self::HAS_MANY, 'Rating', 'Experience_ID'),
            'requests' => array(self::HAS_MANY, 'Request', 'Created_Experience_ID'),
            'sessions' => array(self::HAS_MANY, 'Session', 'Experience_ID'),
            // Added
            'contents' => array(self::HAS_MANY, 'Content', array('Content_ID' => 'Content_ID'), 'through' => 'experienceToContents'),
            'tags' => array(self::HAS_MANY, 'Tag', array('Tag_ID' => 'Tag_ID'), 'through' => 'experienceToTags'),
            'userToSessions' => array(self::HAS_MANY, 'UserToSession', array('User_to_session_ID' => 'User_to_session_ID'), 'through' => 'sessions'),
            'enrolled' => array(self::HAS_MANY, 'User', array('User_ID' => 'User_ID'), 'through' => 'userToSessions'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Experience_ID' => 'Experience',
            'Create_User_ID' => 'Create User',
            'Name' => 'Name',
            'Description' => 'Description',
            'Start' => 'Start',
            'End' => 'End',
            'Min_occupancy' => 'Min Occupancy',
            'Max_occupancy' => 'Max Occupancy',
            'Location_ID' => 'Location',
            'Category_ID' => 'Category',
            'Price' => 'Price',
            'Audience' => 'Audience',
            'Type' => 'Type',
            'PosterType' => 'Poster Type',
            'AppropriateAges' => 'AppropriateAges',
            'Offering' => 'Offering',
            'FinePrint' => 'Fine Print',
            'Status' => 'Status',
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

        $criteria->compare('Experience_ID', $this->Experience_ID);
        $criteria->compare('Create_User_ID', $this->Create_User_ID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('Start', $this->Start, true);
        $criteria->compare('End', $this->End, true);
        $criteria->compare('Min_occupancy', $this->Min_occupancy);
        $criteria->compare('Max_occupancy', $this->Max_occupancy);
        $criteria->compare('Location_ID', $this->Location_ID);
        $criteria->compare('Category_ID', $this->Category_ID);
        $criteria->compare('Price', $this->Price, true);
        $criteria->compare('Audience', $this->Audience);
        $criteria->compare('Type', $this->Type);
        $criteria->compare('PosterType', $this->PosterType);
        $criteria->compare('AppropriateAges', $this->AppropriateAges);
        $criteria->compare('Offering', $this->Offering);
        $criteria->compare('FinePrint', $this->FinePrint);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Created', $this->Created, true);
        $criteria->compare('Updated', $this->Updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTagList()
    {
        $tags = array();

        foreach ($this->tags as $tag)
        {
            array_push($tags, $tag->Name);
        }

        return $tags;
    }

    public function getTagString()
    {
        return Tag::model()->array2string($this->taglist);
    }

    public function getPicture()
    {
        $numContents = count($this->contents);
        if ($numContents > 0)
        {
            return $this->contents[$numContents - 1]->Link;
        }

        return null;
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
